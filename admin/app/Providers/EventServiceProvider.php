<?php

namespace App\Providers;

use App\Events\ChatMessage;
use App\Events\NewTache;
use App\Events\RegisteredUser;
use App\Listeners\NewTacheFired;
use App\Listeners\ChatMessageFired;
use App\Listeners\RegisteredUserFired;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        RegisteredUser::class => [
            RegisteredUserFired::class,
        ],
        NewTache::class => [
            NewTacheFired::class,
        ],
        ChatMessage::class => [
            ChatMessageFired::class,
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
