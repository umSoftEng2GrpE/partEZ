<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInvitesentToInvites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        if (!Schema::hasColumn('invites', 'inviteSent'))
        {
            Schema::table('invites', function($table){
                $table->boolean('inviteSent');
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
        if(Schema::hasColumn('invites', 'inviteSent'))
        {
            Schema::table('invites', function($table)
            {
                $table->dropColumn('inviteSent');
            });
        }     
    }
}
