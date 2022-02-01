<?php

namespace App\Listeners;

use App\Events\ChatMessage;
use App\Models\Entreprise;
use App\Notifications\NewMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChatMessageFired
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
        $user = Entreprise::find($event->data->entreprise_id)->user;
        $user->notify(new NewMessage($event->data));
    }
}
