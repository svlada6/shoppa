<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use App\User;
use App\Product;
use DB;
use Cocur\Slugify\Slugify;
use Faker\Factory as Faker;

class FakerController extends AdminController
{

	public function seed_users()
	{
		$faker = Faker::create();

	    $limit = 100000;

	    for ($i = 0; $i < $limit; $i++) {
	        DB::table('users')->insert([
	            'name' => $faker->name,
	            'email' => $faker->email,
	            'password' => bcrypt('secret'),
	        ]);
	    }
	}


	public function seed_products()
	{
	    $limit = 100000;

	    for ($i = 0; $i < $limit; $i++) {
	        DB::table('products')->insert([
	            'name' => str_random(10),
	            'sub-name' => str_random(6),
	            'description' => str_random(50),
	            'id_type' => '1',
	            'id_vendor' => '1'
	        ]);
	    }
	}
}