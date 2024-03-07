<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Roomable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function home()
    {
        $users = User::all()->except(Auth::id());
        if(Auth::check()){
            $roomsOwned = Auth::user()->ownsRooms->pluck('id');
            $roomsJoined = Auth::user()->inRooms->whereNotIn('id', $roomsOwned);
            $rooms = Room::where('author_id','=', Auth::user()->id)->get();
        }
        return view('content.chatroom', ['rooms' => $rooms ?? '','roomsJoined' => $roomsJoined ?? '', "users" => $users]);
    }
    public function store(Request $request)
    {
        $room = new Room();
        $room->name = ($request->newRoomName) ? $request->newRoomName : Auth::user()->name;
        $room->author_id = Auth::id();
        $room->save();

        $roomable = new Roomable();
        $roomable->room_id = $room->id;
        $roomable->user_id = Auth::id();
        $roomable->save();
        $members = explode(",", $request->newRoomMembers);
        foreach($members as $member){
            $roomable = new Roomable();
            $roomable->room_id = $room->id;
            $roomable->user_id = $member;
            $roomable->save();
        }
        return response()->json(['success' => 'The room has been created successfully', 'roomName' => $room->name]);
    }
    public function join(Request $request)
    {
        $input = $request->all();
        $user = Auth::user();
        $room = Room::find($input['room_id']);

        if($user && $room){
            $room->users()->attach($user->id);
        }

        return response()->json(["message" => "You have joined the room successfully !", "room" => $room], 200);
    }

    public function search(Request $request){
        $search_room_name = $request->input('search_room_name');
        $roomsUneligible = Auth::user()->inRooms->pluck('id');
        if ($search_room_name != ""){
            $query = "";
            for($i=0;$i<strlen($search_room_name);$i++){
                $query = $query.'%'.$search_room_name[$i];
            }
            $rooms = Room::where('name', 'like', $query.'%')->whereNotIn('id', $roomsUneligible)->get();
        } else {
            $rooms = Room::where('author_id','=', Auth::user()->id)->get();
        }
        return response()->json($rooms, 200);
    }
    
    public function show()
    {
        
    }
    public function fetchMessages()
    {
        
    }
    public function sendMessages()
    {
        
    }
}
