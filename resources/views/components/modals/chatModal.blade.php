<div class="hidden" id="chatModal">
    <div class="hidden" id="roomId">{{$room->id ?? ''}}</div>
    <div class="absolute top-0 left-0 h-screen w-full opacity-50 bg-black">
    </div>
    <div class="absolute top-0 left-0 h-screen w-full flex justify-center">
        <div class=" self-top p-4 relative">
            <div class="w-full h-full bg-[#202441] rounded-lg">
                <div class="bg-gray-100 w-full h-full flex flex-col max-w-lg mx-auto">
                    <div class="p-4 bg-[#202441] text-white flex justify-center items-center">
                        <span id='chatroomName'>Chatroom: {{$room->name ?? ''}}</span>
                        <div class="relative inline-block text-left">
                            <div id="dropdown-content" class="hidden absolute right-0 mt-2 w-48 border border-gray-300 rounded-lg shadow-lg p-2">
                                <a href="#" class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-200 rounded-md">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" class="mr-2" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 21H12M15 21H12M12 21V18M12 18H19C20.1046 18 21 17.1046 21 16V7C21 5.89543 20.1046 5 19 5H5C3.89543 5 3 5.89543 3 7V16C3 17.1046 3.89543 18 5 18H12Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>Appearance
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-200 rounded-md">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" class="mr-2" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M11.2691 4.41115C11.5006 3.89177 11.6164 3.63208 11.7776 3.55211C11.9176 3.48263 12.082 3.48263 12.222 3.55211C12.3832 3.63208 12.499 3.89177 12.7305 4.41115L14.5745 8.54808C14.643 8.70162 14.6772 8.77839 14.7302 8.83718C14.777 8.8892 14.8343 8.93081 14.8982 8.95929C14.9705 8.99149 15.0541 9.00031 15.2213 9.01795L19.7256 9.49336C20.2911 9.55304 20.5738 9.58288 20.6997 9.71147C20.809 9.82316 20.8598 9.97956 20.837 10.1342C20.8108 10.3122 20.5996 10.5025 20.1772 10.8832L16.8125 13.9154C16.6877 14.0279 16.6252 14.0842 16.5857 14.1527C16.5507 14.2134 16.5288 14.2807 16.5215 14.3503C16.5132 14.429 16.5306 14.5112 16.5655 14.6757L17.5053 19.1064C17.6233 19.6627 17.6823 19.9408 17.5989 20.1002C17.5264 20.2388 17.3934 20.3354 17.2393 20.3615C17.0619 20.3915 16.8156 20.2495 16.323 19.9654L12.3995 17.7024C12.2539 17.6184 12.1811 17.5765 12.1037 17.56C12.0352 17.5455 11.9644 17.5455 11.8959 17.56C11.8185 17.5765 11.7457 17.6184 11.6001 17.7024L7.67662 19.9654C7.18404 20.2495 6.93775 20.3915 6.76034 20.3615C6.60623 20.3354 6.47319 20.2388 6.40075 20.1002C6.31736 19.9408 6.37635 19.6627 6.49434 19.1064L7.4341 14.6757C7.46898 14.5112 7.48642 14.429 7.47814 14.3503C7.47081 14.2807 7.44894 14.2134 7.41394 14.1527C7.37439 14.0842 7.31195 14.0279 7.18708 13.9154L3.82246 10.8832C3.40005 10.5025 3.18884 10.3122 3.16258 10.1342C3.13978 9.97956 3.19059 9.82316 3.29993 9.71147C3.42581 9.58288 3.70856 9.55304 4.27406 9.49336L8.77835 9.01795C8.94553 9.00031 9.02911 8.99149 9.10139 8.95929C9.16534 8.93081 9.2226 8.8892 9.26946 8.83718C9.32241 8.77839 9.35663 8.70162 9.42508 8.54808L11.2691 4.41115Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>Favorite
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-200 rounded-md">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" class="mr-2" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="Warning / Info"> <path id="Vector" d="M12 11V16M12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21ZM12.0498 8V8.1L11.9502 8.1002V8H12.0498Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g> </g></svg>More
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="listMessages" class="flex-1 bg-[#202441] overflow-y-auto p-4">
                        
                    </div>
                    <div class="bg-[#202441]">
                        <div id="tagList" class="hidden flex flex-col overflow-y-auto scroll-smooth items-center rounded-lg bg-gray-700">

                        </div>
                        <form id="sendMessage">
                            <div id="editedMessageId"></div>
                            <label for="chat" class="sr-only">Your message</label>
                            <div class="flex items-center py-2 px-3 rounded-lg bg-gray-700">
                                <button type="button" class="inline-flex justify-center p-2 rounded-lg cursor-pointer text-gray-400 hover:text-white hover:bg-gray-600">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>
                                </button>
                                <button type="button" class="p-2 rounded-lg cursor-pointer  text-gray-400 hover:text-white hover:bg-gray-600">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"></path></svg>
                                </button>
                                <textarea id="messageContent" rows="1" class="block mx-4 p-2.5 w-full text-sm rounded-lg border bg-gray-800 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="Your message..."></textarea>
                                <button type="submit" class="inline-flex justify-center p-2 rounded-full cursor-pointer text-blue-500 hover:bg-gray-600">
                                    <svg class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                                </button>
                            </div>
                        </form>
                    </div>
                        
                </div>
                <button type="button" onclick="closeModal('chatModal');$('#tagList').html('');$('#tagList').removeClass('visible');$('#tagList').addClass('hidden');"
                    class="absolute top-0 right-0 border border-gray-300 bg-gray-300 w-8 h-8 rounded-full text-red-500 hover:text-white hover:bg-red-500 hover:border-red-500">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Import Flowbite -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<!-- Call Ajax handle -->

<script>
    $('#sendMessage').on('submit', function(e) {
        e.preventDefault();
        if($('#editedMessageId').html() == ''){
            $.ajax({
                type: 'POST',
                url: '{{ route("message.send") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    room_id: $('#roomId').html(),
                    content: $('#messageContent').val(),
                    parent_id: ''
                },
                success: function(response) {
                    let html = `<div id="${response.message_id}" class="flex flex-row-reverse items-start mt-4 gap-2.5">
                                    <img class="w-8 h-8 rounded-full" src="images/profile1.png" alt="Jese image">
                                    <div class="flex flex-col gap-1 w-full max-w-[320px]">
                                        <div class="flex flex-row-reverse items-center space-x-reverse">
                                            <span class="text-sm font-semibold text-white">${$('.userId').html() ?? 'Guest User'}</span>
                                            <span class="text-sm font-normal text-gray-400">11:48</span>
                                        </div>
                                        <div class="flex flex-col leading-1.5 p-4 border-gray-200 rounded-s-xl rounded-b-xl bg-gray-700">
                                            <p class="chatroomMessageContent text-sm text-right font-normal text-white">${response.content}</p>
                                        </div>
                                        <span class="flex text-sm font-normal text-gray-400 justify-end">Delivered</span>
                                    </div>
                                    <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots${response.message_id}" onclick="$('#dropdownDots${response.message_id}').toggleClass('hidden')" data-dropdown-placement="bottom-end" class="inline-flex self-center items-center p-2 text-sm font-medium text-center rounded-lg focus:ring-4 focus:outline-none text-white bg-gray-900 hover:bg-gray-800 focus:ring-gray-600" type="button">
                                        <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                            <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                        </svg>
                                    </button>
                                    <div id="dropdownDots${response.message_id}" class="z-100 hidden absolute -left-40 divide-y rounded-lg shadow w-40 bg-gray-700 divide-gray-600">
                                        <ul class="py-2 text-sm text-gray-200" aria-labelledby="dropdownMenuIconButton">
                                            <li>
                                                <a href="#" onclick="editMessage(${response.message_id})" class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Edit</a>
                                            </li>
                                            <li>
                                                <a href="#" onclick="deleteMessage(${response.message_id})" class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>`
                    $('#listMessages').append(html);
                    $('#messageContent').val('');
                },
                error: function(error) {
                    turnOnNotification(error.message, "error");
                }
            }); 
        } else {
            let message_id = $('#editedMessageId').html();
            $.ajax({
                type: 'POST',
                url: '{{ route("message.edit", 'message_id') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    content: $('#messageContent').val(),
                    message_id: message_id
                },
                success: function(response) {
                    $('#'+response).find('.chatroomMessageContent').html($('#messageContent').val());
                    $('#dropdownDots'+response).toggleClass('hidden');
                    $('#messageContent').val('');
                },
                error: function(error) {
                    
                }
            });
        }
    });

    function replyToMessage(message_id){
        
    }

    function editMessage(message_id){
        $('#editedMessageId').html(message_id);
        $('#messageContent').html($('#'+message_id).find('.chatroomMessageContent').html());
    }   

    function deleteMessage(message_id){
        $.ajax({
            type: 'POST',
            url: '{{ route("message.delete", 'message_id') }}',
            data: {
                _token: '{{ csrf_token() }}',
                message_id: message_id
            },
            success: function(response) {
                $('#'+response).remove();
            },
            error: function(error) {
                
            }
        });
    }

    $('#messageContent').on('input', function(e) {
        string = $('#messageContent').val().split(' ');
        lastWord = string[string.length - 1];
        if(lastWord.charAt(0) == "@"){
            $('#tagList').addClass('visible');
            $('#tagList').removeClass('hidden');
            $.ajax({
                type: 'POST',
                url: '{{ route("user.tag") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    searchTag: lastWord.substring(1),
                    roomId: $('#roomId').html()
                },
                success: function(response) {
                    html = "";
                    if(response != []){
                        $('#tagList').addClass('visible');
                        response.forEach(user => {
                            html += `<a onclick="string[string.length - 1] = $(this).find('.nameTagString').html();$('#messageContent').val(string.join(' '));$('#tagList').html('');$('#tagList').removeClass('visible');$('#tagList').addClass('hidden');" class="nameTag w-full hover:bg-[#4289f3] py-3 px-4 text-white rounded-lg grid gap-2 relative">
                                <div class="flex">
                                    <div class="flex justify-start items-center gap-4 mr-4">
                                        @include('components.avatar', ['avatar_path'=>'images/profile1.png', 'avatar_size'=>'8'])
                                    </div>
                                    <p class="nameTagString flex items-center font-bold text-ellipsis overflow-hidden">${user.name}</p>
                                </div>
                            </a>`
                        });
                        $('#tagList').html(html);
                    }else{
                        $('#tagList').html(`<div class="w-full py-3 px-4 text-white rounded-lg grid gap-2 relative">No user found</div>`);
                    }
                },
                error: function(error) {
                    
                }
            });
        } else {
            $('#tagList').removeClass('visible');
            $('#tagList').addClass('hidden');
        }
    })

</script>