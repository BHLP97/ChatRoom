<a href="#" class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
    <div class="col-span-1">
        <div class="flex justify-start items-center gap-4">
            @include('components.avatar', ['avatar_path'=>'images/profile1.png', 'avatar_size'=>'8'])
            <p class="font-bold text-ellipsis overflow-hidden">{{$room->name}}</p>
        </div>
    </div>
    <div class="col-span-2">
        <p> ... ... ... ... ...  ... ... ... ... ...</p>
    </div>
    <div class="absolute top-0 right-0 text-sm mr-2 mt-1  flex justify-end items-center gap-4">
        <p class="text-gray-400">2 min ago</p>
        @include('components.countNotification', ['number' => 1])
    </div>
</a>