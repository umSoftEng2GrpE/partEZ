<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('messages'))
        {
            Schema::create('messages', function (Blueprint $table) {
                $table->increments('mid')->unsigned();
                $table->integer('eid')->unsigned();
                $table->integer('uid')->unsigned();
                $table->string('message');
                $table->datetime('created');
                $table->foreign('eid')->references('eid')->on('events')->onDelete('cascade');
                $table->foreign('uid')->references('uid')->on('users')->onDelete('cascade');
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
        if (Schema::hasTable('messages'))
        {
            Schema::drop('messages');
        }
    }
}
