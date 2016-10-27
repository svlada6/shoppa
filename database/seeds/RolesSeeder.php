<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
       public function run()
    {
               $seed = [
            ['id' => 1, 'name' => 'Backend Admin','display_name'=>'Backend Admin','description'=>'The backend system to manage all Orders, Customers, Products, Collections, Discounts, Reports, Blog, Pages, FAQ, Emails, Settings'],
            ['id' => 2, 'name' => 'Customer Admin','display_name'=>'Customer Admin','description'=>'Custom backend system for customer to view order history, manage subscription of products, referal system, update billing/shipping/password, gifting and viewing FAQs'],
            ['id' => 3, 'name' => 'Fulfillment Admin','display_name'=>'Fulfillment Admin','description'=>'The backend system limited to searching, viewing, managing Orders, Customers '],
            ['id' => 4, 'name' => 'Support Admin','display_name'=>'Support Admin','description'=>'The backend system limited to searching, viewing, managing Orders, Customers, Discounts, FAQ'],
            ['id' => 5, 'name' => 'Regular User','display_name'=>'Regular User','description'=>'Registred on the site'],
          
        ];
        DB::table('roles')->insert($seed);
    

    }
}
