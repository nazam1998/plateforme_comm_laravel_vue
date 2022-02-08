<?php

namespace App\Listeners;

use App\Events\RegisteredUser;
use App\Mail\NewUserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class RegisteredUserFired implements ShouldQueue
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
     * @param  \App\Events\RegisteredUser  $event
     * @return void
     */
    public function handle(RegisteredUser $event)
    {
        
        $data = [
            'email' => $event->email
        ];
        // Envoie un mail à l'enregistrement d'un nouveau user
        Mail::to($event->email)->send(new NewUserNotification($data));
    }
}
