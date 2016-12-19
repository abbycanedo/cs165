<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::enableForeignKeyConstraints();

        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id');
            $table->integer('transaction_no');
            $table->integer('product_id');
            $table->boolean('active');  //0-submitted 1-ongoing
        });

    }

     /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('carts');
        //
    }
}
