<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\ChatController;
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

Route::middleware('auth')->get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('entreprise', [EntrepriseController::class, 'index'])->middleware('auth');
Route::get('entreprise/{tva}', [EntrepriseController::class, 'show'])->name('entreprise.show')->middleware('auth');
Route::get('tache/{tva}', [TacheController::class, 'index'])->name('tache.index')->middleware('auth');
Route::get('tache/{tva}/add', [TacheController::class, 'create'])->name('tache.add')->middleware('auth');
Route::post('tache/{tva}', [TacheController::class, 'store'])->name('tache.store')->middleware('auth');
Route::get('chat/{tva}',[ChatController::class, 'index'])->name('chat.index')->middleware('auth');
Route::post('chat/{tva}',[ChatController::class, 'store'])->name('chat.store')->middleware('auth');
