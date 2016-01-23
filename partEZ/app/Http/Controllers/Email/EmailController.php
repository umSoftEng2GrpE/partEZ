<?php

namespace App\Http\Controllers;

use Mail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Send an e-mail reminder to the user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function sendEmailInvitation($id)
    {
        $user = User::findOrFail($id);

        Mail::send('emails.invitation', ['user' => $user], function ($m) use ($user) {
            $m->from('hello@partez.com', 'Your Application');

            $m->to('nickmanaigre@gmail.com', $user->name)->subject('Your Reminder!');
        });
    }

    public function index()
    {
        return view('home');
    }
}