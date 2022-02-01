<?php

namespace App\Listeners;

use App\Events\NewTache;
use App\Mail\NewTaskNotification;
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
        ];

        Mail::to(Arr::get($event->data, 'email'))->send(new NewTaskNotification($data));
        $user = User::where('email',Arr::get($event->data, 'email'))->first();
        $user->notify(new NewTaskNotification($data));
    }
}
