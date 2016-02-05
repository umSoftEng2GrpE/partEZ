<?php

use App\PollOption;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PollOptionsTest extends TestCase
{

    use DatabaseMigrations;

    public function teststartup()
    {
        $this->seed();
    }

    public function testFindPollOption()
    {
        $this->startup();

        $poll_options = PollOption::all();
        $this->assertNotNull($poll_options);
    }

    public function testInsertPollOption()
    {
        $this->startup();

    }

    public function testUpdatePollOption()
    {
        $this->startup();

        $poll_option = new PollOption;
        $poll_option->option = "some option";
        $poll_option->pid = '1';
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
        $poll_option->pid = '1';
        $poll_option->save();

        $this->seeInDatabase('poll_options', array('option'=>'some option'));
    }

    public function testDeletePollOption()
    {
        $this->startup();


        $poll_option = new PollOption;
        $poll_option->option = "some option";
        $poll_option->pid = '1';
        $poll_option->save();
        $poll_option->delete();

        $this->notSeeInDatabase('poll_options', array('option'=>'some option'));
    }
}
