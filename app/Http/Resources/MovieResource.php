<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PersonRoleResource;
use App\Http\Resources\PersonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'genre' => $this->genre,
            'duration' => $this->duration,
            'release_date'=> $this->release_date,
            'description'=> $this->description,
            'rating'=> new MovieRatingResource($this->rating),
            'character' => $this->when(isset($this->character), function () {
                return $this->character;
            }),
            'crew' => $this->when(isset($this->person), function () {
                return PersonResource::collection($this->person);
            })
            
        ];
    }
}
