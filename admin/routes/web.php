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

// Route qui montre toutes les entreprises
Route::get('entreprise', [EntrepriseController::class, 'index'])->middleware('auth');
// Route qui montre les informations particulières d'une entreprise
Route::get('entreprise/{tva}', [EntrepriseController::class, 'show'])->name('entreprise.show')->middleware('auth');

//Entreprise Tasks

// Route qui montre toutes les taches d'une entreprise
Route::get('tache/{tva}', [TacheController::class, 'index'])->name('tache.index')->middleware('auth');
// Route qui permet d'ajouter une tache à une entreprise
Route::get('tache/{tva}/add', [TacheController::class, 'create'])->name('tache.add')->middleware('auth');
// Route qui ajoute une tache à une entreprise
Route::post('tache/{tva}', [TacheController::class, 'store'])->name('tache.store')->middleware('auth');

//Entreprises Messages

// Permet de récupérer toutes les discussions avec toutes les entreprises
Route::get('chat', [ChatController::class, 'index'])->name('chat.index')->middleware('auth');
// Permet de récupérer la discussion avec une entreprise particulière
Route::get('chat/{tva}', [ChatController::class, 'show'])->name('chat.show')->middleware('auth');
// Permet d'envoyer un message à une entreprise
Route::post('chat/{tva}', [ChatController::class, 'store'])->name('chat.store')->middleware('auth');

// Permet de récupèrer les notifications de l'admin
Route::get('notifications', function () {
    foreach (Auth::user()->unreadNotifications as $notif) {
        $notif->markAsRead();
    }
    return view('notifications.index');
})->middleware('auth');


