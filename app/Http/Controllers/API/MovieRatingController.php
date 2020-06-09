<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieRatingRequest;
use Illuminate\Http\Response;
use App\Http\Resources\MovieRatingResource;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\MovieRating;

class MovieRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MovieRatingResource::collection(MovieRating::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MovieRatingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieRatingRequest $request)
    {
        try{
            $movie_rating = new MovieRating;
            $movie_rating->fill($request->validated())->save();

            return new MovieRatingResource($movie_rating);
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
        return new MovieRatingResource( MovieRating::findOrfail($id) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MovieRatingRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MovieRatingRequest $request, $id)
    {
        if(!$id){
            throw new HttpException(400, "Invalid id");
        }

        try{
            $movie_rating = MovieRating::find($id);
            $movie_rating->fill($request->validated())->save();

            return new MovieRatingResource($movie_rating);
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
        $movie_rating = MovieRating::findOrfail($id);
        $movie_rating->delete();

        return response()->json(null, 204);
    }
}
