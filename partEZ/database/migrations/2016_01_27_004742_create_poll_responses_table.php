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
        if (!Schema::hasTable('poll_responses'))
        {
            Schema::create('poll_responses', function (Blueprint $table) {
                $table->integer('uid')->unsigned();
                $table->integer('pid')->unsigned();
                $table->integer('oid')->unsigned();
                $table->primary(['uid', 'pid', 'oid']);
                $table->timestamps();
                $table->foreign('uid')->references('uid')->on('users')->onDelete('cascade');
                $table->foreign('pid')->references('pid')->on('polls')->onDelete('cascade');
                $table->foreign('oid')->references('oid')->on('poll_options')->onDelete('cascade');
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
        if (Schema::hasTable('poll_responses'))
        {
            Schema::drop('poll_responses');
        }
    }
}
