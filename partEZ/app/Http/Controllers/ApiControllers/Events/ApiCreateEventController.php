<?php

namespace App\Http\Controllers\ApiControllers\Events;

use App\Http\Controllers\EventController;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use App\Poll;
use App\PollOption;
use Auth;

class ApiCreateEventController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
    public function submitEvent( Request $request )
    {
        $data = json_decode($request->getContent());
        $event = new Event();
        $event->name = $data->event->name;

        if (array_key_exists('public', $data->event)) {
            $event->public = true;
        }
        else
        {
            $event->public = '';
        }

        $event->location = $data->event->location;
        $event->description = $data->event->description;
        $event->date = $data->event->date;
        $event->stime = $data->event->stime;
        $event->etime = $data->event->etime;
        $event->uid = Auth::user()->uid;

        try
        {
            $saveflag = Event::saveEvent($event);
        }
        catch(Exception $e)
        {
            print '<script type="text/javascript">';
            print 'alert("The system has encountered an error please try again later")';
            print '</script>';
        }

        $this->validatePoll( $request, $event->eid );
        $this->splitEmails( $data->emails[0], $event->eid );
        ApiEventItemController::submitItems( $request, $event->eid);
    }

    public function splitEmails($emailstring, $eid)
    {
        $emails = array_map('trim', explode(',', $emailstring));
        EventController::inviteUsers($emails, $eid);
    }

    public function validatePoll( Request $request, $eid )
    {
        $data = json_decode($request->getContent());
        $pollArray = $data->polloptions;//json list of poll options

        if(!empty($pollArray))
        {
            $poll = new Poll();
            $poll->eid = $eid;
            $poll->polltype = 'date';
            $saveflag = $poll->save();

            if($saveflag)
            {
                foreach ($pollArray as $poll_index)
                {
                    $poll_options = new PollOption();
                    $poll_options->pid = $poll['pid'];
                    $poll_options->option = $poll_index->option;

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
                    }

                }
            }
            else
            {
                print '<script type="text/javascript">';
                print 'alert("Unable to save poll to database")';
                print '</script>';
            }
        }

    }
}
