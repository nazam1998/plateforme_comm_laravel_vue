@extends('adminlte::page')

@section('title', 'Notifications')

@section('content_header')
    <h1>Notifications</h1>
@stop

@section('content')
    <ul class="list-group">

        @foreach (Auth::user()->notifications as $notif)
            @foreach ($notif->data as $data)
                <li class="list-group-item @if ($notif->read_at == null)bg-primary @endif">
                    {{-- Comme les données récupérées dans la notif sont dans un array
                        On les décodes pour que la blade puisse les lire --}}
                    <a href="{{route('chat.show', json_decode($data)->entreprise_id)}}">
                        Message from {{ App\Models\Entreprise::find(json_decode($data)->entreprise_id)->nom }} :
                        {{ json_decode($data)->msg }}
                    </a>
                </li>
            @endforeach
        @endforeach
    </ul>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
@stop
