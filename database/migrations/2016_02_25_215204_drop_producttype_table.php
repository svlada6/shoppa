<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropProducttypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('producttypes');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('producttypes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('typename', 60);
            $table->text('description');
            $table->bigInteger('flags')->default(0);
            $table->timestamps();
        });
    }
}
