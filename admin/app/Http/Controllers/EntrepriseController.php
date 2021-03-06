<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Entreprise;
use App\Models\User;

class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entreprises = Entreprise::all();
        return view('entreprises.index', compact('entreprises'));
    }


    /**
     * Permet de compléter le profil de l'entreprise
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function apiStore(Request $request)
    {
        if (Auth::user()->entreprise()->exists()) {
            return response()->json([
                'status' => 403,
                'data' => null,
                'message' => "Vous avez déjà une entreprise !"
            ]);
        }

        $request->validate([
            'tva' => ['required', 'numeric', 'min:5'],
            'nom' => ['required', 'string', 'min:4'],
            'activite' => ['required', 'string', 'min:8'],
            'adresse' => ['required', 'string', 'min:8'],
            'ville' => ['required', 'string', 'min:8'],
            'numero' => ['required', 'min:4'],
            'code_postal' => ['required', 'min:4'],
            'email_contact' => ['required', 'string', 'email', 'max:255'],
            'nom_contact' => ['required', 'string', 'min:8'],
            'numero_contact' => ['required', 'min:9'],
        ]);

        $entreprise = new Entreprise();
        $entreprise->tva = $request->tva;
        $entreprise->nom = $request->nom;
        $entreprise->activite = $request->activite;
        $entreprise->adresse = $request->adresse;
        $entreprise->ville = $request->ville;
        $entreprise->numero = $request->numero;
        $entreprise->code_postal = $request->code_postal;
        $entreprise->email_contact = $request->email_contact;
        $entreprise->nom_contact = $request->nom_contact;
        $entreprise->numero_contact = $request->numero_contact;
        $entreprise->user_id = Auth::id();

        $entreprise->save();
        $user = User::with('entreprise')->where('id', Auth::id())->first();
        return response()->json([
            'status' => 200,
            'data' => $user,
            'message' => "Votre profile a été crée avec succès"
        ]);
    }

    /**
     * Permet d'afficher les infos d'une entreprise côté admin
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function show($entreprise)
    {
        $entreprise = Entreprise::where('tva', $entreprise)->first();
        if($entreprise){

            return view('entreprises.show', compact('entreprise'));
        }
        return redirect()->back();
    }

    // Permet de modifier les infos de l'entreprise côté entreprise
    public function apiUpdate(Request $request)
    {

        if (!Auth::user()->entreprise()->exists()) {
            return response()->json([
                'status' => 403,
                'data' => null,
                'message' => "Vous n'avez pas une entreprise !"
            ]);
        }
        $request->validate([
            'email_contact' => ['required', 'string', 'email', 'max:255'],
            'nom_contact' => ['required', 'string', 'min:8'],
            'numero_contact' => ['required', 'min:9'],
        ]);

        $entreprise = Entreprise::where('user_id', Auth::id())->first();
        $entreprise->email_contact = $request->email_contact;
        $entreprise->nom_contact = $request->nom_contact;
        $entreprise->numero_contact = $request->numero_contact;

        $entreprise->save();

        return response()->json([
            'status' => 200,
            'data' => $entreprise,
            'message' => "Votre profile a été mis à jour avec succès"
        ]);
    }

    // Permet de récupérer tous les notifications d'une entreprise
    public function notification()
    {
        $notifications = Auth::user()->notifications;
        return response()->json([
            'statut' => 200,
            'data' => $notifications,
            'message' => 'Notifications récupérées'
        ]);
    }

    // Permet de mettre toutes les notifications à l'état lue une fois arrivé sur la page notifications
    public function readnotification()
    {
        foreach (Auth::user()->notifications as $notification) {
            $notification->markAsRead();
        }
        return response()->json([
            'statut' => 200,
            'data' => [],
            'message' => 'Notifications lues'
        ]);
    }
}
