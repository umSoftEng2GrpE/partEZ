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
            $table->integer('eid');
            $table->integer('iid');
            $table->integer('uid');
            $table->string('description');
            $table->timestamps();

            $table->primary(array('eid', 'iid'));
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
