<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    public function indexChat ()
    {
        $chats = Message::all();    

        return view('chat', compact('chats'));
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $message = new Message();
        $message['sender_id'] = $user->id;
        $message['sender_name'] = $user->name;
        $message['receive_id'] = 1;
        $message['chat_room_id'] = $user->id.'_1';
        $message['message'] = $request->message;

        $message->save();


        broadcast(new MessageSent($user, $message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
