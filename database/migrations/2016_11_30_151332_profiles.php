<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Profiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::enableForeignKeyConstraints();

        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->unsigned();
            $table->date('bday');
            $table->string('contact');
            $table->string('address');
            $table->integer('transactions');
            $table->timestamps();
        });

        Schema::table('profiles', function($table) {
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });

        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profiles');
        //
    }
}
