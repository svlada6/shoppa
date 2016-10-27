<?php

use Illuminate\Database\Seeder;

class UsersRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = 10000;

        for ($i > 6; $i < $limit; $i++) {
            $seed = [
                'user_id' => $i,
                'role_id' => '5',
            ];
            
            DB::table('role_user')->insert($seed);   
        }
    }
}
