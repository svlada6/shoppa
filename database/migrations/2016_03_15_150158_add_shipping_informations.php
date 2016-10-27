<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShippingInformations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_informations', function (Blueprint $table) {

            $table->increments('id');
            $table->string('first_name',255);
            $table->string('last_name',255);
            $table->string('company',255);
            $table->string('address_1',255);
            $table->string('address_2',255);
            $table->string('city',255);
            $table->string('state',255);
            $table->string('postal',255);
       
            $table->integer('user_id')->unsigned()->references('id')->on('users')->onDelete('cascade');
            $table->integer('state_id')->unsigned()->references('id')->on('states')->onDelete('cascade');
            $table->timestamps();
      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipping_informations', function (Blueprint $table) {
            //
        });
    }
}
