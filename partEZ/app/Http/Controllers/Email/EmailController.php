<?php

namespace App\Http\Controllers\Email;

use Mail;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{
    /**
     * Send an invitation
     */
    public function sendInvitation()
    {
        $data = array(
            'event' => "a party!",
        );

        Mail::send('emails.invitation', $data, function ($message) {

            $message->from('parteznoreply@gmail.com', 'Party Planner');

            $message->to("ewaschukmps@gmail.com")->subject('Event Invitation');

        });

        return view('success');
    }
}