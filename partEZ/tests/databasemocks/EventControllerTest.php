<?php
/**
 * Created by PhpStorm.
 * User: delroy
 * Date: 02/02/16
 * Time: 7:15 PM
 */

class EventControllerTest extends TestCase
{
    private $pollMock;
    private $inviteMock;
    private $eventMock;
    private $controllerMock;

    public function setUp() {
        parent::setUp();
        $this->pollMock = Mockery::mock('\App\Poll');
        $this->inviteMock = Mockery::mock('\App\Invite');
        $this->eventMock = Mockery::mock('App\Event');
        $this->controllerMock = Mockery::mock('\App\Http\Controllers\EventController');
    }

    public function testGetPollOptions()
    {/*
        $this->mock->shouldReceive('getPollOptions')->once()->with(1)->andReturn(2);
        $this->app->instance('\App\PollOption', $this->mock);
        $response = $this->mock->getPollOptions(1);
        $this->assertEquals( 2, $response );*/
    }

    public function testGetInvites()
    {
        $data['eid'] = 1;
        $data['uid'] = 2;
        $data['response'] = 0;
        $this->inviteMock->shouldReceive('getInvites')->once()->with(1)->andReturn( $data );
        $this->app->instance('\App\Http\Controllers\EventController', $this->inviteMock);
        $response = $this->inviteMock->getInvites(1);
        //$response = \App\Http\Controllers\EventController::get
        $this->assertEquals( 0, $response['eid']);
        //$this->assertEquals(1, $this->eventController->getInvites(1)->eid );
        //$this->assertEquals(2, $this->eventController->getInvites(1)->uid );
        //$this->assertEquals(0, $this->eventController->getInvites(1)->response );
    }

    public function testDetails()
    {
        $event = new \App\Event();
        $poll = new \App\Poll();
        $invitee['email'] = "d@gmail.com";
        $invitee['uid'] = 1;
        $this->eventMock->shouldReceive('getEvent')->with(1)->andReturn($event);
        $this->pollMock->shouldReceive('getEventPolls')->with(1)->andReturn(array($poll));
        $this->inviteMock->shouldReceive('getInvitees')->with(1)->andReturn($invitee);
        $this->controllerMock->shouldReceive('details')->once()->with(1);
        $this->app->instance('\App\Event', $this->eventMock);
        $this->app->instance('\App\Poll', $this->pollMock);
        $this->app->instance('\App\Invite', $this->inviteMock);
        $this->call('GET', 'EventController@details');
        //$response = $this->controllerMock->details(1);
        $this->assertViewHas('EventController@details');
        //$response = $this->call('POST', 'EventController@details');
        //$response = $this->call()
    }
/*
    public function testStore()
    {
        $this->mock->shouldReceive('store')->once();
        $this->app->instance('\App\Event', $this->mock);
        $response = $this->call('GET', 'EventController@store');
        var_dump( $response->getContent() );
    }

    public function testSubmitPoll()
    {
        $this->mock->shouldReceive('submitPoll')->once();
        $this->app->instance('\App\PollResponse', $this->mock);
        $response = $this->call('GET', 'EventController@submitPoll');
        var_dump( $response->getContent() );
    }*/
}
