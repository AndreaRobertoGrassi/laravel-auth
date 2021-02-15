@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- upload immagini --}}
                <div class="card">
                    <div class="card-header">User icon updater</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('update-icon') }}" method="post" enctype="multipart/form-data"> {{-- enctype: trasferire dei file dal client al server --}}

                            @csrf
                            @method('post')

                            <input name="icon" type="file" class="form-control border-0">
                            <br>
                            <input type="submit" class="btn btn-primary" value="UPDATE ICON">
                            <a href="{{route('clear-icon')}}" class="btn btn-danger">CLEAR ICON</a>
                        </form>

                        
                    </div>
                </div>

                <br>

                {{-- invio email --}}
                <div class="card">
                    <div class="card-header">Mail sender</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('send-mail') }}" method="post">
                            @csrf
                            @method('post')
                            <label for="text">Text</label>
                            <input type="text" name="text">

                            <br>

                            <input type="submit" value="SEND MAIL">
                        </form>


                    </div>
                </div>

                <br>

                {{-- invio email vuota --}}
                <div class="card">
                    <div class="card-header">Empty mail sender</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('send-empty-mail') }}" method="post">
                            @csrf
                            @method('post')

                            <input type="submit" value="SEND EMPTY MAIL">
                        </form>

                    </div>
                </div>
                

                @if (Auth::user()-> icon)    {{--se l'utente ha un'iconda diversa da null}}
                    {{-- upload immagini --}}
                    <br>

                    <div class="card">
                        <div class="card-header">Icon</div>

                        <div class="card-body">
                            <h1>I'm a developer</h1>

                            <br>
                            <img src="{{ asset('storage/icon/' . Auth::user() -> icon) }}" width="300px">

                        </div>
                    </div>
                @endif
                


            </div>
        </div>
    </div>
@endsection