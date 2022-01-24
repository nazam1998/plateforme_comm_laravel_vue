@extends('adminlte::page')

@section('title', 'Ajouter Tache')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="card-header">
        <h3 class="card-title">Ajouter Tache</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ route('tache.store', $entreprise->tva) }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Tâche pour {{ $entreprise->nom }}</label>
                <input type="text" class="form-control" name="tache" placeholder="Entrez une tâche">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>

    </script>
@stop
