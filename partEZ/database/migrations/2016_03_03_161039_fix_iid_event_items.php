<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixIidEventItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('event_list_items'))
        {
            Schema::drop('event_list_items');
        }
        
        Schema::create('event_list_items', function (Blueprint $table) {
            $table->increments('iid')->unsigned();
            $table->integer('eid');
            $table->integer('uid');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
