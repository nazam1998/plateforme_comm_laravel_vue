<?php

namespace App\Providers;

use App\Events\ChatMessage;
use App\Events\NewTache;
use App\Events\OpenTask;
use App\Events\RegisteredUser;
use App\Listeners\NewTacheFired;
use App\Listeners\ChatMessageFired;
use App\Listeners\OpenTaskFired;
use App\Listeners\RegisteredUserFired;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        // Permet de lier les event avec les listener correspondants

        /** l'event */
        RegisteredUser::class => [
            /** le listener */
            RegisteredUserFired::class,
        ],
        NewTache::class => [
            NewTacheFired::class,
        ],
        ChatMessage::class => [
            ChatMessageFired::class,
        ],
        OpenTask::class => [
            OpenTaskFired::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
