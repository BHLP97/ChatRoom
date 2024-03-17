@extends('layouts.app')
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
                            <p>{{Auth::user()->name}}</p>
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
                <div class="col-span-1 w-full max-h-screen bg-[#202441] text-white text-base pl-12 pr-12 py-8">
                    <div class="font-bold text-3xl flex justify-between">
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
                        <p class="font-semibold mt-12">My rooms</p>
                        <div id="my-rooms" class="w-full pl-4 mb-12 scroll-smooth">
                            @foreach (Auth::user()->ownsRooms as $room)
                                @include('components.room_entry', ['room_name'=>$room->name, 'room_author'=>$room->author_id])
                            @endforeach
                        </div>
                        <p class="font-semibold">Rooms joined</p>
                        <div id="rooms-joined" class="w-full pl-4 mb-12 scroll-smooth">
                            @foreach ($roomsJoined as $room)
                                @include('components.room_entry', ['room_name'=>$room->name, 'room_author'=>$room->author_id])
                            @endforeach
                        </div>
                    @endif
                </div>
                <!-- column 3 -->
                <div class="col-span-1 grid grid-rows-5 w-full max-h-screen min-h-20 px-4 bg-[#212540]">
                    @include('components.notification')
                    <div class="row-span-2">
                        <div class="w-full max-h-screen bg-[#262948] py-3 px-4 my-4 text-white rounded-lg grid grid-cols-3 gap-2 relative">
                            <div class="col-span-1">
                                <div class="flex justify-start items-center gap-4">
                                    @include('components.avatar', ['avatar_path'=>'images/profile1.png', 'avatar_size'=>'10'])
                                </div>
                            </div>
                            <div class="col-span-2 flex flex-col grid-rows-4">
                                <div class="flex justify-between items-center gap-4 px-4 py-4 row-span-1">
                                    <div class="roomName font-bold text-lg text-white">Random Room name</div>
                                    <div class="buttonsRoom">
                                        <button class="enterRoom"><i class="fa-solid fa-door-open"></i></button>
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
                    
                    <div class="w-full max-h-screen row-span-3 bg-[#262948] rounded-lg px-4 py-4 mt-4 relative overflow-y-auto">
                        @for ($i = 0; $i < 8; $i++)
                            <a href="#" class="w-full bg-[#272d68] hover:bg-[#4289f3] py-3 px-4 my-4 text-white rounded-lg grid gap-2 relative">
                                <div class="flex">
                                    <div class="flex justify-start items-center gap-4 mr-4">
                                        @include('components.avatar', ['avatar_path'=>'images/profile1.png', 'avatar_size'=>'8'])
                                    </div>
                                    <p class="flex items-center font-bold text-ellipsis overflow-hidden">User {{$i}}</p>
                                </div>
                            </a>  
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('components.modals.roomFormModal')
    @include('components.modals.searchRoomModal')
    @include('components.modals.loginModal')
    @include('components.modals.registerModal')
    

@endsection
@section("script")
    <script>
        
        // TODO: Open modal by Id
        function openModal(modal_id){
            let addNewRoomFormModal = document.getElementById(modal_id);
            addNewRoomFormModal.classList.remove('hidden');
            addNewRoomFormModal.classList.add('visible');
        }
        // TODO: Close modal by Id
        function closeModal(modal_id){
            let addNewRoomFormModal = document.getElementById(modal_id);
            addNewRoomFormModal.classList.remove('visible');
            addNewRoomFormModal.classList.add('hidden');
        }
        function turnOnNotification(message, type){
            let notificationElement = $('#notification-'+type);
            $('#notification-'+type+'-message').html(message);
            notificationElement.removeClass('hidden');
            notificationElement.addClass('visible');
            setTimeout(function(){
                notificationElement.removeClass('visible');
                notificationElement.addClass('hidden');
            }, 3000);
        }
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
                    turnOnNotification(error.message, "error");
                    $("#btn-create-room").removeClass("disabled");
                    $("#btn-create-room").html('Add new room');
                },
                success: function (response) {
                    turnOnNotification(response.message, "success");
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
    </script>
    
@endsection