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

    public function testInsert()
    {
        $this->startup();

        Event::create(array('name'=>'The Red Wedding', 'uid'=>'1'));
        $this->seeInDatabase('events', ['name'=>'The Red Wedding']);
    }

    public function testRetrieve()
    {
        $this->startup();

        $event = Event::create(array('name'=>'The Red Wedding', 'uid'=>'1'));
        $event = Event::find($event->eid);

        $this->assertNotNull($event, 'Could not retrieve event');
    }

    public function testUpdate()
    {
        $this->startup();

        $event = Event::create(array('name'=>'The Red Wedding', 'uid'=>'1'));
        $event->location = 'Castle Frey';

        $eid = $event->eid;
        $event->save();

        $event = Event::find($eid);
        $result = $event->location == 'Castle Frey';

        $this->assertTrue($result);
    }

    public function testDelete()
    {
        $this->startup();

        $event = Event::create(array('name'=>'The Red Wedding', 'uid'=>'1'));
        $event->delete();

        $this->notSeeInDatabase('events', array('name'=>'TheRedWedding'));
    }
}
