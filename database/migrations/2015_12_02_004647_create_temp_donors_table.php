<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempdonors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 20);
            $table->string('last_name', 20);
            $table->string('phone', 20);
            $table->string('email', 50);
            $table->integer('blood_id')->unsigned();
            $table->integer('governorate_id')->unsigned();
            $table->text('confirm_code');




            $table->timestamps();
        });
        Schema::table('tempdonors', function (Blueprint $table) {


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
        Schema::drop('tempdonors');
    }
}
