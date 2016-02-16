<?php

namespace App\Http\Controllers\Email;

use Mail;
use App\Http\Controllers\Controller;
use Auth;

class EmailController extends Controller
{
    public function sendTestEmail() 
    {

        $data = array(
            'firstname' => Auth::user()->firstname,
        );

        Mail::send('emails.testemail', $data, function ($message) {
            $message->from(env('MAIL_USERNAME'), 'partEz');
            $message->to(Auth::user()->email)->subject('Configuring your email.');

        });

        return view('success');
    }
}