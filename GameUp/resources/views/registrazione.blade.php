@extends('global')

@section('content')

    <h2 class="text-center">Benvenuto su GameUp! Compila i seguenti campi per effettuare la registrazione al sistema.</h2>
    <div class="mx-auto col-4">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <form method="POST" action="{{route('effettuaRegistrazione')}}" enctype="multipart/form-data"
          oninput='confermaPassword.setCustomValidity(confermaPassword.value !== password.value ? "La password è diversa!" : "")'>
        @csrf
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="confermaPassword">Conferma Password</label>
            <input type="password" class="form-control" id="confermaPassword" name="password_confirmation" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="avatar">Avatar</label>
            <input type="file" class="form-control" id="avatar" name="avatar" placeholder="Avatar">
        </div>
        <button class="btn btn-block btn-success" type="submit">Registrati!</button>
    </form>
    </div>
@endsection
