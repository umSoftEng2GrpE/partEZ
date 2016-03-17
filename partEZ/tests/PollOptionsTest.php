<?php

use App\User;
use App\Event;
use App\Poll;
use App\PollOption;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PollOptionsTest extends TestCase
{

    use DatabaseMigrations;

    public function startup()
    {
        $this->user = User::create(array('firstname' => 'Simon', 'email' => 'simon2@gmail.com'));
        $this->event = Event::create(array('name'=>'The Red Wedding', 'uid'=>$this->user->uid, 'location' => 'Winnipeg'));
        $this->poll = Poll::create(array('eid'=>$this->event->eid, 'polltype'=>'test_type'));

        $this->lastPollOption = PollOption::max('oid');
    }

    public function testInsertPollOption()
    {
        $this->startup();

        $poll_option = new PollOption;
        $poll_option->option = "some option";
        $poll_option->pid = $this->poll->pid;
        $poll_option->save();

        $this->seeInDatabase('poll_options', array('option'=>'some option'));

    }

    public function testUpdatePollOption()
    {
        $this->startup();

        $poll_option = new PollOption;
        $poll_option->option = "some option";
        $poll_option->pid = $this->poll->pid;
        $poll_option->save();

        $poll_option->option = 'some other option';
        $poll_option->save();

        $this->seeInDatabase('poll_options', array('option'=>'some other option'));
    }

    public function testSavePollOption()
    {
        $this->startup();

        $poll_option = new PollOption;
        $poll_option->option = "some option";
        $poll_option->pid = $this->poll->pid;
        $poll_option->save();

        $this->seeInDatabase('poll_options', array('option'=>'some option'));
    }

    public function testDeletePollOption()
    {
        $this->startup();


        $poll_option = new PollOption;
        $poll_option->option = "some option";
        $poll_option->pid = $this->poll->pid;
        $poll_option->save();
        $poll_option->delete();

        $this->notSeeInDatabase('poll_options', array('option'=>'some option'));
    }

    protected function tearDown()
    {
        if(is_null($this->lastPollOption))
        {
            $option = PollOption::first();
            if(!is_null($option))
            {
                $option->delete();
            }
        }
        else
        {
            PollOption::where('oid', '>', $this->lastPollOption)->delete();
        }

        Poll::where('pid', $this->poll->pid)->delete();
        Event::where('eid', $this->event->eid)->delete();
        User::where('uid', $this->user->uid)->delete();

    }
}
