<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Http\Requests\MoviePersonRequest;
use App\Http\Resources\PersonResource;
use App\Models\MoviePerson;
use App\Models\Role;
use App\Models\Person;
use App\Models\PersonRole;


class MoviePersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Support\Facades\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $people_role = PersonRole::where('role_id', $this->getRoleId())->get();
        $people = [];
        foreach($people_role as $index => $person_role){
            $people[$index] = $person_role->person;
            $movies = [];
            foreach($person_role->movies as $movie_person){
                $movies[] = $movie_person->movie->title;
            }
            $people[$index]->movies = $movies;
        }
        return PersonResource::collection(collect($people)->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MoviePersonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MoviePersonRequest $request)
    {
        try{
            $data = $request->validated();

            $person_data = $data;
            unset($person_data['movie_characters'], $person_data['movie_ids']);
            $person = new Person; 
            $person->fill($person_data)->save();

            $person_role = new PersonRole;
            $person_role->person_id = $person->id;
            $person_role->role_id = $this->getRoleId();
            $person_role->save();

            $movies = [];
            if(isset($data['movie_ids'])) foreach($data['movie_ids'] as $index => $id){
                $movie_person = new MoviePerson;
                $movie_person->movie_id = $id;
                $movie_person->person_role_id = $person_role->id;
                $movie_person->character = isset($data['movie_characters'][$index]) ? $data['movie_characters'][$index] : NULL;
                $movie_person->save();
                $movies[$index] = $movie_person->movie;
                $movies[$index]->character = isset($data['movie_characters'][$index]) ? $data['movie_characters'][$index] : NULL;
            }
            $person->movies = $movies;

            return new PersonResource($person);
        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $person_role = PersonRole::where('role_id', $this->getRoleId(true))
            ->where('person_id', $id)
            ->firstOrFail();
        $person = $person_role->person;

        $movies = [];
        foreach($person_role->movies as $movie_person){
            $movies[] = $movie_person->movie->title;
        }
        $person->movies = $movies;
        
        return new PersonResource($person);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MoviePersonRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MoviePersonRequest $request, $id)
    {
        if(!$id){
            throw new HttpException(400, "Invalid id");
        }

        $person_role = PersonRole::where('role_id', $this->getRoleId(true))
        ->where('person_id', $id)
        ->firstOrFail();

        try{
            $data = $request->validated();
        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage}");
        }

        $person_data = $data;
        unset($person_data['movie_characters'], $person_data['movie_ids']);
        $person = $person_role->person;
        $person->fill($person_data)->save();

        foreach($person_role->movies as $person_movie){
            $person_movie->delete();
        }

        $movies = [];
        if(isset($data['movie_ids'])){
            foreach($data['movie_ids'] as $index => $id){
                $movie_person = new MoviePerson;
                $movie_person->movie_id = $id;
                $movie_person->person_role_id = $person_role->id;
                $movie_person->character = isset($data['movie_characters'][$index]) ? $data['movie_characters'][$index] : NULL;
                $movie_person->save();
                $movies[$index] = $movie_person->movie;
                $movies[$index]->character = isset($data['movie_characters'][$index]) ? $data['movie_characters'][$index] : NULL;
            }
        }
        $person->movies = $movies;

        return new PersonResource($person);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person_role = PersonRole::where('role_id', $this->getRoleId(true))
            ->where('person_id', $id)
            ->firstOrFail();

        $person = $person_role->person;
        foreach($person_role->movies as $person_movie){
            $person_movie->delete();
        }
        $person_role->delete();
        $person->delete();

        return response()->json(null, 204);
    }

    /**
     * Get Role ID By Slug
     */
    private function getRoleId($show = false){
        $slug = Request::segment(count(Request::segments()));
        if($show) $slug = Request::segment(count(Request::segments())-1);
        $role = Role::where('name', Str::singular($slug))->firstOrFail();
        return $role->id;
    }
}
