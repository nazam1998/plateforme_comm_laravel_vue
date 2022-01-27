@extends('adminlte::page')

@section('title', 'Taches')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <h3 class="text-center">Tâches de {{ $entreprise->nom }} {{ $entreprise->taches()->count() }}</h3>

    <a class="btn btn-primary" href="{{ route('tache.add', $entreprise->tva) }}">Ajouter une tâche</a>
    <div class="card-body table-responsive p-0">
        <table class="table table-valign-middle mb-5">
            <thead>
                <tr>
                    <th>Tache</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($entreprise->taches as $tache)
                    <tr class="@if ($tache->statut->nom == 'done')bg-secondary @endif">
                        <td>{{ $tache->tache }}</td>
                        <td>{{ $tache->statut->nom }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
    </script>
@stop
