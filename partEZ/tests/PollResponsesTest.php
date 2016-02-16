<?php

use App\PollResponse;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PollResponsesTest extends TestCase
{
    use DatabaseMigrations;

    public function testFindPollResponse()
    {
        $responses = PollResponse::all();

        $this->assertNotNull($responses);
    }

    public function testInsertPollResponse()
    {
        $this->startup();
        PollResponse::unguard(true);

        $poll_response = PollResponse::create(array('uid'=>'1', 'pid'=>'1', 'oid'=>'1'));
        $poll_response->save();

        $this->seeInDatabase('poll_responses', array('uid'=>'1'));
    }

    public function testUpdatePollResponse()
    {
        $this->startup();
        PollResponse::unguard(true);

        $poll_response = PollResponse::create(array('uid'=>'2', 'pid'=>'1', 'oid'=>'1'));
        $poll_response->save();

        DB::table('poll_responses')
            ->where('uid', 2)
            ->update(array('uid' => 5));

        $this->seeInDatabase('poll_responses', array('uid'=>'5'));

    }

    public function testDeletePollResponse()
    {
        $this->startup();
        PollResponse::unguard(true);

        $poll_response = PollResponse::create(array('uid'=>'3', 'pid'=>'1', 'oid'=>'1'));
        $poll_response->save();

        $poll_response->uid = '-5';
        DB::table('poll_responses')->where('uid', '=', 3)->delete();

        $this->notSeeInDatabase('poll_responses', array('uid'=>'3'));

    }
}
