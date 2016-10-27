<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(AdminRightsSeeder::class);
        // $this->call(RolesSeeder::class);
        // $this->call(FaqCategoriesSeeder::class);
        // $this->call(FaqSeeder::class);
        // $this->call(PostCategorySeeder::class);
        // $this->call(PostSeeder::class);
        // $this->call(MenuSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
