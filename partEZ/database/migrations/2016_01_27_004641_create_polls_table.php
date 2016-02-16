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
        if (!Schema::hasTable('polls'))
        {
            Schema::create('polls', function (Blueprint $table) {
                $table->increments('pid')->unsigned();
                $table->integer('eid')->unsigned();
                $table->string('polltype');
                $table->timestamps();
                $table->foreign('eid')->references('eid')->on('events')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('polls'))
        {
            Schema::drop('polls');
        }
    }
}
