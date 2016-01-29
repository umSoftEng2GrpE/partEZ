<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Poll_Responses', function (Blueprint $table) {
            $table->integer('uid')->unsigned();
            $table->integer('pid')->unsigned();
            $table->integer('oid')->unsigned();
            $table->primary('uid', 'pid', 'oid');
            $table->timestamps();

            $table->foreign('uid')->references('uid')->on('users')->onDelete('cascade');
            $table->foreign('pid')->references('pid')->on('Polls')->onDelete('cascade');
            $table->foreign('oid')->references('oid')->on('Poll_Options')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Poll_Responses');
    }
}
