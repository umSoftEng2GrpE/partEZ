<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPublicFlagToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('events', 'public'))
        {
            Schema::table('events', function ($table) {
                $table->boolean('public');
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
        if (Schema::hasColumn('events', 'public'))
        {
            Schema::table('events', function($table)
            {
                $table->dropColumn('public');
            });
        }
    }
}
