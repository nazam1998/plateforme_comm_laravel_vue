<?php

namespace App\Http\Controllers;

use App\Events\NewTache;
use App\Jobs\NewTacheJob;
use App\Models\Entreprise;
use App\Models\Tache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($entreprise)
    {
        $entreprise = Entreprise::where('tva', $entreprise)->first();
        $taches = Tache::where('entreprise_id', $entreprise->tva)->get();
        return view('taches.index', compact('entreprise', 'taches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($entreprise)
    {
        $entreprise = Entreprise::where('tva', $entreprise)->first();
        return view('taches.add', compact('entreprise'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $entreprise)
    {
        $request->validate([
            'tache' => ['required', 'string', 'min:1']
        ]);

        $entreprise = Entreprise::where('tva', $entreprise)->first();
        $tache = new Tache();
        $tache->entreprise_id = $entreprise->tva;
        $tache->statut_id = 1;
        $tache->tache = $request->tache;
        $tache->save();
        $data = [
            'nom' => $entreprise->nom,
            'task' => $tache->tache,
            'email' => $entreprise->user->email,
            'entreprise' => $entreprise->tva
        ];
        NewTacheJob::dispatch($data);
        return redirect()->route('tache.index', $entreprise->tva);
    }

    public function apiIndex()
    {
        $taches = Tache::with('statut')->where('entreprise_id', Auth::user()->entreprise->tva)->get();
        return response()->json([
            'status' => 200,
            'data' => $taches,
            'message' => "Tâches récupérées avec succès"
        ]);
    }

    public function apiSetStatus(Request $request)
    {

        $tache = Tache::find($request->tache_id);
        $tache->statut_id = $request->statut_id;
        $tache->save();
        return response()->json([
            'status' => 200,
            'data' => $tache,
            'message' => "Votre tâche est maintenant " . $tache->statut->nom,
        ]);
    }
}
