@extends('adminlte::page')

@section('title', 'Message')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <h3 class="text-center">Your discussion with {{ $entreprise->nom }}</h3>
    <section style="background-color: #eee;">
        <div class="container py-5">

            <div class="row d-flex justify-content-center">
                <div class="col-10">

                    <div class="card" id="chat1" style="border-radius: 15px;">
                        <div class="card-body">
                            <div id="chat-messages">

                                @foreach ($entreprise->messages()->orderBy('created_at')->get()
        as $message)
                                    @if ($message->author_id == Auth::id())
                                        <div class="d-flex flex-row justify-content-end mb-4 w-100">
                                            <div class="p-3 ms-3 text-right"
                                                style="border-radius: 15px; background-color: rgba(57, 192, 237,.2);">
                                                <p class="small mb-0">{{ $message->msg }}</p>
                                                <span
                                                    class="text-secondary small mt-2 mb-0">{{ $message->created_at }}</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="d-flex flex-row justify-content-start mb-4 w-100">
                                            <div class="p-3 me-3 border text-left"
                                                style="border-radius: 15px; background-color: #fbfbfb;">
                                                <p class="small mb-0">{{ $message->msg }}</p>
                                                <span
                                                    class="text-secondary small mt-2 mb-0">{{ $message->created_at }}</span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="form-outline">

                                <textarea name="msg" id="text-form" class="form-control" id="textAreaExample"
                                    rows="4"></textarea>
                                <div class="text-center mt-4">
                                    <button id="send" class="btn btn-primary">Send</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
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
    <script src="{{ asset('js/app.js') }}">

    </script>
    <script type="text/javascript">
        let chat = document.getElementById('chat-messages');
        console.log(chat);
        window.Echo.channel('Chat').listen('ChatMessage', e => {
            console.log(e.data)
            let row = document.createElement('div');
            let para = document.createElement('div');
            let msg = document.createElement('p');
            let time = document.createElement('span');

            let auth = {!! json_encode(Auth::id()) !!};
            if (e.data.author_id == auth) {
                row.className = "d-flex flex-row justify-content-end mb-4 w-100"
                para.className = "p-3 me-3 border text-left"
                para.style.backgroundColor = "rgba(57, 192, 237,.2)"
            } else {
                row.className = "d-flex flex-row justify-content-start mb-4 w-100"
                para.className = "p-3 me-3 border text-right"
                para.style.backgroundColor = "#FBFBFB"
            }
            time.className = "text-secondary small mt-2 mb-0";
            msg.className = "small mb-0";
            para.style.borderRadius = "15px";
            msg.innerText = e.data.msg;
            time.innerText = e.data.created_at;
            chat.appendChild(row);
            row.appendChild(para);
            para.appendChild(msg);
            para.appendChild(time);
        });
        
        let tva = {!! json_encode($entreprise->tva) !!};
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#send").on('click', (function(evt) {
            evt.preventDefault();
            $.ajax({
                url: "/chat/" + tva,
                type: "POST",
                data: {
                    msg: $("#text-form").val(),
                },
                success: function(data) {
                    $("#text-form").val('')
                },
                error: function(msg) {
                }
            });
        }));
    </script>
@stop
