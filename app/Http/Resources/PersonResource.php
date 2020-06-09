<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
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
            'name' => $this->name,
            'gender' => $this->gender,
            'details' => $this->when(!empty($this->details), $this->details),
            'character' => $this->when(isset($this->character), function () {
                return $this->character;
            }),
            'role' => $this->when(isset($this->role), function () {
                return $this->role->name;
            }),
            'movies' =>  $this->when(isset($this->movies), function () {
                return $this->movies;
            })
        ];
    }
}
