<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function startup()
    {
        $this->seed();
    }

    public function testUserRetrieval()
    {
        $this->startup();
        $user = User::find(1);
        $this->assertNotNull($user, 'The user could not be retrieved from the database.');
    }

    public function testUserName()
    {
        User::create(array('firstname' => 'Simon'));
        $this->seeInDatabase('users', ['firstname' => 'Simon']);
    }

    public function testGetAll()
    {
        $this->startup();

        $count = User::all()->count();
        $result = $count > 0;
        $this->assertTrue($result);
    }

    public function testSave()
    {
        $user = new User;
        $user->firstname = 'Mel';
        $user->save();

        $this->seeInDatabase('users', ['firstname' => 'Mel']);
    }

    public function testGetId()
    {
        $user = User::create(array('Cap', 'Reynolds'));
        $insertId = $user->uid;

        $this->assertTrue($insertId != null);
    }

    public function testUpdate()
    {
        $user = User::create(['Jayne', 'Cobb']);
        $user->email = 'jayne@notagirl.com';
        $user->save();

        $this->seeInDatabase('users', ['email' => 'jayne@notagirl.com']);
    }

    public function testDelete()
    {
        $user = User::create(array('Wash', 'Washburne'));
        $user->delete();

        $this->notSeeInDatabase('users', ['firstname' => 'Wash']);
    }
}
