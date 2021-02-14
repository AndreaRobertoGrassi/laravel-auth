@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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

                        <br><br>
                        <form action="{{ route('send-empty-mail') }}" method="post">
                            @csrf
                            @method('post')

                            <input type="submit" value="SEND EMPTY MAIL">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
