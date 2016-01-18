<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;



class CreateDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('governorates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('governorate');
        });

        Schema::create('donors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 20);
            $table->string('last_name', 20);
            $table->string('phone', 20);
            $table->string('email', 50);
            $table->integer('blood_id')->unsigned();
            $table->integer('governorate_id')->unsigned();




            $table->timestamps();
        });
        Schema::table('donors', function (Blueprint $table) {


            $table->foreign('blood_id')->references('id')->on('bloods');
            $table->foreign('governorate_id')->references('id')->on('governorates');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('donors');
        Schema::drop('cities');

    }
}
