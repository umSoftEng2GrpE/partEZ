<?php

namespace App\Http\Controllers;

use App\PollResponse;
use DB;
use Auth;
use Mail;
use Exception;
use App\Message;
use Illuminate\Support\Facades\Request;

class MessageController extends Controller
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

    public static function getMessagesFromEid($eid)
    {
        $chat_messages = [];

        //Retrieving Polls for Display
        $chat_logDB = Message::getAllMessagesByEid($eid);

        foreach($chat_logDB as $message){
            $temp_msg=array("msg" => $message->message, "uid" => $message->uid, "created" => $message->created);
            array_push($chat_messages, $temp_msg);
        } 
        return $chat_messages;
    }
}
