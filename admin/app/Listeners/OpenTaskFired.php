<?php

namespace App\Listeners;

use App\Events\OpenTask;
use App\Mail\OpenTaskNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

class OpenTaskFired implements ShouldQueue
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
     * @param  \App\Events\OpenTask  $event
     * @return void
     */
    public function handle(OpenTask $event)
    {

        $data = [
            'nom' => Arr::get($event->data, 'nom'),
            'taches' => Arr::get($event->data, 'taches'),
        ];
        // Envoie un mail à l'entreprise avec toutes les tâches non finies
        Mail::to(Arr::get($event->data, 'email'))->send(new OpenTaskNotification($data));
    }
}
