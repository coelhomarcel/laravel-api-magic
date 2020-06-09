<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieRequest;
use Illuminate\Http\Response;
use App\Http\Resources\MovieResource;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Movie;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::paginate();
        $person = [];
        foreach($movies as $movie){
            foreach($movie->people as $index => $movie_person){
                $person_role =  $movie_person->person_role;
                $person[$index] = $person_role->person;
                $person[$index]->role = $person_role->role;
                $person[$index]->character = $movie_person->character;
            }
            $movie->person = $person;
        }        
        return MovieResource::collection($movies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MovieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieRequest $request)
    {
        try{
            $movie = new Movie;
            $movie->fill($request->validated())->save();

            return new MovieResource($movie);
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
        $movie = Movie::findOrfail($id);
        $person = [];
        foreach($movie->people as $index => $movie_person){
            $person_role =  $movie_person->person_role;
            $person[$index] = $person_role->person;
            $person[$index]->role = $person_role->role;
            $person[$index]->character = $movie_person->character;
        }
        $movie->person = $person;
        return new MovieResource( $movie );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MovieRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MovieRequest $request, $id)
    {
        if(!$id){
            throw new HttpException(400, "Invalid id");
        }

        try{
            $movie = Movie::find($id);
            $movie->fill($request->validated())->save();

            return new MovieResource($movie);
        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::findOrfail($id);
        foreach($movie->people as $movie_person){
            $movie_person->delete();
        }
        $movie->delete();

        return response()->json(null, 204);
    }
}
