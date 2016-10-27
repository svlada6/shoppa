<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRightUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_right_user', function (Blueprint $table) {
          
            $table->integer('user_id')->unsigned();
            $table->integer('admin_right_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('admin_right_id')->references('id')->on('admin_rights')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'admin_right_id']);
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
        Schema::drop('admin_right_user');
    }
}
