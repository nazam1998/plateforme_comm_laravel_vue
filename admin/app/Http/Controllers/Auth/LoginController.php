<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Socialite;

class LoginController extends Controller
{
    protected $providers = ["google"];
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Permet à l'admin de se logger
    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);

        // On récupère le premier user qui est l'admin
        $admin = User::first();

        // On vérifie si l'email est valide et si l'user qui tente de se connecter est bien l'admin
        if ($request->email == $admin->email) {
            if (!Auth::attempt($attr)) {
                return redirect()->back()->with(['msg' => 'Mot de passe ou email invalides']);
            }
            // On génère un nouveau token
            $request->session()->regenerate();
            return redirect('/');
        }
        return redirect()->back()->with(['msg' => 'Mot de passe ou email invalides']);
    }

    public function providerLogin(Request $request)
    {
        // Vérifie si le lien du provider est bien dans la liste des providers supportés par notre app
        $provider = $request->provider;
        if (in_array($provider, $this->providers)) {
            return Socialite::driver($provider)->redirect(); // On redirige vers le provider
        }
        abort(404);
    }
    public function callback(Request $request)
    {

        $provider = $request->provider;

        if (in_array($provider, $this->providers)) {

            // Les informations provenant du provider
            $data = Socialite::driver($request->provider)->user();

            # Social login - register
            $email = $data->getEmail(); // L'adresse email

            # 1. On récupère l'utilisateur à partir de l'adresse email
            $user = User::where("email", $email)->first();

            # 2. Si l'utilisateur existe
            if (isset($user)) {
                # 4. On connecte l'utilisateur
                auth()->login($user);

                # 5. On redirige l'utilisateur vers /home
                if (auth()->check()) return redirect(route('home'));
            }
        }
        return redirect('/login')->with(['msg' => 'Ce compte google ne correspond pas au votre !']);
    }
}
