<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('order_product', function (Blueprint $table) {
//
//            $table->string('name');
//            $table->integer('quantity');
//        });
//
//           Schema::table('orders', function (Blueprint $table) {
//                $table->double('subtotal');
//                $table->foreign('billing_state_id')->references('id')->on('states')->onDelete('cascade');
//                $table->foreign('shipping_state_id')->references('id')->on('states')->onDelete('cascade');
//        });
//
//        Schema::table('users', function($table)
//	{
//	    DB::statement('ALTER TABLE orders MODIFY COLUMN name DOUBLE(11)');
//	});
//
//        Schema::table('collection_order', function (Blueprint $table) {
//
//            $table->string('name');
//            $table->integer('quantity');
//        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_product', function (Blueprint $table) {
            //
        });
    }
}
