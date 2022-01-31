<?php

namespace App\Http\Controllers;

use App\Events\ChatMessage;
use App\Models\Chat;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function index()
    {

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

        $entreprise = Entreprise::where('tva', $entreprise)->first();
        $msg = new Chat();
        $msg->msg = $request->msg;
        $msg->entreprise_id = $entreprise->tva;
        $msg->author_id = Auth::id();
        $msg->save();
        broadcast(new ChatMessage($msg));
        return redirect()->back();
    }

    public function apiIndex()
    {
        $messages = Chat::where('entreprise_id', Auth::user()->entreprise->tva)->get();
        return response()->json([
            'status' => 200,
            'data' => $messages,
            'message' => "Messages récupérées avec succès"
        ]);
    }

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

        broadcast(new ChatMessage($msg));
        return response()->json([
            'status' => 200,
            'data' => $msg,
            'message' => "Message envoyé avec succès"
        ]);
    }
}
