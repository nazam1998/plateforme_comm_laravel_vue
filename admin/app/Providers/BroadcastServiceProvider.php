<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Permet d'ajouter une route pour les api
        Broadcast::routes(['prefix' => 'api', 'middleware' => 'auth:sanctum']);
        require base_path('routes/channels.php');
    }
}
