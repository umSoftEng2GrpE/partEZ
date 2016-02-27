<?php

namespace App\Http\Controllers\ApiControllers\Events;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;

class ApiMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public static function getMessages( Request $request)
    {
        $eid = $request['eid'];
        $chat_messages = [];
        $chat_logDB = Message::getAllMessagesByEid($eid);
        foreach($chat_logDB as $message){
            $user = User::getById($message->uid);
            $temp_msg=array("msg" => $message->message, "firstname" => $user->firstname, "lastname" => $user->lastname, "created" => $message->created);
            array_push($chat_messages, $temp_msg);
        }
        return response()->json(compact('chat_messages') );
    }

    public static function saveNewMessage( Request $request )
    {
        $input = json_decode($request->getContent());
        $msgCreated=Message::createMessage($input->chat_message[0]->eid, $input->chat_message[0]->message);

    }
}
