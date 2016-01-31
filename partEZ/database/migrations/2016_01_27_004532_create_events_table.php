<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Events', function (Blueprint $table) {
            $table->increments('eid')->unsigned();
            $table->integer('uid')->unsigned();
            $table->string('name');
            $table->string('location');
            $table->string('description');
            $table->string('date');
            $table->string('stime');
            $table->string('etime');
            $table->timestamps();
            $table->foreign('uid')->references('uid')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Events');
    }
}
