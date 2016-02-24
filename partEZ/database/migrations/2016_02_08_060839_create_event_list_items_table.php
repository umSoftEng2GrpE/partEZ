<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventListItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_list_items', function (Blueprint $table) {
            $table->increments('iid');
            $table->integer('eid');
            $table->integer('uid');
            $table->string('description');
            $table->timestamps();

            //$table->foreign('eid')->references('eid')->on('events')->onDelete('cascade');
            //$table->foreign('uid')->references('uid')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_list_items');
    }
}
