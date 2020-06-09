<?php

use Illuminate\Support\Facades\Route;

Route::apiResources([
    'movies' => API\MovieController::class,
    'ratings' => API\MovieRatingController::class,
    'actors' => API\MoviePersonController::class,
    'directors' => API\MoviePersonController::class
]);