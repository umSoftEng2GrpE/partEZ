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
                $table->increments('oid');
                $table->integer('pid')->unsigned();
                $table->string('option');
                // $table->primary(array('oid', 'pid'));
                $table->timestamps();
                $table->foreign('pid')->references('pid')->on('polls')->onDelete('cascade');
            });

            DB::unprepared("ALTER TABLE `poll_options` DROP PRIMARY KEY, ADD PRIMARY KEY (  `oid` ,  `pid` )");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poll_options');
    }
}
