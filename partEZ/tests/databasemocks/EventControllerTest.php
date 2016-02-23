<?php
/**
 * Created by PhpStorm.
 * User: delroy
 * Date: 02/02/16
 * Time: 7:15 PM
 */

class EventControllerTest extends TestCase
{
    private $mock;
    private $eventController;

    public function __construct()
    {
        $this->mock = Mockery::mock('\App\PollOption');
        $this->eventController = new \App\Http\Controllers\EventController();
    }

    public function testGetInvites()
    {
        $data['eid'] = 1;
        $data['uid'] = 2;
        $data['response'] = 0;
        $this->mock->shouldReceive('getInvites')->once()->andReturn( $data );
        $this->app->instsance('\App\Invite', $this->mock);
        $this->assertEquals(1, $this->eventController->getInvites(1)->eid );
        $this->assertEquals(2, $this->eventController->getInvites(1)->uid );
        $this->assertEquals(0, $this->eventController->getInvites(1)->response );
    }

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
    }
}
