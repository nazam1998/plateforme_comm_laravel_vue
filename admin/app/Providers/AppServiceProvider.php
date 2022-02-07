<?php

namespace App\Providers;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        // Permet d'ajouter un icône avec un compteur de notification dynamique
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add([
                'text' => '',
                'topnav_right' => true,
                'url' => 'notifications',
                'icon' => 'far fa-bell',
                'label' => Auth::user()->unreadNotifications->count(),
                'label_color' => 'info',
            ]);
        });
    }
}
