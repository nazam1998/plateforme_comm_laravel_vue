@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <h3 class="text-center">Welcome {{ Auth::user()->nom }}</h3>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="{{asset('js/app.js')}}"></script>
    <script>
        let authId = {{json_encode(Auth::id())}}
        window.Echo.private('App.Models.User.' + authId)
            .notification((notification) => {
                console.log(notification.type);
            });
    </script>
@stop
