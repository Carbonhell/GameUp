@extends('global')

@section('content')

    <div class="bg-secondary p-2 text-white">
        <h3>Filtri</h3>
        <form method="GET" action="{{route('catalogo')}}" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6">
                    <div class="form-check">
                        <label for="titolo" class="col-3"><b>Titolo: </b></label>
                        <input id="titolo" class="col-3" type="text" name="titolo" value="{{request('titolo')}}"/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-check">
                        <label for="tagsObbligatorie"><b>Tags obbligatorie (usare la virgola come
                                divisore): </b></label>
                        <input id="tagsObbligatorie" type="text" name="tagsObbligatorie"
                               value="{{request('tagsObbligatorie')}}"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-check input-group">
                        <label for="prezzo" class="col-3"><b>Prezzo massimo: </b></label>
                        <div class="input-group-prepend">
                            <span class="input-group-text">€</span>
                        </div>
                        <input id="prezzo" class="col-3" type="number" step="0.01" min=0 name="prezzo"
                               value="{{request('prezzo')}}"/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-check">
                        <label for="tagsOpzionali"><b>Tags opzionali (usare la virgola come
                                divisore): </b></label>
                        <input id="tagsOpzionali" type="text" name="tagsOpzionali"
                               value="{{request('tagsOpzionali')}}"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-check">
                        <label class="form-check-label col-3" for="acquistati">
                            <b>Solo Acquistati</b>
                        </label>
                        <input name="acquistati" class="form-check-input col-3" type="checkbox" value="1"
                               id="acquistati" {{request('acquistati') ? 'checked' : ''}}>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-info">Applica Filtri</button>
        </form>
    </div>

    @forelse($videogiochi as $index => $videogioco)
        @if($index % 2 === 0)
            <div class="row">
                @endif
                <div class="col-6">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <a href="{{route('dettagliVideogioco', ['idVideogioco' => $videogioco->id])}}"><img
                                        src="{{asset($videogioco->logo)}}" class="card-img"
                                        alt="{{$videogioco->titolo}}"></a>
                            </div>
                            <div class="col-md-8"><a
                                    href="{{route('dettagliVideogioco', ['idVideogioco' => $videogioco->id])}}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$videogioco->titolo}}</h5>
                                        <p class="card-text">€{{$videogioco->prezzo}}</p>
                                        <p class="card-text">{{$videogioco->tags ? implode(',', $videogioco->tags) : 'N/A'}}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @if($index % 2 === 1)
            </div>
        @endif
    @empty
        <h1>Nessun videogioco trovato che rispetta i criteri da te forniti!</h1>
    @endforelse

@endsection
