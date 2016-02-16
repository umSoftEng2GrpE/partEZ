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
        User::create(array('firstname' => 'Simon', 'email' => 'simon@gmail.com'));
        $this->seeInDatabase('users', ['firstname' => 'Simon']);
    }

    public function testUserGetAll()
    {
        $this->startup();

        $count = User::all()->count();
        $result = $count > 0;
        $this->assertTrue($result);
    }

    public function testUserSave()
    {
        $this->startup();

        $user = new User;
        $user->firstname = 'Mel';
        $user->email = 'mail@test.com';
        $user->save();

        $this->seeInDatabase('users', ['firstname' => 'Mel']);
    }

    public function testUserGetId()
    {
        $user = User::create(array('firstname'=>'Cap', 'lastname'=>'Reynolds', 'email'=>'mel@test.com'));
        $insertId = $user->uid;

        $this->assertTrue($insertId != null);
    }

    public function testUserUpdate()
    {
        $user = User::create(['firstname'=>'Jayne', 'lastname'=>'Cobb', 'email'=>'jayne@notagirl.com']);
        $user->save();

        $this->seeInDatabase('users', ['email' => 'jayne@notagirl.com']);
    }

    public function testUserDelete()
    {
        $user = User::create(array('firstname'=>'Wash', 'lastname'=>'Washburne', 'email'=>'wash@dinosaurs.com'));
        $user->delete();

        $this->notSeeInDatabase('users', ['firstname' => 'Wash']);
    }
}
