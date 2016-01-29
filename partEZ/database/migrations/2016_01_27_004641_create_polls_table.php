<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Polls', function (Blueprint $table) {
            $table->increments('pid')->unsigned();
            $table->integer('eid')->unsigned();
            $table->string('polltype');
            $table->timestamps();
            $table->foreign('eid')->references('eid')->on('Events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Polls');
    }
}
