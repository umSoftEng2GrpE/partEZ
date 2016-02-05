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

    public function testCreateEvent()
    {
        self::testAccountCreation();

        $this->visit('/create_event')
            ->seePageIs('/create_event');

        //Event Details
        $this->type('Party Hardy', 'name')
            ->type('My House', 'location')
            ->type('Feb 5', 'date')
            ->type('5:00pm', 'stime')
            ->type('12:00am', 'etime')
            ->type('This is a fun party!', 'description')
            ->press('Next');

        //Date/time Flexibility
        $this->see('Create A Poll')
            ->type('3:00pm', 'date1')
            ->type('4:00pm', 'date2')
            ->type('5:00pm', 'date3')
            ->type('6:00pm', 'date4')
            ->press('Next');

        //Invite People
        $this->see("Invite Guests")
            ->type($this->partEzEmail, 'emails')
            ->press('Submit')
            ->seePageIs('/invite_event');

        //Event Invitations
        $user = DB::table('users')
            ->join('invites', 'invites.uid', '=', 'users.uid')
            ->select('users.email')
            ->where('users.email', '=', $this->partEzEmail)
            ->pluck('email'); 
        $retrievedInvite = $user[0];
        $this->assertEquals($this->partEzEmail, $retrievedInvite);
            
        $this->visit('/home')
            ->see('Party Hardy');
    }

    public function testInviteResponse()
    {
        self::testCreateEvent();

        //Response Accessibility
        $invite = DB::table('users')
            ->join('invites', 'invites.uid', '=', 'users.uid')
            ->select('users.uid', 'eid')
            ->where('email', '=', $this->partEzEmail)
            ->get(); 
        $retrievedUID = $invite[0]->uid;
        $retrievedEID = $invite[0]->eid;
        $linkString = '/accept_invite' . '/' . $retrievedEID . '/' . $retrievedUID;

        //Invitations
        $this->visit($linkString)
                ->seePageIs('/invite_response')
                ->see('You\'ve successfully responded to this invitation!');

        $invite = DB::table('users')
            ->join('invites', 'invites.uid', '=', 'users.uid')
            ->select('status')
            ->where('email', '=', $this->partEzEmail)
            ->pluck('status');
        $retrievedResponse = $invite[0];
        $this->assertEquals($retrievedResponse, 'accepted');

    }

    public function testEventDetails()
    {
        self::testInviteResponse();

        $this->visit('/home')
            ->press('Details')
            ->see('Party Hardy');

        //Invitee Lists
        $this->see($this->partEzEmail);

        //Invitee Convenience
        $this->press('Submit Vote')
            ->seePageIs('/submit_poll');
    }
}
