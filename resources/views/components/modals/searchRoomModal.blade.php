<div class="hidden" id="searchRoomModal">
    <div class="absolute top-0 left-0 h-screen w-full opacity-50 bg-black">
    </div>
    <div class="absolute top-0 left-0 h-screen w-full flex justify-center">
        <div class=" w-1/3 self-top p-4 relative">
            <div class="w-full h-full  bg-white rounded-lg">
                <form id="searchRoomForm" class="py-6 px-8">
                    @csrf
                    <!-- Form Title -->
                    <h3 class="text-2xl text-center font-bold pb-4 text-gray-700">Search for a Room</h3>
                    <!-- Room Name -->
                    <div class="w-full relative">
                        <label for="search_room_name"></label>
                        <input type="text" name="search_room_name" id="search_room_name" required
                               placeholder="Type room name"
                               class="w-full py-1.5 px-4 border border-gray-400 rounded-lg mt-1 focus:outline-blue-600"
                               autofocus
                        />
                        <button type="submit" class="absolute top-0 right-0 self-center h-full mr-4 text-blue-600">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>

                </form>
                <!-- rooms list -->
                <div class="w-full pb-6 px-8">
                    <p class="font-semibold">Rooms</p>
                    <div class="w-full" id="search_room_result">
                        @if (Auth::check())
                            @foreach($roomsSearched as $room)
                                <a href="#" class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg flex justify-between items-center gap-2" id="{{$room->id}}">
                                    <div class="flex justify-start items-center gap-4">
                                        <div class="w-8 h-8 rounded-full">
                                            <img src="{{asset($room->icon ?? 'images/profile1.png')}}" alt="avatar" class="w-full h-full rounded-full border-2 border-red-500" />
                                        </div>
                                        <p class="font-bold text-white">{{$room->name}}</p>
                                    </div>

                                    <div class="">
                                        <button class="text-white hover:text-orange-500 text-xl" onclick="sendJoinRoomRequest('{{$room->id}}')">
                                            <i class="fa-solid fa-right-to-bracket"></i>
                                        </button>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <button type="button" onclick="closeModal('searchRoomModal')"
                    class="absolute top-0 right-0 border border-gray-300 bg-gray-300 w-8 h-8 rounded-full text-red-500 hover:text-white hover:bg-red-500 hover:border-red-500">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
</div>


<!-- Call Ajax handle -->
<script>
    function sendJoinRoomRequest(room_id){
        console.log("send join room request", room_id);
        $.ajax({
            type: 'POST',
            url: '{{ route("join.room") }}',
            data: {
                _token: '{{ csrf_token() }}',
                room_id: room_id
            },
            success: function(response) {
                // Turn on notification
                turnOnNotification(response.message, "success");
                // Push room to joined rooms list
                const room = response.room;
                if (!room) return
                const html =
                    `<a href="#" class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
                        <div class="col-span-1">
                            <div class="flex justify-start items-center gap-4">
                                <div class="w-8 h-8 rounded-full">
                                <img src="${room.icon ?? 'images/profile1.png'}" alt="avatar" class="w-full h-full rounded-full border-2 border-red-500" />
                                </div>
                                <p class="font-bold">${room.name}</p>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <p> ... ... ... ... ...  ... ... ... ... ...</p>
                        </div>
                        <div class="absolute top-0 right-0 text-sm mr-2 mt-1  flex justify-end items-center gap-4">
                            <p class="text-gray-400">2 min ago</p>
                            <button class="w-5 h-5 text-sm bg-red-500 rounded-full">0</button>
                        </div>
                    </a>`;
                const joinedRoomsList = $("#rooms-joined");
                // append to start of list
                if (joinedRoomsList) joinedRoomsList.prepend(html);
                // Remove this room out of search result list
                const searchRoomResultElement = document.getElementById("search-room-result-"+room.id);
                if (searchRoomResultElement) searchRoomResultElement.remove();

            },
            error: function(error) {
                turnOnNotification(error.message, "error");
            }
        });
    }

    $('#searchRoomForm').on('input', function() {
        $.ajax({
            type: 'POST',
            url: '{{ route("room.search") }}',
            data: $('#searchRoomForm').serialize(),
            success: function(response) {
                let rooms = response;
                let html = '';
                for(let i=0; i<rooms.length; i++){
                    html +=
                        `<a href="#" class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg flex justify-between items-center gap-2" id="search-room-result-${rooms[i].id}">
                            <div class="flex justify-start items-center gap-4">
                                <div class="w-8 h-8 rounded-full">
                                    <img src="${rooms[i].icon ?? 'images/profile1.png'}" alt="avatar" class="w-full h-full rounded-full border-2 border-red-500" />
                                </div>
                                <p class="font-bold text-white">${rooms[i].name}</p>
                            </div>
                            <div class="">
                                <button class="text-white hover:text-orange-500 text-xl" onclick="sendJoinRoomRequest(${rooms[i].id})">
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                </button>
                            </div>
                        </a>`;
                }
                if (rooms.length === 0){
                    html = `<p class="text-red-400 font-semibold text-center">No Room Found!</p>`;
                }
                $('#search_room_result').html(html);
                /*   // Display search results
                $('#searchResults').html(response);*/
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>