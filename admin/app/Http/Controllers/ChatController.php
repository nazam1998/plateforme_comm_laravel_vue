<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($entreprise)
    {
        $entreprise = Entreprise::where('tva', $entreprise)->first();
        return view('messages.index', compact('entreprise'));
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

        return response()->json([
            'status' => 200,
            'data' => $msg,
            'message' => "Message envoyé avec succès"
        ]);
    }
}
