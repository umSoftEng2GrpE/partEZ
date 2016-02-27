<?php

namespace App\Http\Controllers;

use App\PollResponse;
use DB;
use Auth;
use Mail;
use Exception;
use App\Message;
use App\User;
use App\Http\Controllers\EventController;
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
        $chat_logDB = Message::getAllMessagesByEid($eid);

        foreach($chat_logDB as $message){
            $user = User::getById($message->uid);
            $temp_msg=array("msg" => $message->message, "firstname" => $user->firstname, "lastname" => $user->lastname, "created" => $message->created);
            array_push($chat_messages, $temp_msg);
        } 
        return $chat_messages;
    }

    public static function saveNewMessageDetails()
    {
        $input = Request::all();
        var_dump($input);
        $msgCreated=Message::createMessage($input['eid'], $input['message']);
        if($msgCreated){
            return redirect()->route('events.event_details', array($input['eid']));
        }

    }

}
