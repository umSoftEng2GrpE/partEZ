<?php

use App\Poll;
use App\Event;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PollTest extends TestCase
{

    use DatabaseMigrations;

    public function startup()
    {       
        $this->user = User::create(array('firstname' => 'Simon', 'email' => 'simon2@gmail.com'));
        $this->event = Event::create(array('name'=>'The Red Wedding', 'uid'=>$this->user->uid, 'location' => 'Winnipeg'));
    
        $this->lastPoll = Poll::max('pid');
    }

    public function testRetrievePoll()
    {
        $this->startup();

        $poll = new Poll;
        $poll->eid = $this->event->eid;
        $poll->polltype = 'test_type';

        $poll->save();

        $this->seeInDatabase('polls', array('polltype'=>'test_type'));
    }

    public function testUpdatePoll()
    {
        $this->startup();

        $poll = Poll::create(array('eid'=>$this->event->eid, 'polltype'=>'test_type'));

        $poll->polltype = 'some_other_type';
        $poll->save();

        $this->seeInDatabase('polls', array('polltype'=>'some_other_type'));
    }

    public function testDeletePoll()
    {
        $this->startup();

        $poll = Poll::create(array('eid'=>$this->event->eid, 'polltype'=>'delete_me'));

        $poll->delete();

        $this->notSeeInDatabase('polls', array('polltype'=>'delete_me'));
    }

    protected function tearDown()
    {
        if(is_null($this->lastPoll))
        {
            $poll = Poll::first();
            if(!is_null($poll))
            {
                $poll->delete();
            }
        }
        else
        {
            Poll::where('pid', '>', $this->lastPoll)->delete();   
        }

        Event::where('eid', $this->event->eid)->delete();
        User::where('uid', $this->user->uid)->delete();
    }
}
