<?php

use App\Events\ChatMessage;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\ChatController;
use App\Mail\OpenTaskNotification;
use App\Models\Entreprise;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

//Default Dashboard Page
Route::middleware('auth')->get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Service Provider Auth Google
Route::get("redirect/{provider}", [LoginController::class, 'providerLogin'])->name('socialite.redirect');
Route::get("callback/{provider}", [LoginController::class, 'callback'])->name('socialite.callback');

//Entreprise Index and Show
Route::get('entreprise', [EntrepriseController::class, 'index'])->middleware('auth');
Route::get('entreprise/{tva}', [EntrepriseController::class, 'show'])->name('entreprise.show')->middleware('auth');

//Entreprise Tasks
Route::get('tache/{tva}', [TacheController::class, 'index'])->name('tache.index')->middleware('auth');
Route::get('tache/{tva}/add', [TacheController::class, 'create'])->name('tache.add')->middleware('auth');
Route::post('tache/{tva}', [TacheController::class, 'store'])->name('tache.store')->middleware('auth');

//Entreprises Messages
Route::get('chat', [ChatController::class, 'index'])->name('chat.index')->middleware('auth');
Route::get('chat/{tva}', [ChatController::class, 'show'])->name('chat.show')->middleware('auth');
Route::post('chat/{tva}', [ChatController::class, 'store'])->name('chat.store')->middleware('auth');

Route::get('notifications', function () {
    foreach (Auth::user()->unreadNotifications as $notif) {
        $notif->markAsRead();
    }
    return view('notifications.index');
})->middleware('auth');

Route::get('mailTest', function () {
    $entreprises = Entreprise::all();
        foreach ($entreprises as $entreprise) {
            $nom = $entreprise->nom;
            $taches = $entreprise->taches()->where('statut_id', 1)->get();
            $data = [
                'nom' => $nom,
                'taches' => $taches
            ];
            if ($taches->count() > 0) {
                return (new OpenTaskNotification($data));
            }
        }
});
