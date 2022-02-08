<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\TacheController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {

    // Permet de récupérer les informations du user connecté ainsi que son entreprise
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        $user = $request->user()->with('entreprise')->where('id', $request->user()->id)->first();
        return response()->json([
            'data' => $user
        ]);
    });

    //Authentication
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    //Chat

    // Permet de récupèrer tous les messages de la discussion avec l'admin
    Route::get('chat', [ChatController::class, 'apiIndex'])->middleware('auth:sanctum');
    // Permet d'envoyer un message à l'admin
    Route::post('chat', [ChatController::class, 'apiStore'])->middleware('auth:sanctum');

    //Entreprise Profile

    // Permet de compléter son profil
    Route::post('entreprise', [EntrepriseController::class, 'apiStore'])->middleware('auth:sanctum');
    // Permet de modifier certaines informations du profil
    Route::put('entreprise/profile', [EntrepriseController::class, 'apiUpdate'])->middleware('auth:sanctum');

    //Tache

    // Permet récupérer toutes les taches de l'entreprise
    Route::get('taches', [TacheController::class, 'apiIndex'])->middleware('auth:sanctum');
    // Permet de changer l'etat d'une tache
    Route::post('tache', [TacheController::class, 'apiSetStatus'])->middleware('auth:sanctum');

    //Notification

    // Permet de récupérer toutes les notifications non lues
    Route::get('notification', [EntrepriseController::class, 'notification'])->middleware('auth:sanctum');
    // Met à jour l'état des notifications non lues
    Route::get('readnotification', [EntrepriseController::class, 'readnotification'])->middleware('auth:sanctum');
});
