<?php

use App\User;
use App\Event;
use App\Poll;
use App\PollOption;
use App\PollResponse;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PollResponsesTest extends TestCase
{
    use DatabaseMigrations;

    public function startUp()
    {
        $this->user = User::create(array('firstname' => 'Simon', 'email' => 'simon2@gmail.com'));
        $this->event = Event::create(array('name'=>'The Red Wedding', 'uid'=>$this->user->uid, 'location' => 'Winnipeg'));
        $this->poll = Poll::create(array('eid'=>$this->event->eid, 'polltype'=>'test_type'));
        $this->pollOption = PollOption::create(array('option'=>'some option', 'pid'=>$this->poll->pid));
    }

    public function testInsertPollResponse()
    {
        $this->startup();
        PollResponse::unguard(true);

        $poll_response = PollResponse::create(array('uid'=>$this->user->uid, 'pid'=>$this->poll->pid, 'oid'=>$this->pollOption->oid));
        $poll_response->save();

        $this->seeInDatabase('poll_responses', array('uid'=>$this->user->uid));
    }

    public function testDeletePollResponse()
    {
        $this->startup();
        PollResponse::unguard(true);

        $poll_response = PollResponse::create(array('uid'=>$this->user->uid, 'pid'=>$this->poll->pid, 'oid'=>$this->pollOption->oid));
        $poll_response->save();

        DB::table('poll_responses')->where('uid', '=', $this->user->uid)->delete();

        $this->notSeeInDatabase('poll_responses', array('uid'=>$this->user->uid));

    }

    protected function tearDown()
    {
        
        PollResponse::where('pid', $this->pollOption->oid)->delete();

        PollOption::where('oid', $this->pollOption->oid)->delete();
        Poll::where('pid', $this->poll->pid)->delete();
        Event::where('eid', $this->event->eid)->delete();
        User::where('uid', $this->user->uid)->delete();

    }
}
