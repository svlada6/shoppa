<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('id_type')->unsigned()->references('id')->on('product_types')->onDelete('restrict');
            $table->integer('id_vendor')->unsigned()->references('id')->on('product_vendors')->onDelete('restrict');            
            $table->decimal('price', 5, 2);
            $table->decimal('compare_price', 5, 2);
            $table->string('stock_keeping_unit');
            $table->string('barcode');
            $table->boolean('multiple_options')->default(true);
            $table->text('images');
            $table->string('meta_title');
            $table->string('meta_tags');
            $table->string('meta_description');
            $table->string('slug');
            $table->boolean('in_stock')->default(true);
            $table->boolean('on_offer')->default(true);
            $table->dateTime('visible_at');
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
        Schema::drop('products');
    }
}
