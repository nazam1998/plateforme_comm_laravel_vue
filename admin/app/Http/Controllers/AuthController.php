<?php

namespace App\Http\Controllers;


use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\RegisterUserJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponser;

    public function register(Request $request)
    {

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::create([

            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // Envoie un job pour envoyer un mail au nouvel user enregistré
        RegisterUserJob::dispatch($user->email);

        // Permet de connecter automatiquement le user créer

        Auth::login($user);

        return response()->json([
            'status' => 200,
            'data' => [
                'type' => 'bearer',
                // Permet de créer un token pour l'api
                'token' => Auth::user()->createToken('API Token')->plainTextToken
            ],
            'message' => "Votre compte a été créé avec succès"
        ]);
    }

    public function login(Request $request)
    {

        $attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:8'
        ]);

        // Récupère le premier user qui correspond à l'admin
        $admin = User::first();

        // Si la tentative de connexion échoue, on renvoie un message d'erreur
        if (!Auth::attempt($attr) || $request->email == $admin->email) {
            return $this->error('Mot de passe ou email invalides', 401);
        }

        // On envoie le token si le user a pu se connecter correctement
        return response()->json([
            'status' => 200,
            'data' => [
                'type' => 'bearer',
                'token' => $request->user()->createToken('API Token')->plainTextToken
            ],
            'message' => "Vous avez été connecté avec succès"
        ]);
    }

    public function logout(Request $request)
    {
        // Permet de déconnecter le user en supprimant le token
        auth()->user()->currentAccessToken()->delete();
        return response()->json(['msg' => 'Vous avez été déconnecté avec succès']);
    }
}
