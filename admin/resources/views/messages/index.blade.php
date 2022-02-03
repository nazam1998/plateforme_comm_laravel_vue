@extends('adminlte::page')

@section('title', 'Message')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')


    <div class="card-header">
        <h3 class="card-title">Your messages</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table">
            <tbody>
                @foreach ($entreprises as $entreprise)
                    @if ($entreprise->messages()->latest()->first()->author_id == Auth::id())
                        <tr class="bg-primary text-white text-right">


                            <td class="text-left">{{ $entreprise->nom }}</td>
                            <td class="text-left">{{ $entreprise->messages()->latest()->first()->msg }}</td>
                            <td>
                                <a href="{{ route('chat.show', $entreprise->tva) }}" class="btn btn-light">See more</a>
                            </td>

                        </tr>
                    @else
                        <tr class="bg-light text-right">
                            <td class="text-left">{{ $entreprise->nom }}</td>
                            <td class="text-right">{{ $entreprise->messages()->latest()->first()->msg }}</td>
                            <td>

                                <a href="{{ route('chat.show', $entreprise->tva) }}" class="btn btn-secondary">See more</a>
                            </td>
                        </tr>

                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('css')
    <style>
        #chat-messages {
            height: 300px;
            overflow: auto;
        }

        #chat1 .form-outline .form-control~.form-notch div {
            pointer-events: none;
            border: 1px solid;
            border-color: #eee;
            box-sizing: border-box;
            background: transparent;
        }

        #chat1 .form-outline .form-control~.form-notch .form-notch-leading {
            left: 0;
            top: 0;
            height: 100%;
            border-right: none;
            border-radius: .65rem 0 0 .65rem;
        }

        #chat1 .form-outline .form-control~.form-notch .form-notch-middle {
            flex: 0 0 auto;
            max-width: calc(100% - 1rem);
            height: 100%;
            border-right: none;
            border-left: none;
        }

        #chat1 .form-outline .form-control~.form-notch .form-notch-trailing {
            flex-grow: 1;
            height: 100%;
            border-left: none;
            border-radius: 0 .65rem .65rem 0;
        }

        #chat1 .form-outline .form-control:focus~.form-notch .form-notch-leading {
            border-top: 0.125rem solid #39c0ed;
            border-bottom: 0.125rem solid #39c0ed;
            border-left: 0.125rem solid #39c0ed;
        }

        #chat1 .form-outline .form-control:focus~.form-notch .form-notch-leading,
        #chat1 .form-outline .form-control.active~.form-notch .form-notch-leading {
            border-right: none;
            transition: all 0.2s linear;
        }

        #chat1 .form-outline .form-control:focus~.form-notch .form-notch-middle {
            border-bottom: 0.125rem solid;
            border-color: #39c0ed;
        }

        #chat1 .form-outline .form-control:focus~.form-notch .form-notch-middle,
        #chat1 .form-outline .form-control.active~.form-notch .form-notch-middle {
            border-top: none;
            border-right: none;
            border-left: none;
            transition: all 0.2s linear;
        }

        #chat1 .form-outline .form-control:focus~.form-notch .form-notch-trailing {
            border-top: 0.125rem solid #39c0ed;
            border-bottom: 0.125rem solid #39c0ed;
            border-right: 0.125rem solid #39c0ed;
        }

        #chat1 .form-outline .form-control:focus~.form-notch .form-notch-trailing,
        #chat1 .form-outline .form-control.active~.form-notch .form-notch-trailing {
            border-left: none;
            transition: all 0.2s linear;
        }

        #chat1 .form-outline .form-control:focus~.form-label {
            color: #39c0ed;
        }

        #chat1 .form-outline .form-control~.form-label {
            color: #bfbfbf;
        }

    </style>
@stop

@section('js')
    <script>

    </script>
@stop
