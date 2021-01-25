@extends('global')

@section('content')

    <h2 class="text-center">Richiedi qui la pubblicazione del tuo videogioco all'interno del nostro catalogo! Inserisci
        i seguenti dati per effettuare la richiesta.</h2>
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

        <form class="mb-2" method="POST" action="{{route('richiediPubblicazioneVideogioco')}}"
              enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="titolo">Titolo</label>
                <input type="text" class="form-control" id="titolo" name="titolo" placeholder="Titolo">
            </div>
            <div class="form-group">
                <label for="descrizione">Descrizione</label>
                <textarea cols="40px" class="form-control" id="descrizione" name="descrizione"
                          placeholder="Descrizione"></textarea>
            </div>
            <div class="form-group">
                <label for="prezzo">Prezzo</label>
                <input type="number" step="0.01" class="form-control" id="prezzo" name="prezzo" placeholder="Prezzo">
            </div>
            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" class="form-control" id="logo" name="logo">
            </div>
            <div class="form-group">
                <label for="immagine1">Immagine 1</label>
                <input type="file" class="form-control" id="immagine1" name="immagine[]">
            </div>
            <div class="form-group">
                <label for="immagine2">Immagine 2</label>
                <input type="file" class="form-control" id="immagine2" name="immagine[]">
            </div>
            <div class="form-group">
                <label for="immagine3">Immagine 3</label>
                <input type="file" class="form-control" id="immagine3" name="immagine[]">
            </div>
            <div class="form-group">
                <label for="eseguibile">Eseguibile</label>
                <input type="file" class="form-control" id="eseguibile" name="eseguibile">
            </div>
            <button class="btn btn-block btn-success" type="submit">Procedi all'invio della richiesta!</button>
        </form>
    </div>
@endsection
