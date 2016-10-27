<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVariableEmail2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//         Schema::create('email_temp_email_var', function (Blueprint $table) {
//      
//            $table->integer('email_temp_id')->unsigned();
//            $table->integer('email_var_id')->unsigned();
//
//            $table->foreign('email_temp_id')->references('id')->on('email_temp')
//                ->onUpdate('cascade')->onDelete('cascade');
//            $table->foreign('email_var_id')->references('id')->on('email_var')
//                ->onUpdate('cascade')->onDelete('cascade');
//
//            $table->primary(['email_temp_id', 'email_var_id']);
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('variable_email2', function (Blueprint $table) {
            //
        });
    }
}
