@extends('layouts.app')
@section("php")
<?php
use App\Models\User;
?>
@endsection
@section("title")
    ChatRoom
@endsection

@section("content")
    <div class="app h-screen w-full grid  grid-cols-6 text-base">
        <div class="col-span-1 w-full max-h-screen bg-[#262948] relative">
            <div class="w-full py-8 px-4">
                <div class="flex justify-start items-center gap-4">
                    @include('components.avatar', ['avatar_path'=>'images/profile1.png', 'avatar_size'=>'16'])
                    <div class="font-bold text-lg text-white">
                        @guest()
                            <p>Guest</p>
                        @else
                            <p id="{{Auth::user()->id}}" class='userId'>{{Auth::user()->name}}</p>
                        @endguest
                    </div>
                </div>
            </div>
            <div class="w-full py-4 px-6 text-white font-semibold">
                <div class="flex justify-between items-center py-2">
                    <a class="flex justify-start items-center gap-4 hover:text-red-500" href="#">
                        <i class="fa-solid fa-house"></i>
                        <p>Dashboard</p>
                    </a>
                </div>
                <div class="flex justify-between items-center py-2">
                    <a class="flex justify-start items-center gap-4 hover:text-red-500" href="#" >
                        <i class="fa-solid fa-users"></i>
                        <p>Chat Room</p>
                    </a>
                    <button class="w-5 h-5 text-sm bg-red-500 rounded-full">1</button>
                </div>
                <div class="flex justify-between items-center py-2">
                    <a class="flex justify-start items-center gap-4 hover:text-red-500" href="#">
                        <i class="fa-solid fa-calendar-days"></i>
                        <p>Calendar</p>
                    </a>
                    <button class="w-5 h-5 text-sm bg-red-500 rounded-full">1</button>
                </div>
            </div>
            <div class="w-full absolute bottom-0 py-8 px-6 text-white font-semibold">
                <a class="flex justify-start items-center gap-4 py-2 hover:text-red-500" href="#">
                    <i class="fa-solid fa-gear"></i>
                    <p>Settings</p>
                </a>
                @auth
                    <a class="flex cursor-pointer justify-start items-center gap-4 py-2 hover:text-red-500"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-door-open"></i>
                        <p>Log Out</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    <div class="flex cursor-pointer justify-start items-center gap-4 py-2 hover:text-red-500" onclick="openModal('loginModal')">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <p>Log In</p>
                    </div>
                    @if (Route::has('register'))
                        <div class="flex cursor-pointer justify-start items-center gap-4 py-2 hover:text-red-500" onclick="openModal('registerModal')">
                            <i class="fa-solid fa-user-plus"></i>
                            <p>Register</p>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
        <div class="col-span-5 w-full max-h-screen bg-[#3c425e]">
            <div class="grid grid-cols-2 gap-1 max-h-screen overflow-scroll overflow-x-hidden">
                <!-- column 2-->
                <div class="col-span-1 grid grid-rows-10 w-full max-h-screen bg-[#202441] text-white text-base pl-12 pr-12 py-8">
                    <div class="font-bold text-3xl row-span-2 flex justify-between">
                        <div class="flex justify-start items-center gap-4">
                            <i class="fa-solid fa-users"></i>
                            <p> Chat Room</p>
                        </div>
                        {{-- <button onclick="$('.create-room-modal').toggleClass('hidden')" data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            <i class="fa-solid fa-plus"></i>
                        </button> --}}
                        <div class="flex justify-end items-center gap-4">
                            <button type="button" onclick="openModal('searchRoomModal')" class="text-white hover:text-orange-400">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <button type="button" onclick="openModal('addNewRoomFormModal')" class="text-white hover:text-orange-400">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    @if(Auth::check())	
                        <div id='allRooms' class="w-full grid grid-rows-8 pl-4 row-span-8">
                            <p class="font-semibold flex flex-col-reverse row-span-1">My rooms</p>
                            <div id="my-rooms" class="w-full row-span-3 overflow-y-auto scroll-smooth">
                                @foreach (Auth::user()->ownsRooms as $room)
                                    @include('components.room_entry', ['room_name'=>$room->name, 'room_author'=>$room->author_id])
                                @endforeach
                            </div>
                            <p class="font-semibold flex flex-col-reverse row-span-1">Rooms joined</p>
                            <div id="rooms-joined" class="w-full row-span-3 overflow-y-auto scroll-smooth">
                                @foreach ($roomsJoined as $room)
                                    @include('components.room_entry', ['room_name'=>$room->name, 'room_author'=>$room->author_id])
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <!-- column 3 -->
                <div class="col-span-1 grid grid-rows-5 w-full max-h-screen min-h-20 px-4 bg-[#212540]">
                    @include('components.notification')
                    <div id="roomDetails">
                        <div class="row-span-2">
                            <div class="w-full max-h-screen bg-[#262948] py-3 px-4 my-4 text-white rounded-lg grid grid-cols-3 gap-2 relative">
                                <div class="col-span-1">
                                    <div class="flex justify-start items-center gap-4">
                                        @include('components.avatar', ['avatar_path'=>'images/profile1.png', 'avatar_size'=>'32'])
                                    </div>
                                </div>
                                <div class="col-span-2 flex flex-col grid-rows-4">
                                    <div class="flex justify-between items-center gap-4 px-4 py-4 row-span-1">
                                        <div class="roomName font-bold text-lg text-white">Random Room name</div>
                                        <div class="buttonsRoom">
                                            
                                        </div>
                                    </div>
                                    <div class="row-span-3 gap-4 px-4 py-4 text-m text-white text-ellipsis overflow-hidden">
                                        Aut iusto sint autem cum. Et numquam nihil ea et illo eos. Culpa ut ad tenetur eum mollitia. Voluptas voluptas consequatur qui dolorem. Ut ipsa iusto illo culpa sed sequi omnis non.
                                    </div>
                                </div>
                            </div>
                            <form class="max-w-md mx-auto">   
                                <label for="default-search" class="text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </div>
                                    <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Users" required />
                                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                                </div>
                            </form>
                        </div>
                        <div id="listMembers" class="w-full max-h-screen row-span-3 bg-[#262948] rounded-lg px-4 py-4 mt-4 relative overflow-y-auto">
                            {{-- @for ($i = 0; $i < 8; $i++)
                            <a href="#" class="w-full bg-[#272d68] hover:bg-[#4289f3] py-3 px-4 my-4 text-white rounded-lg grid gap-2 relative">
                                <div class="flex">
                                    <div class="flex justify-start items-center gap-4 mr-4">
                                        @include('components.avatar', ['avatar_path'=>'images/profile1.png', 'avatar_size'=>'8'])
                                    </div>
                                    <p class="flex items-center font-bold text-ellipsis overflow-hidden">User {{$i}}</p>
                                </div>
                            </a>  
                            @endfor --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('components.modals.chatModal')
    @include('components.modals.roomFormModal')
    @include('components.modals.searchRoomModal')
    @include('components.modals.loginModal')
    @include('components.modals.registerModal')
    
@endsection
@section("head")
    <script>
        $( document ).ready(function() {
            var roomIds = $('.room_entry').map(function(){
                return this.id;
            }).get();
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;
            var pusher = new Pusher('aae3bf4a33b44486cd56', {
                cluster: 'ap1'
            });
            roomIds.forEach(roomId => {
                var channel = pusher.subscribe('channel-'+roomId);
                channel.bind('messageSent', function(data) {
                    console.log($('#chatModal').find('#roomId').html(), data.message.room_id, $('.userId').attr('id'), data.user.id)
                    if($('.userId').attr('id') != data.user.id){
                        if($('#chatModal').find('#roomId').html() != data.message.room_id){
                            turnOnNotification("User "+data.user.name+" posted '"+data.message.content+"' in room "+data.message.room_id, "chat", data.message.room_id);
                        } else {
                            let html = `<div id="${data.message.id}" class="flex items-start gap-2.5 mt-4"> 
                                    <img class="w-8 h-8 rounded-full" src="images/profile1.png" alt="Jese image">
                                    <div class="flex flex-col gap-1 w-full max-w-[320px]">
                                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                            <span class="text-sm font-semibold text-white">${data.user.name}</span>
                                            <span class="text-sm font-normal text-gray-400">11:46</span>
                                        </div>
                                        <div class="flex flex-col leading-1.5 p-4 border-gray-200 rounded-e-xl rounded-es-xl bg-gray-700">
                                            <p class="chatroomMessageContent text-sm font-normal text-white">${data.message.content}</p>
                                        </div>
                                        <span class="text-sm font-normal text-gray-400">Delivered</span>
                                    </div>
                                    <button id="dropdownMenuIconButton" onclick="$('#dropdownDots${data.message.id}').toggleClass('hidden')" data-dropdown-toggle="dropdownDots${data.message.id}" data-dropdown-placement="bottom-start" class="inline-flex self-center items-center p-2 text-sm font-medium text-center rounded-lg focus:ring-4 focus:outline-none text-white bg-gray-900 hover:bg-gray-800 focus:ring-gray-600" type="button">
                                        <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                            <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                        </svg>
                                    </button>
                                    <div id="dropdownDots${data.message.id}" class="z-100 hidden -right-40 divide-y rounded-lg shadow w-40 bg-gray-700 divide-gray-600">
                                        <ul class="py-2 text-sm text-gray-200" aria-labelledby="dropdownMenuIconButton">
                                            <li>
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Reply</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>`;
                            $('#listMessages').append(html);
                        }
                    }
                }); 
            });
        });
    </script>
@endsection
@section("script")
    <script>
        // TODO: Show room details by Id
        $('.room_entry').on('click', function() {
            $('#allRooms').find('.selected').removeClass('bg-[#272d68]');
            $('#allRooms').find('.selected').removeClass('selected');
            $(this).addClass('selected');
            $(this).addClass('bg-[#272d68]');
            let room_id = $(this).attr('id');
            $.ajax({
                type: 'post',
                url: '/room/'+room_id,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                traditional: true,
                error: function(data){

                },
                success: function (response) {
                    let html = `<div class="row-span-2">
                        <div class="w-full max-h-screen bg-[#262948] py-3 px-4 my-4 text-white rounded-lg grid grid-cols-3 gap-2 relative">
                            <div class="col-span-1">
                                <div class="flex justify-start items-center gap-4">
                                    @include('components.avatar', ['avatar_path'=>'images/profile1.png', 'avatar_size'=>'32'])
                                </div>
                            </div>
                            <div class="col-span-2 flex flex-col grid-rows-4">
                                <div class="flex justify-between items-center gap-4 px-4 py-4 row-span-1">
                                    <div class="roomName font-bold text-lg text-white">${response.room.name}</div>
                                    <div class="buttonsRoom">
                                        <button class="enterRoom" onclick="openChat('${room_id}')"><i class="fa-solid fa-door-open"></i></button>
                                        <button class="leaveRoom"><i class="fa-solid fa-door-closed"></i></button>
                                    </div>
                                </div>
                                <div class="row-span-3 gap-4 px-4 py-4 text-m text-white text-ellipsis overflow-hidden">
                                    Aut iusto sint autem cum. Et numquam nihil ea et illo eos. Culpa ut ad tenetur eum mollitia. Voluptas voluptas consequatur qui dolorem. Ut ipsa iusto illo culpa sed sequi omnis non.
                                </div>
                            </div>
                        </div>
                        <form class="max-w-md mx-auto">   
                            <label for="default-search" class="text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Users" required />
                                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                            </div>
                        </form>
                    </div>
                    <div id="listMembers" class="w-full max-h-screen row-span-3 bg-[#262948] rounded-lg px-4 py-4 mt-4 relative overflow-y-auto">`;
                    let members = response.members;
                    members.forEach(member => {
                        html += `<a href="#" class="w-full bg-[#272d68] hover:bg-[#4289f3] py-3 px-4 my-4 text-white rounded-lg grid gap-2 relative">
                            <div class="flex">
                                <div class="flex justify-start items-center gap-4 mr-4">
                                    @include('components.avatar', ['avatar_path'=>'images/profile1.png', 'avatar_size'=>'8'])
                                </div>
                                <p class="flex items-center font-bold text-ellipsis overflow-hidden">${member.name}</p>
                            </div>
                        </a> `;
                    });
                    $('#roomDetails').html(html);   
                },
            });
        });
        // TODO: Open chatroom by Id
        function openChat(room_id){
            $.ajax({
                type: 'post',
                url: '/room/'+room_id+'/messages',
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                traditional: true,
                error: function(data){

                },
                success: function (response) {
                    let html = ``;
                    let user_id = $('.userId').attr('id');
                    let messages = response.messages;
                    $('#chatroomName').html("Chatroom: " + response.chatroom[0].name);
                    $('#roomId').html(response.chatroom[0].id);
                    let chatroom = response.chatroom;
                    messages.forEach(message => {
                        if(message.user_id == user_id){
                            html += `<div id="${message.id}" class="flex flex-row-reverse items-start mt-4 gap-2.5">
                                <img class="w-8 h-8 rounded-full" src="images/profile1.png" alt="Jese image">
                                <div class="flex flex-col gap-1 w-full max-w-[320px]">
                                    <div class="flex flex-row-reverse items-center space-x-reverse">
                                        <span class="text-sm font-semibold text-white">${$('.userId').html()}</span>
                                        <span class="text-sm font-normal text-gray-400">11:48</span>
                                    </div>
                                    <div class="flex flex-col leading-1.5 p-4 border-gray-200 rounded-s-xl rounded-b-xl bg-gray-700">
                                        <p class="chatroomMessageContent text-sm text-right font-normal text-white">${message.content}</p>
                                    </div>
                                    <span class="flex text-sm font-normal text-gray-400 justify-end">Delivered</span>
                                </div>
                                <button id="dropdownMenuIconButton" onclick="$('#dropdownDots${message.id}').toggleClass('hidden')" data-dropdown-toggle="dropdownDots${message.id}" data-dropdown-placement="bottom-end" class="inline-flex self-center items-center p-2 text-sm font-medium text-center rounded-lg focus:ring-4 focus:outline-none text-white bg-gray-900 hover:bg-gray-800 focus:ring-gray-600" type="button">
                                    <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                        <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                    </svg>
                                </button>
                                <div id="dropdownDots${message.id}" class="z-100 hidden -left-40 divide-y rounded-lg shadow w-40 bg-gray-700 divide-gray-600">
                                    <ul class="py-2 text-sm text-gray-200" aria-labelledby="dropdownMenuIconButton">
                                        <li>
                                            <a href="#" onclick="editMessage(${message.id})" class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Edit</a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="deleteMessage(${message.id})" class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>`
                        }else{
                            html += `<div id="${message.id}" class="flex items-start gap-2.5 mt-4"> 
                                <img class="w-8 h-8 rounded-full" src="images/profile1.png" alt="Jese image">
                                <div class="flex flex-col gap-1 w-full max-w-[320px]">
                                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                        <span class="text-sm font-semibold text-white">${response.members[message.user_id]}</span>
                                        <span class="text-sm font-normal text-gray-400">11:46</span>
                                    </div>
                                    <div class="flex flex-col leading-1.5 p-4 border-gray-200 rounded-e-xl rounded-es-xl bg-gray-700">
                                        <p class="chatroomMessageContent text-sm font-normal text-white">${message.content}</p>
                                    </div>
                                    <span class="text-sm font-normal text-gray-400">Delivered</span>
                                </div>
                                <button id="dropdownMenuIconButton" onclick="$('#dropdownDots${message.id}').toggleClass('hidden')" data-dropdown-toggle="dropdownDots${message.id}" data-dropdown-placement="bottom-start" class="inline-flex self-center items-center p-2 text-sm font-medium text-center rounded-lg focus:ring-4 focus:outline-none text-white bg-gray-900 hover:bg-gray-800 focus:ring-gray-600" type="button">
                                    <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                        <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                    </svg>
                                </button>
                                <div id="dropdownDots${message.id}" class="z-100 hidden -right-40 divide-y rounded-lg shadow w-40 bg-gray-700 divide-gray-600">
                                    <ul class="py-2 text-sm text-gray-200" aria-labelledby="dropdownMenuIconButton">
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Reply</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>`;
                        }
                    });
                    $('#listMessages').html(html);   
                    $('#chatModal').removeClass('hidden');
                    $('#chatModal').addClass('visible');
                    $("#listMessages").scrollTop($("#listMessages")[0].scrollHeight);
                },
            });
        }
        // TODO: Open modal by Id
        function openModal(modal_id){
            let addNewRoomFormModal = document.getElementById(modal_id);
            addNewRoomFormModal.classList.remove('hidden');
            addNewRoomFormModal.classList.add('visible');
        }
        // TODO: Close modal by Id
        function closeModal(modal_id){
            if(modal_id == "chatModal"){
                $('#messageContent').val('');
            }
            let addNewRoomFormModal = document.getElementById(modal_id);
            addNewRoomFormModal.classList.remove('visible');
            addNewRoomFormModal.classList.add('hidden');
        }
        function turnOnNotification(message, type, room_id){
            let notificationElement = $('#notification-'+type);
            $('#notification-'+type+'-message').html(message);
            $('#notification-room-id').html(room_id);
            notificationElement.removeClass('hidden');
            notificationElement.addClass('visible');
            setTimeout(function(){
                notificationElement.removeClass('visible');
                notificationElement.addClass('hidden');
            }, 5000);
        }
        function redirectNotification(){
            let room_id = $('#notification-room-id').html();
            console.log(room_id);
            openChat(room_id);
            /* $([document.documentElement, document.body]).animate({
                scrollTop: $("#"+message_id).offset().top
            }, 2000); */
        };
        function createRoom(){
            $("#btn-create-room").addClass("disabled");
            $("#btn-create-room").html('<img src="isProcessing.gif" alt="processing room creation" style="width: 30px; height: 23px;"/>')
            fd = new FormData();
            fd.append('newRoomName', $('#newRoomName').val());
            fd.append('newRoomMembers', $('#newRoomMembers').val());
            $.ajax({
                type: 'post',
                url: '/room/create',
                contentType: false,
                data: fd,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                traditional: true,
                error: function(data){
                    turnOnNotification(error.message, "error", 0);
                    $("#btn-create-room").removeClass("disabled");
                    $("#btn-create-room").html('Add new room');
                },
                success: function (response) {
                    turnOnNotification(response.message, "success", 0);
                    $("#newRoomName").html("");
                    $("#btn-create-room").removeClass("disabled");
                    $("#btn-create-room").html('Submit');
                    $('#close-room-modal').click();
                    let html = `<a href="#" class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
                        <div class="col-span-1">
                            <div class="flex justify-start items-center gap-4">
                                <div class="w-8 h-8 rounded-full">
                                    <img src="images/profile1.png" alt="avatar" class="w-full h-full rounded-full" />
                                </div>
                                <p class="font-bold">${response.room.name}</p>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <p> ... ... ... ... ...  ... ... ... ... ...</p>
                        </div>
                        <div class="absolute top-0 right-0 text-sm mr-2 mt-1  flex justify-end items-center gap-4">
                            <p class="text-gray-400">2 min ago</p>
                            <button class="w-5 h-5 text-sm bg-red-500 rounded-full">0</button>
                        </div>
                    </a>`
                    const ownedRoomsList = $("#rooms-joined");
                    // append to start of list
                    if (ownedRoomsList) ownedRoomsList.prepend(html);
                    
                },
            });
        };
        function viewRoom(room_id){
            $.ajax({
            type: 'POST',
            url: '{{ route("room.fetch.messages", 'message_id') }}',
            data: {
                _token: '{{ csrf_token() }}',
                room_id: room_id
            },
            success: function(response) {
                
            },
            error: function(error) {
                
            }
        });
        }
        
    </script>
    
@endsection