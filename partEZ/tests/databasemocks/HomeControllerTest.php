<?php
/**
 * Created by PhpStorm.
 * User: delroy
 * Date: 02/02/16
 * Time: 7:15 PM
 */

use App\Http\Controllers\HomeController;

class HomeControllerTest extends TestCase
{
    private $mock;
    private $controller;

    public function __construct()
    {
        $this->mock = Mockery::mock('\App\Event');
        $this->controller = new HomeController();
    }

    public function tearDown() {
        \Mockery::close();
    }

    public function testGetUsersEvents()
    {

        $this->mock->shouldReceive('getByUID')->once()->andReturn(1);
        $this->app->instance('\App\Event', $this->mock);
        $response = $this->controller->getUsersEvents();
        $this->assertEquals(1, $response->eid);

    }
}
