<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('invites'))
        {
            Schema::create('invites', function (Blueprint $table) {
                $table->integer('eid')->unsigned();
                $table->integer('uid')->unsigned();
                $table->timestamps();
                $table->primary('eid', 'uid');
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
        if (Schema::hasTable('invites'))
        {
            Schema::drop('invites');
        }
    }
}
