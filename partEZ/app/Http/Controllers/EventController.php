<?php

namespace App\Http\Controllers;

use App\PollResponse;
use DB;
use Auth;
use Mail;
use Exception;
use App\Event;
use App\User;
use App\Invite;
use App\Poll;
use App\PollOption;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\MessageController;

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
     * Show the create event screen.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('events/create_event')
            ->with('user_email', Auth::user()['email']);
    }

    /**
     * Show the detail screen for an event.
     *
     * @return \Illuminate\Http\Response
     */
    public function details($eid)
    {
        $event = Event::getEvent($eid);
        $invites = Self::getInvitesFromEid($eid);
        $all_poll_options = Self::getPollOptionsFromEid($eid);
        $chat_messages = MessageController::getMessagesFromEid($eid);

        return view('events/event_details')
            ->with('event', $event)
            ->with('all_options', $all_poll_options)
            ->with('invites', $invites)
            ->with('chat_messages', $chat_messages);
    }

    public function getPollOptionsFromEid($eid)
    {
        $event = Event::find($eid);
        //Retrieving Polls for Display
        $polls = Poll::getEventPolls($eid);
        $all_poll_options = [];
        foreach ($polls as $poll)
        {
            $options = [];

            if(null != $poll)
            {
                $options = PollOption::getPollOptions($poll->pid);
            }

            array_push($all_poll_options, $options);
        }
        return $all_poll_options;
    }

    public function getInvitesFromEid($eid)
    {
        $invites = [];
        //Retrieving Invitees for Display
        $inviteDB = Invite::getInvitees($eid);

        foreach ($inviteDB as $entry)
        {
            array_push($invites, $entry->email);
        }

        return $invites;
    }

    public function inviteDetails($eid)
    {
        $event = Event::find($eid);
        $invites = Self::getInvitesFromEid($eid);
        $all_poll_options = Self::getPollOptionsFromEid($eid);
        $chat_messages = MessageController::getMessagesFromEid($eid);

        return view('events/event_details_invite')
            ->with('event', $event)
            ->with('all_options', $all_poll_options)
            ->with('invites', $invites)
            ->with('chat_messages', $chat_messages);
    }

    public function create()
    {
        return view('events.create');
    }

    public function submitPoll()
    {
        $input = Request::all();
        $uid = Auth::user()['uid'];
        array_shift($input);
        $pid = array_shift($input);

        foreach ($input as $key => $value)
        {
            $pollResponse = new PollResponse();
            $pollResponse->pid = $pid;
            $pollResponse->uid = $uid;
            $pollResponse->oid = $value;
            try
            {
            $pollResponse->save();
            }
            catch (Exception $e)
            {
                print '<script type="text/javascript">';
                print 'alert("The system has encountered an error please try again later")';
                print '</script>';
                return view('errors.error_event');
            }
        }

        return view('events/success_event');

    }

    public function store()
    {
        $input = Request::all();
        var_dump($input);

        $event = new Event;

        $event->name = $input['name'];
        $event->public = $input['public'];
        $event->location = $input['location'];
        $event->description = $input['description'];
        $event->date = $input['date'];
        $event->stime = $input['stime'];
        $event->etime = $input['etime'];
        $event->uid = Auth::user()['uid'];

        try
        {
            $saveflag = Event::saveEvent($event);
        }
        catch(Exception $e)
        {
            print '<script type="text/javascript">';
            print 'alert("The system has encountered an error please try again later")';
            print '</script>';
            return view('errors.error_event');
        }

        $this->validatePoll( $event->eid );
        $this->splitEmails( $event->eid );

        if($saveflag)
        {
            return view('events/success_event');
        }
    }

    public function splitEmails($eid)
    {
        $input = Request::all();
        $emails = $input['email-list'];

        $emails = array_map('trim', explode(',', $emails));
        self::inviteUsers($emails, $eid);
        return view('events/success_event');
    }

    public function validatePoll( $eid )
    {
        $input = Request::all();
        $uid = Auth::user()['uid'];
        $poll = new Poll;
        $pollArray = [];

        if(!empty($input['date1']))
            array_push( $pollArray, $input['date1']);
        if(!empty($input['date2']))
            array_push( $pollArray, $input['date2']);
        if(!empty($input['date3']))
            array_push( $pollArray, $input['date3']);
        if(!empty($input['date4']))
            array_push( $pollArray, $input['date4']);

        if(!empty($pollArray))
        {


            $poll->eid = $eid;
            $poll->polltype = $input['type'];
            $saveflag = $poll->save();

            if($saveflag)
            {
                foreach ($pollArray as $poll_index)
                {
                    $poll_options = new PollOption();
                    $poll_options->pid = $poll['pid'];
                    $poll_options->option = $poll_index;

                    try
                    {
                        PollOption::savePollOption($poll_options);
                    }
                    catch(Exception $e)
                    {
                        print '<script type="text/javascript">';
                        print 'alert( There have been issues adding options to your poll please
                        check home page for details)';
                        print '</script>';
                        return view('events/invite_event');
                    }

                }
            }
            else
            {
                print '<script type="text/javascript">';
                print 'alert("Unable to save poll to database")';
                print '</script>';
                return view('events/create_poll');
            }
        }
        return view('events/invite_event')
            ->with('eventID', $eid);

    }

    public function inviteUsers($emails, $eid)
    {
        $uid = Auth::user()['uid'];
        $users = [];

        foreach($emails as $email)
        {
            array_push($users, User::getByEmail($email));
        }

        $invites = self::getInvites($eid);

        foreach ($users as $user)
        {

            if (!in_array($user->uid, $invites))
            {
                Invite::createInviteLog($eid, $user->uid);
                self::sendInvitation($eid, $user->email, $user->uid);
            }

        }
    }

    private function getInvites($eid)
    {
        $inviteDB = Invite::getInvites($eid);
        $invites = [];

        foreach ($inviteDB as $entry)
        {
            array_push($invites, $entry->uid);
        }

        return $invites;
    }

    public function sendInvitation($eid, $email, $uid)
    {
        $event = Event::getById($eid);
        $data = array(
            'eventname' => $event->name,
            'date' => $event->date,
            'stime' => $event->stime,
            'etime' => $event->etime,
            'location' => $event->location,
            'description' => $event->description,
            'eid' => $eid,
            'uid' => $uid,
        );

        Mail::send('emails.invitation', $data, function ($message) use ($email) {
            $message->from(env('MAIL_USERNAME'), 'partEz');
            $message->to($email)->subject('Event Invitation');

        });
    }

    public function inviteAccept($eid, $uid) 
    {
        Invite::changeStatus($eid, $uid, "accepted");

        return redirect('invite_response');
    }

    public function inviteDecline($eid, $uid)
    {
        Invite::changeStatus($eid, $uid, "declined");

        return redirect('invite_response');
    }
}
