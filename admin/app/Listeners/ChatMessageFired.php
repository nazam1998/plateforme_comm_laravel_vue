<?php

namespace App\Listeners;

use App\Events\ChatMessage;
use App\Models\Entreprise;
use App\Models\User;
use App\Notifications\NewMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;

class ChatMessageFired implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ChatMessage  $event
     * @return void
     */
    public function handle(ChatMessage $event)
    {
        if ($event->data->author_id == 1) {
            $user = Entreprise::find($event->data->entreprise_id)->user;
        } else {
            $user = User::find(1);
        }
        $user->notify(new NewMessage($event->data));
    }
}
