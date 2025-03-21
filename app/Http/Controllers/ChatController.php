<?php

namespace App\Http\Controllers;

use App\Events\SendMessageEvent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', Auth::user()->id )->get();
        return view('dashboard', compact('users'));
    }

    public function fetchMessages(Request $request)
    {
        $contact = User::findOrFail($request->contact_id);
        //checking for message from from_id to to_id and vis vasa 
        $messages = Message::where('from_id', Auth::user()->id)
                    ->where('to_id', $request->contact_id)
                    ->orWhere('from_id', $request->contact_id)
                    ->where('to_id', Auth::user()->id)
                    ->get();

        return response()->json([
            'contact' => $contact,
            'messages' => $messages
        ]);
    }

    public function sendMessage(Request $request)
    {
       $request->validate([
            'contact_id' => 'required',
            'message' => 'required | string'
       ]);

       $message = new Message();
       $message->from_id = Auth::user()->id;
       $message->to_id = $request->contact_id;
       $message->message = $request->message;
       $message->save();

       event(new SendMessageEvent($message->message, Auth::user()->id, $request->contact_id));
       return response()->json($message);

    }

}

