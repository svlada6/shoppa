<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('package');
          
            $table->integer('user_id')->unsigned()->references('id')->on('users')->onDelete('cascade');
            $table->integer('subscription_id')->unsigned()->references('id')->on('subscriptions')->onDelete('cascade');
            $table->string('name');
            $table->string('price');
            $table->string('shipping_first_name');
            $table->string('shipping_last_name');
            $table->string('shipping_company');
            $table->string('shipping_address_1');
            $table->string('shipping_address_2');
            $table->string('shipping_city');
            $table->string('shipping_state');
            $table->string('shipping_postal');
         

            $table->string('billing_first_name');
            $table->string('billing_last_name');
            $table->string('billing_company');
            $table->string('billing_address_1');
            $table->string('billing_address_2');
            $table->string('billing_city');
            $table->string('billing_state');
            $table->string('billing_postal');
       

            $table->double('subtotal');
            $table->integer('billing_state_id')->unsigned()->references('id')->on('users')->onDelete('cascade');
            $table->integer('shipping_state_id')->unsigned()->references('id')->on('users')->onDelete('cascade');
     
        
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
        Schema::drop('orders');
    }
}
