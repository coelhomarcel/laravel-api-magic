<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_ratings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age')->nullable();
        });

        Schema::table('movies', function (Blueprint $table) {
            $table->foreignId('rating_id')->constrained('movie_ratings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('movies', function (Blueprint $table) {
            $table->dropForeign(['rating_id']);
        });

        Schema::dropIfExists('movie_ratings');
    }
}
