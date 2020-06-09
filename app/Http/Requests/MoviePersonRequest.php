<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MoviePersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:1|in:M,F',
            'details' =>'string',
            'movie_ids' => 'array',
            'movie_ids.*' => 'integer|exists:App\Models\Movie,id',
            'movie_characters' => 'array',
            'movie_characters.*' => 'string|max:255'
        ];
    }
}
