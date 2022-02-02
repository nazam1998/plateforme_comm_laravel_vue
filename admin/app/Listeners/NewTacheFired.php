<?php

namespace App\Listeners;

use App\Events\NewTache;
use App\Mail\NewTaskNotification;
use App\Models\Entreprise;
use App\Notifications\NewTaskNotification as NewTaskNotif;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

class NewTacheFired
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
     * @param  \App\Events\NewTache  $event
     * @return void
     */
    public function handle(NewTache $event)
    {
        $data = [
            'nom' => Arr::get($event->data, 'nom'),
            'task' => Arr::get($event->data, 'task'),
            'entreprise' => Arr::get($event->data, 'entreprise'),
        ];

        Mail::to(Arr::get($event->data, 'email'))->send(new NewTaskNotification($data));
        $entreprise = Entreprise::where('tva', Arr::get($event->data, 'entreprise'))->first();
        $user = $entreprise->user;
        $user->notify(new NewTaskNotif($event->data));
    }
}
