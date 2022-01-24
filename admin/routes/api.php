<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EntrepriseController;
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

    //Get User and its entreprise
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        $user = $request->user()->with('entreprise')->where('id', $request->user()->id)->first();
        return response()->json([
            'data' => $user
        ]);
    });

    //Authentication
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    //Chat
    Route::get('chat', [EntrepriseController::class, 'apiIndex'])->middleware('auth:sanctum');
    Route::post('chat', [EntrepriseController::class, 'apiStore'])->middleware('auth:sanctum');

    //Entreprise Profile
    Route::post('entreprise', [EntrepriseController::class, 'apiStore'])->middleware('auth:sanctum');;
    Route::put('entreprise', [EntrepriseController::class, 'apiUpdate'])->middleware('auth:sanctum');;

    //Tache
    Route::get('taches', [TacheController::class, 'apiIndex'])->middleware('auth:sanctum');;
    Route::post('tache', [TacheController::class, 'apiSetStatus'])->middleware('auth:sanctum');;
});
