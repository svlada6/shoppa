<?php

use Illuminate\Database\Seeder;

class AdminRightsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
               $seed = [
            ['id' => 1, 'name' => 'Dashboard'],
            ['id' => 2, 'name' => 'Faq'],
            ['id' => 3, 'name' => 'Pages'],
            ['id' => 4, 'name' => 'Blog Posts'],
            ['id' => 5, 'name' => 'Post Categories'],
            ['id' => 6, 'name' => 'Faq Categories'],
            ['id' => 7, 'name' => 'Products'],
            ['id' => 8, 'name' => 'Blog Posts'],
            ['id' => 9, 'name' => 'Settings'],
        ];
        DB::table('admin_rights')->insert($seed);
    

    }
}
