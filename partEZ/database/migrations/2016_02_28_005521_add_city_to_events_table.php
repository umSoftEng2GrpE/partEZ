<?php

use Illuminate\Database\Migrations\Migration;

class AddCityToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('events', 'city'))
        {
            Schema::table('events', function ($table) {
                $table->string('city');
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
        if (Schema::hasColumn('events', 'city'))
        {
            Schema::table('events', function($table)
            {
                $table->dropColumn('city');
            });
        }
    }
}
