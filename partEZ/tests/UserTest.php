<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function startup()
    {
       $this->uid = User::max('uid');
    }

    public function testUserName()
    {
        $this->startUp();

        User::create(array('firstname' => 'Simon', 'lastname' => 'Milo', 'email' => 'simon@gmail.com'));
        $this->seeInDatabase('users', ['firstname' => 'Simon']);
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
        $this->startUp();

        $user = User::create(array('firstname'=>'Cap', 'lastname'=>'Reynolds', 'email'=>'mel@test.com'));
        $insertId = $user->uid;

        $this->assertTrue($insertId != null);
    }

    public function testUserUpdate()
    {
        $this->startUp();

        $user = User::create(['firstname'=>'Jayne', 'lastname'=>'Cobb', 'email'=>'jayne@notagirl.com']);
        $user->email = 'jaynenew@notagirl.com';
        $user->save();

        $this->seeInDatabase('users', ['email' => 'jaynenew@notagirl.com']);
    }

    public function testUserDelete()
    {
        $this->startUp();

        $user = User::create(array('firstname'=>'Wash', 'lastname'=>'Washburne', 'email'=>'wash@dinosaurs.com'));
        $user->delete();

        $this->notSeeInDatabase('users', ['firstname' => 'Wash']);
    }

    protected function tearDown()
    {
        if(is_null($this->uid))
        {
            $user = User::first();
            if(!is_null($user))
            {
                $user->delete();
            }
        }
        else
        {
            User::where('uid', '>', $this->uid)->delete();
        }
    }
}
