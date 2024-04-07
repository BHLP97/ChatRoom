<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\messageSent;
use App\Models\Roomable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMessageNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(messageSent $event): void
    {
        $roomMembers = Roomable::where('room_id', $event->message->room_id)->where('user_id', '!=', $event->message->user_id)->get();
        /* foreach($roomMembers as $member)
            
        } */
    }
}
