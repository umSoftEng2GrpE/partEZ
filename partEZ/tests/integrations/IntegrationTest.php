<?php

use App\Event;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IntegrationTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->email = 'stewdent@email.com';
        $this->password = 'password123';
        $this->partEzEmail = 'partezapp@gmail.com';
    }

    public function testAccountCreation()
    {
        //Account Creation
        $this->visit('/')
            ->click('Register')
            ->seePageIs('/register');

        $this->visit('/register')
            ->type('Stew', 'firstname')
            ->type('Dent', 'lastname')
            ->type($this->email, 'email')
            ->type($this->password, 'password')
            ->type($this->password, 'password_confirmation')
            ->press('Register');


        $this->seePageIs('/home')
            ->see('You are logged in!');

        $user = DB::table('users')
            ->select('email')
            ->where('email', '=', $this->email)
            ->pluck('email');
        $retrievedEmail = $user[0];
        $this->assertEquals($this->email, $retrievedEmail);

    }

    public function testLogging()
    {
       self::testAccountCreation();

        $this->visit('/home')
            ->click('name_menu')
            ->click('Logout')
            ->seePageIs('/')
            ->see('Welcome!');

        $this->visit('/')
            ->click('Login')
            ->type($this->email, 'email')
            ->type($this->password, 'password')
            ->check('remember')
            ->press('Login')
            ->seePageIs('/home');
    }

    public function tearDown()
    {
        DB::table('users')
            ->where('email', '=', $this->email)
            ->orwhere('email', '=', $this->partEzEmail)
            ->delete();
    }


}
