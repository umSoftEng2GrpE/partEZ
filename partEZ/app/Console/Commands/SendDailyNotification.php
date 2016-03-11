<?php

namespace App\Console\Commands;

use App\Event;
use App\Invite;
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
            $invitees = Invite::getInvites($event->eid);
            $this->sendNotificationsToInviteeList($invitees);
        }
    }

    public function sendNotificationsToInviteeList($invitees)
    {
        foreach ($invitees as $invitee)
        {
            $this->sendSingleNotification($invitee->email);
        }
    }

    public function sendSingleNotification($invitee_email)
    {
        $email = array(
            'event_creator' => 'Somebody',
        );

        Mail::send('emails.notification', $email, function ($message) use ($invitee_email) {
            $message->from(env('MAIL_USERNAME'), 'partEz');
            $message->to($invitee_email)->subject('Something is different.');
        });
    }
}
