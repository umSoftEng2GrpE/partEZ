<?php

namespace App\Console\Commands;

use App\Event;
use App\Invite;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailyNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends notifications to all invitees every day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $events = Event::all();
        $this->sendNotificationsToAllEventInvitees($events);
    }

    public function sendNotificationsToAllEventInvitees($events)
    {
        foreach ($events as $event)
        {
            $creator = User::find($event->uid);
            $date = $event->date;
            $invitees = Invite::getInvites($event->eid);
            $this->sendNotificationsToInviteeList($invitees, $creator->firstname, $date);
        }
    }

    public function sendNotificationsToInviteeList($invitees, $creators_name, $date)
    {
        foreach ($invitees as $invitee)
        {
            $this->sendSingleNotification($creators_name, $invitee->email, $date);
        }
    }

    public function sendSingleNotification($creators_name, $invitee_email, $date)
    {
        $email = array(
            'event_creator' => $creators_name,
            'date' => $date,
        );

        Mail::send('emails.daily_notification', $email, function ($message) use ($invitee_email) {
            $message->from(env('MAIL_USERNAME'), 'partEz');
            $message->to($invitee_email)->subject('Upcoming Event');
        });
    }
}
