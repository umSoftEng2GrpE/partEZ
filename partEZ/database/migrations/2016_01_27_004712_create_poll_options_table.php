<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Poll_Options', function (Blueprint $table) {
            $table->integer('oid')->unsigned();
            $table->integer('pid')->unsigned();
            $table->primary('oid', 'pid');
            $table->timestamps();
            $table->foreign('pid')->references('pid')->on('Polls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function   down()
    {
        Schema::drop('Poll_Options');
    }
}
