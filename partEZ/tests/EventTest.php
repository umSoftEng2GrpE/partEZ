<?php

use App\Event;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EventTest extends TestCase
{
    use DatabaseMigrations;

    public function startup()
    {
        $this->seed();
    }

    public function setUpEventTest()
    {
        User::create(array('name'=>'Badger'));
    }

    public function testEventInsert()
    {
        $this->startup();

        Event::create(array('name'=>'The Red Wedding', 'uid'=>'5', 'location' => 'Winnipeg'));
        $this->seeInDatabase('events', ['name'=>'The Red Wedding']);
    }

    public function testEventRetrieve()
    {
        $this->startup();

        $event = Event::create(array('name'=>'The Red Wedding', 'uid'=>'4', 'location' => 'Winnipeg'));
        $event = Event::find($event->eid);

        $this->assertNotNull($event, 'Could not retrieve event');
    }

    public function testEventUpdate()
    {
        $this->startup();

        $event = Event::create(array('name'=>'The Red Wedding', 'uid'=>'3', 'location' => 'Winnipeg'));
        $event->location = 'Castle Frey';

        $eid = $event->eid;
        $event->save();

        $event = Event::find($eid);
        $result = $event->location == 'Castle Frey';

        $this->assertTrue($result);
    }

    public function testEventDelete()
    {
        $this->startup();

        $event = Event::create(array('name'=>'The Red Wedding', 'uid'=>'2', 'location' => 'Winnipeg'));
        $event->delete();

        $this->notSeeInDatabase('events', array('name'=>'TheRedWedding'));
    }
}
