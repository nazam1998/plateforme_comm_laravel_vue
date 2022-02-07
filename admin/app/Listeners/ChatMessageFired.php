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
        // Si la personne qui a envoyé le message est l'admin
        // on envoie une notif à l'entreprise
        if ($event->data->author_id == 1) {
            $user = Entreprise::find($event->data->entreprise_id)->user;
        } else {
            // Sinon, on envoie la notif à l'admin
            $user = User::find(1);
        }
        // Permet d'envoyer une notification à l'user correspondant
        $user->notify(new NewMessage($event->data));
    }
}
