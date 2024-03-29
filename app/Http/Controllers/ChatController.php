<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function sendMessage(Request $request){
        $message = new Message();
        $message->user_id = Auth::id();
        $message->room_id = $request->room_id;
        $message->content = $request->content;
        $message->type = "text";
        $message->parent_id = $request->parent_id ?? 0;
        $message->save();
        return response()->json(["message_id" => $message->id, "content" => $message->content], 200);
    }

    public function editMessage(Request $request, $id){
        $message = Message::find($request->message_id);
        $message->content = $request->content;
        $message->save();
        return response()->json($request->message_id, 200);
    }

    public function deleteMessage(Request $request){
        Message::where('id',$request->message_id)->delete();
        return response()->json($request->message_id, 200);
    }
    
}
