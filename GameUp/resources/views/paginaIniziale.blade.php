@extends('global')

@section('content')

    <h1>Gli ultimi giochi pubblicati:</h1>

    @foreach($ultimiVideogiochiPubblicati as $index => $videogioco)
        @if($index % 2 === 0)
            <div class="row">
                @endif
                <div class="col-6">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{route('getLogo', ['idVideogioco' => $videogioco->id])}}" class="card-img"
                                     alt="{{$videogioco->titolo}}">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{$videogioco->titolo}}</h5>
                                    <p class="card-text">€{{$videogioco->prezzo}}</p>
                                    <p class="card-text">TAGS</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($index % 2 === 1)
            </div>
        @endif
    @endforeach

@endsection
