@extends('global')

@section('content')
    <div class="card mx-auto" style="max-width: 1000px;">
        <div class="row no-gutters">
            <div class="col-md-4 bg-light">
                <img class="card-img" width="256px" height="256px" src="{{route('avatar')}}" alt="avatar">
            </div>
            <div class="col-md-8 bg-light">
                <div class="card-body">
                    <h5 class="card-title">{{$username}}</h5>
                    <p class="card-text">Email: {{$email}}</p>
                    <p class="card-text">Account Sviluppatore: {{$isSviluppatore ? 'Si' : 'No'}}</p>
                    <a href="{{route('modificaProfilo')}}" class="btn btn-block btn-warning">Modifica</a>
                </div>
            </div>
        </div>
    </div>
@endsection
