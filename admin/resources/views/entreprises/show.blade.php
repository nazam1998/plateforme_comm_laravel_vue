@extends('adminlte::page')

@section('title', 'Profil')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <h3 class="text-center">Profile de {{ $entreprise->nom }}</h3>
    <a href="{{ route('tache.index', $entreprise->tva) }}" class="btn btn-primary">Voir Tâches</a>
    <a href="{{ route('chat.show', $entreprise->tva) }}" class="btn btn-primary">Voir Messages</a>
    <div class="card-body">
        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12">
                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                        aria-describedby="example2_info">
                        <tbody>

                            <tr role="row" class="odd">
                                <td>TVA</td>
                                <td>{{ $entreprise->tva }}</td>
                            </tr>
                            <tr role="row" class="odd">
                                <td>Nom</td>
                                <td>{{ $entreprise->nom }}</td>
                            </tr>
                            <tr role="row" class="odd">
                                <td>Activité</td>
                                <td>{{ $entreprise->activite }}</td>
                            </tr>
                            <tr role="row" class="odd">
                                <td>Adresse</td>
                                <td>{{ $entreprise->adresse }}</td>
                            </tr>

                            <tr role="row" class="odd">
                                <td>Ville</td>
                                <td>{{ $entreprise->ville }}</td>
                            </tr>

                            <tr role="row" class="odd">
                                <td>Code Postal</td>
                                <td>{{ $entreprise->numero }}</td>
                            </tr>

                            <tr role="row" class="odd">
                                <td>Numéro</td>
                                <td>{{ $entreprise->numero }}</td>
                            </tr>

                            <tr role="row" class="odd">
                                <td>Nom Contact </td>
                                <td>{{ $entreprise->nom_contact }}</td>
                            </tr>

                            <tr role="row" class="odd">
                                <td>Email Contact </td>
                                <td>{{ $entreprise->email_contact }}</td>
                            </tr>

                            <tr role="row" class="odd">
                                <td>Numéro Contact </td>
                                <td>{{ $entreprise->numero_contact }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>

    </script>
@stop
