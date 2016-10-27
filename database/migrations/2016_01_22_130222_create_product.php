<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->string('productcode',20)->index();
            $table->decimal('unitprice', 5, 2);
            $table->string('unittype', 10)->default('unit');
            $table->text('description')->nullable();
            // more than one comma separated, first image is the main one
            $table->text('images'); 
            $table->integer('id_type')->unsigned()->references('id')->on('producttypes')->onDelete('restrict');
            $table->boolean('in_stock')->default(true);
            // eventhough in stock user can decide not to offer this item
            $table->boolean('on_offer')->default(true);

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
        Schema::drop('product');
    }
}
