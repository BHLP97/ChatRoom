<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Roomable;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function home()
    {
        $users = User::all()->except(Auth::id());
        if(Auth::check()){
            $roomsOwned = Auth::user()->ownsRooms;
            $roomsJoined = Auth::user()->inRooms->whereNotIn('id', $roomsOwned->pluck('id'));
            $roomsUneligible = $roomsOwned->merge($roomsJoined)->modelKeys();
            $roomsSearched = Room::whereNotIn('id', $roomsUneligible)->get();
        }
        return view('content.chatroom', ['roomsSearched' => $roomsSearched ?? '','roomsJoined' => $roomsJoined ?? '', "users" => $users]);
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
        return response()->json(['message' => 'The room has been created successfully', "room" => $room], 200);
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
        $roomsOwned = Auth::user()->ownsRooms->modelKeys();
        $roomsJoined = Auth::user()->inRooms->modelKeys();
        $roomsUneligible = array_unique(array_merge($roomsOwned, $roomsJoined));

        if ($search_room_name != ""){
            $query = "";
            for($i=0;$i<strlen($search_room_name);$i++){
                $query = $query.'%'.$search_room_name[$i];
            }
            $roomsSearched = Room::where('name', 'like', $query.'%')->whereNotIn('id', $roomsUneligible)->get();
        } else {
            $roomsSearched = Room::whereNotIn('id', $roomsUneligible)->get();
        }
        return response()->json($roomsSearched, 200);
    }
    
    public function show($id)
    {
        $room = Room::find($id);
        $members = $room->users;
        return response()->json(["room" => $room, "members" => $members], 200);
    }
    public function fetchMessages($id)
    {
        $chatroom = Room::where('id', $id)->get();
        $messages = Message::where('room_id', $id)->get();
        $members = Room::find($id)->users->pluck('name', 'id');
        return response()->json(['messages' => $messages, "members" => $members, 'chatroom' => $chatroom], 200);
    }
    public function tagUser(Request $request)
    {
        $query = $request->searchTag;
        $query = str_replace("_", " ", $query);
        $membersIds = Room::find($request->roomId)->users->pluck('id');
        $usersTagged = User::whereIn('id', $membersIds)->where('name', 'like', '%'.$query.'%')->whereNot('id', Auth::id())->get();
        return response()->json($usersTagged, 200);
    }
}
