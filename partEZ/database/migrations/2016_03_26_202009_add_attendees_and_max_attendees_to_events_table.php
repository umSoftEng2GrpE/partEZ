<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttendeesAndMaxAttendeesToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('events', 'max_attendees'))
        {
            Schema::table('events', function ($table) {
                $table->string('max_attendees');
            });
        }

        if (!Schema::hasColumn('events', 'attendees'))
        {
            Schema::table('events', function ($table) {
                $table->string('attendees');
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
        if (Schema::hasColumn('events', 'max_attendees'))
        {
            Schema::table('events', function($table)
            {
                $table->dropColumn('max_attendees');
            });
        }
        if (Schema::hasColumn('events', 'attendees'))
        {
            Schema::table('events', function($table)
            {
                $table->dropColumn('attendees');
            });
        }
    }
}
