<?php

namespace App\Http\Controllers;

use Auth;
use Exception;
use Illuminate\Support\Facades\Session;
use App\Event;
use App\User;
use DB;
use Illuminate\Support\Facades\Request;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('events/create_event');
    }

    public function create()
    {
        return view('events.create');
    }


    public function store()
    {
        $input = Request::all();

        $event = new Event;

        $event->name = $input['name'];
        $event->location = $input['location'];
        $event->description = $input['description'];
        $event->date = $input['date'];
        $event->stime = $input['stime'];
        $event->etime = $input['etime'];
        $event->uid = Auth::user()['uid'];

        try
        {
            $saveflag = $event->save();
        }
        catch(Exception $e)
        {
            print '<script type="text/javascript">';
            print 'alert("The system has encountered an error please try again later")';
            print '</script>';
            return view('errors.error_event');
        }

        if($saveflag)
        {
            return view('events/success_event');
        }
    }


    public function inviteUsers()
    {
        $input = Request::all();

        $eventID = $input['eid'];
        $emails = $input['emails'];
        $users = []

        foreach ($emails as $email) {
            array_push($users, self::getUserByEmail($email));
        }


    }


    private function getUserByEmail($email)
    {
        $user = DB::table('users')->where('email', $email)->first();

        if (is_null($user))
        {
            $user = new User;

            $user->firstname = '';
            $user->lastname = '';
            $user->email = $email;
            $user->active = 0;

            $user->save();

            $user = DB::table('users')->where('email', $email)->first();
        }
            
        return $user;
    }


    private function buildInviteList($eid, $users)
    {
        $invites = (array) DB::table('invites')->select('uid')->where('eid', $eid);

        foreach ($users as $user)
        {
            if (!in_array($user['uid'], $invites)) 
            {
                // send invite
                // create invite record
            }
        }

    }

}
