<?php

use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movie_ratings')->insert([
            'name' => 'Livre'
        ]);  

        DB::table('movie_ratings')->insert([
            'name' => '+18',
            'age' => 18
        ]); 

        DB::table('movies')->insert([
            'title' => 'Random Title '.Str::random(10),
            'genre' => 'Comédia',
            'duration' => 10,
            'release_date' => '1996-02-05',
            'description' => 'Random Description '.Str::random(10),
            'rating_id' => 1
        ]);
        
        DB::table('movies')->insert([
            'title' => 'Random Title '.Str::random(10),
            'genre' => 'Drama',
            'duration' => 200,
            'release_date' => '2020-10-06',
            'description' => 'Random Description '.Str::random(10),
            'rating_id' => 2
        ]);   

        for ($i = 0; $i < 2; $i++) {
            DB::table('people')->insert([
                'name' => 'Random Name '.Str::random(10),
                'gender' => 'M',
                'details' => 'Random Details '.Str::random(10),
            ]);
            
            DB::table('people')->insert([
                'name' => 'Random Name '.Str::random(10),
                'gender' => 'F',
                'details' => 'Random Details '.Str::random(10),
            ]);
        }

        DB::table('person_roles')->insert([
            'person_id' => 1,
            'role_id' => 1
        ]); 

        DB::table('movie_people')->insert([
            'movie_id' => 1,
            'person_role_id' => 1,
            'character' => 'Random Name '.Str::random(10)
        ]);

        DB::table('person_roles')->insert([
            'person_id' => 1,
            'role_id' => 2
        ]); 

        DB::table('movie_people')->insert([
            'movie_id' => 2,
            'person_role_id' => 2
        ]);

        DB::table('person_roles')->insert([
            'person_id' => 2,
            'role_id' => 1
        ]); 

        DB::table('movie_people')->insert([
            'movie_id' => 2,
            'person_role_id' => 3,
            'character' => 'Random Name '.Str::random(10)
        ]);

        DB::table('person_roles')->insert([
            'person_id' => 3,
            'role_id' => 1
        ]); 

        DB::table('movie_people')->insert([
            'movie_id' => 2,
            'person_role_id' => 4,
            'character' => 'Random Name '.Str::random(10)
        ]);

        DB::table('person_roles')->insert([
            'person_id' => 4,
            'role_id' => 2
        ]); 

        DB::table('movie_people')->insert([
            'movie_id' => 1,
            'person_role_id' => 5
        ]);        
        
    }
}
