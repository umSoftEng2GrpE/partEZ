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
        if (!Schema::hasTable('poll_options'))
        {
            Schema::create('poll_options', function (Blueprint $table) {
                $table->integer('oid')->unsigned();
                $table->integer('pid')->unsigned();
                $table->primary('oid', 'pid');
                $table->timestamps();
                $table->foreign('pid')->references('pid')->on('polls')->onDelete('cascade');
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
        if (Schema::hasTable('poll_options'))
        {
            Schema::drop('poll_options');
        }
    }
}
