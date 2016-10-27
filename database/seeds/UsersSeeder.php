<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker::create();

        // $limit = 5000;

        // $seed = [];

        // for ($i = 0; $i < $limit; $i++) {
        //     $temp = [
        //         'name' => $faker->name,
        //         'email' => time().$faker->email,
        //         'password' => bcrypt('secret'),
        //     ];

        //     array_push($seed, $temp);
        // }


        // DB::table('users')->insert($seed);


        $faker = Faker::create();

        $limit = 5000;

        for ($i = 0; $i < $limit; $i++) {
            $seed = [
                'name' => $faker->name,
                'email' => time().$faker->email,
                'password' => bcrypt('secret'),
            ];
            
            DB::table('users')->insert($seed);   
        }



    }
}
