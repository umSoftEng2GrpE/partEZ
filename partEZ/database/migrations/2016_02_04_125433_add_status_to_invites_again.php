<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToInvitesAgain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('invites', 'status'))
        {
            Schema::table('invites', function($table){
                $table->enum('status', array('pending', 'accepted', 'declined'));
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
        if (Schema::hasColumn('invites', 'status'))
        {
            Schema::table('invites', function($table)
            {
                $table->dropColumn('status');
            });
        }
    }
}