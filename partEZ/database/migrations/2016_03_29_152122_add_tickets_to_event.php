<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTicketsToEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('events', 'hastickets'))
        {
            Schema::table('events', function ($table) {
                $table->boolean('hastickets');
                $table->integer('numtickets')->unsigned();  
                $table->double('ticketprice', 6, 2);     
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
        if (Schema::hasColumn('events', 'hastickets'))
        {
            Schema::table('events', function($table)
            {
                $table->dropColumn('hastickets');
                $table->dropColumn('numtickets');
                $table->dropColumn('ticketprice');
            });
        }
    }
}
