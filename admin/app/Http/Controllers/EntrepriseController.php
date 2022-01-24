<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Entreprise;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function apiStore(Request $request)
    {
        if (Auth::entreprise()->exists()) {
            return response()->json([
                'status' => 403,
                'data' => null,
                'message' => "Vous avez déjà une entreprise !"
            ]);
        }

        $request->validate([
            'tva' => ['required', 'string', 'min:8'],
            'nom' => ['required', 'string', 'min:8'],
            'activite' => ['required', 'string', 'min:8'],
            'adresse' => ['required', 'string', 'min:8'],
            'ville' => ['required', 'string', 'min:8'],
            'numero' => ['required', 'digits:9'],
            'code_postal' => ['required', 'digits:4'],
            'email_contact' => ['required', 'string', 'email', 'max:255', 'unique:entreprises'],
            'nom_contact' => ['required', 'string', 'min:8'],
            'numero_contact' => ['required', 'digits:9'],
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

        return response()->json([
            'status' => 200,
            'data' => $entreprise,
            'message' => "Votre profile a été crée avec succès"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function show($entreprise)
    {
        $entreprise = Entreprise::where('tva', $entreprise)->first();
        return view('entreprises.show', compact('entreprise'));
    }

    public function apiUpdate(Request $request)
    {

        if (Auth::entreprise()->exists()) {
            return response()->json([
                'status' => 403,
                'data' => null,
                'message' => "Vous n'avez pas une entreprise !"
            ]);
        }
        $request->validate([
            'email_contact' => ['required', 'string', 'email', 'max:255', 'unique:entreprises'],
            'nom_contact' => ['required', 'string', 'min:8'],
            'numero_contact' => ['required', 'digits:9'],
        ]);

        $entreprise = Auth::user()->entreprise;
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
}