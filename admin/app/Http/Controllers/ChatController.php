<?php

namespace App\Http\Controllers;

use App\Jobs\ChatMessageJob;
use App\Models\Chat;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function index()
    {
        // Permet de récupérer le dernier message de chaque entreprise dans l'ordre du dernier envoyé
        $entreprises = Entreprise::select('entreprises.*')
            ->join('chats', 'entreprises.tva', '=', 'chats.entreprise_id')
            ->groupBy('entreprises.tva')
            ->orderByRaw('max(chats.created_at) desc')
            ->get();

        return view('messages.index', compact('entreprises'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($entreprise)
    {

        // Permet de vérifier si une entreprise existe bel et bien
        $entreprise = Entreprise::where('tva', $entreprise)->first();
        if ($entreprise != null) {
            return view('messages.show', compact('entreprise'));
        } else {
            return redirect()->back();
        }
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
            'msg' => ['required', 'string', 'min:1']
        ]);

        // Vérifie si l'entreprise existe
        $entreprise = Entreprise::where('tva', $entreprise)->first();
        if ($entreprise) {
            $msg = new Chat();
            $msg->msg = $request->msg;
            $msg->entreprise_id = $entreprise->tva;
            $msg->author_id = Auth::id();
            $msg->save();
            // Permet de lancer le job
            ChatMessageJob::dispatch($msg);
        }
        return redirect()->back();
    }

    // Permet de récupérer les messages de la conversation avec l'entreprise pour côté entreprise
    public function apiIndex()
    {
        $messages = Chat::where('entreprise_id', Auth::user()->entreprise->tva)->get();
        return response()->json([
            'status' => 200,
            'data' => $messages,
            'message' => "Messages récupérées avec succès"
        ]);
    }


    // Permet de stocker le message envoyé par l'entreprise
    public function apiStore(Request $request)
    {
        $request->validate([
            'msg' => ['required', 'string', 'min:1']
        ]);

        $msg = new Chat();
        $msg->msg = $request->msg;
        $msg->entreprise_id = Auth::user()->entreprise->tva;
        $msg->author_id = Auth::id();
        $msg->save();
        // Permet de lancer le job
        ChatMessageJob::dispatch($msg);
        return response()->json([
            'status' => 200,
            'data' => $msg,
            'message' => "Message envoyé avec succès"
        ]);
    }
}
