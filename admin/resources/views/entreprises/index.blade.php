@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <h3 class="text-center">Toutes les entreprises</h3>
    <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                    <th>TVA</th>
                    <th>Nom</th>
                    <th>Contact</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($entreprises as $entreprise)
                    <tr>
                        <td>
                            {{ $entreprise->tva }}
                        </td>
                        <td>{{ $entreprise->nom }}</td>
                        <td>{{ $entreprise->nom_contact }}</td>
                        <td>
                            <a href="{{route('entreprise.show',$entreprise->tva)}}" class="text-muted">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
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
