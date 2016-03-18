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

    public function testEventCreation()
    {
        self::testAccountCreation();

        $this->visit('/home')
            ->click('event_button')
            ->type('Test Event Integration', 'name')
            ->type('Convention Center', 'location')
            ->type('Winnipeg', 'city')
            ->press('creEvent');

        $this->click('return_home')
            ->seePageIs('/home')
            ->see('Test Event Integration');

        DB::table('events')
            ->where('name', 'Test Event Integration')
            ->delete();
    }

    public function testEventDetails()
    {
        self::testAccountCreation();

        $this->visit('/home')
            ->click('event_button')
            ->type('Test Event Integration', 'name')
            ->type('Convention Center', 'location')
            ->type('Winnipeg', 'city')
            ->press('creEvent');

        $this->click('return_home')
            ->seePageIs('/home')
            ->see('Test Event Integration');

        $this->click('details_btn')
            ->see('Test Event Integration');

        DB::table('events')
            ->where('name', 'Test Event Integration')
            ->delete();
    }

    public function testEventEdit()
    {
        self::testAccountCreation();

        $this->visit('/home')
            ->click('event_button')
            ->type('Test Event Integration', 'name')
            ->type('Convention Center', 'location')
            ->type('Winnipeg', 'city')
            ->press('creEvent');

        $this->click('return_home')
            ->seePageIs('/home')
            ->see('Test Event Integration');

        $this->click('edit_btn')
            ->type('Test Event Integration 2', 'name')
            ->press('save_event');

        $this->visit('/home')
            ->see('Test Event Integration 2');

        DB::table('events')
            ->where('name', 'Test Event Integration')
            ->delete();
    }

    public function testEventDeletion()
    {
       self::testAccountCreation();

        $this->visit('/home')
            ->click('event_button')
            ->type('Test Event Integration', 'name')
            ->type('Convention Center', 'location')
            ->type('Winnipeg', 'city')
            ->press('creEvent');

        $this->click('return_home')
            ->seePageIs('/home')
            ->see('Test Event Integration');
            
        $this->click('delete_btn')
            ->see('You have successfully deleted the event!'); 
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
