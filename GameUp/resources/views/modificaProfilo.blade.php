@extends('global')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{route('modificaDatiProfilo')}}" enctype="multipart/form-data">
        @csrf
        <div class="card mx-auto" style="max-width: 1000px;">
            <div class="row no-gutters">
                <div class="col-md-4 bg-light">
                    <img class="card-img" width="256px" height="256px" src="{{route('avatar')}}" alt="avatar">
                </div>
                <div class="col-md-8 bg-light">
                    <div class="card-body">
                        <div class="form-check">
                            <label for="username" class="col-4 card-title"><b>Username: </b></label>
                            <input class="col-4" id="username" type="text" name="username" value="{{$username}}"/>
                        </div>

                        <div class="form-check">
                            <label for="email" class="card-text col-4"><b>Email: </b></label>
                            <input class="col-4" id="email" type="text" name="email" value="{{$email}}"/>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label col-4" for="isSviluppatore">
                                <b>Account Sviluppatore</b>
                            </label>
                            <input name="isSviluppatore" class="form-check-input col-4" type="checkbox" value="1"
                                   id="isSviluppatore" {{$isSviluppatore ? 'checked' : ''}}>
                        </div>

                        <div class="form-check">
                            <label for="nuovaPassword" class="card-text col-4"><b>Cambia Password: </b></label>
                            <input class="col-4" id="nuovaPassword" type="password" name="nuovaPassword"/>
                        </div>

                        <div class="form-check">
                            <label for="confermaNuovaPassword" class="card-text col-4"><b>Conferma Nuova Password: </b></label>
                            <input class="col-4" id="confermaNuovaPassword" type="password"
                                   name="nuovaPassword_confirmation"/>
                        </div>

                        <div class="form-check">
                            <label for="avatar" class="card-text col-4"><b>Nuovo Avatar: </b></label>
                            <input class="col-4" id="avatar" type="file" name="avatar"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <label for="passwordAttuale" class="card-text">Inserisci la tua password attuale per permettere la
                    modifica dei tuoi dati:</label>
                <input id="passwordAttuale" type="password" name="passwordAttuale"/>
                <button type="submit" class="btn btn-block btn-success">Conferma Modifica</button>
            </div>
        </div>
    </form>
@endsection
