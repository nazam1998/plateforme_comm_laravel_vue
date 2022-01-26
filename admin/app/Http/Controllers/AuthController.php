<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
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
        event(new Registered($user));

        Auth::login($user);

        return response()->json([
            'status' => 200,
            'data' => [
                'type' => 'bearer',
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


        $admin = User::first();


        if (!Auth::attempt($attr) || $request->email == $admin->email) {
            return $this->error('Mot de passe ou email invalides', 401);
        }

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
        auth()->user()->currentAccessToken()->delete();
        return response()->json(['msg' => 'Vous avez été déconnecté avec succès']);
    }
}
