@extends('global')

@section('content')
    <div class="mx-md-5">
        <section class="row row-cols-1 row-cols-md-2">
            <div class="col">
                <div class="d-flex flex-column flex-xl-row align-items-center justify-content-between mb-2 text-nowrap">
                    <h5 class="d-inline m-1 ">{{$videogioco->titolo}}</h5>
                    <a class="btn btn-outline-dark m-1">Vai al Forum</a>
                    <a class="btn btn-outline-dark m-1">Sponsorizza</a>
                    <a class="btn btn-outline-dark m-1">Modifica</a>
                </div>

                <div class="carousel slide" data-ride="carousel" id="carousel">
                    <div class="carousel-inner">
                        @foreach($videogioco->immagini as $immagine)
                            <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                                <img alt="##alttext" class="d-block w-75 mx-auto"
                                     src="{{asset($immagine)}}">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" data-slide="prev" href="#carousel" role="button">
                        <span aria-hidden="true" class="carousel-control-prev-icon"></span>
                        <span class="sr-only">Precedente</span>
                    </a>
                    <a class="carousel-control-next" data-slide="next" href="#carousel" role="button">
                        <span aria-hidden="true" class="carousel-control-next-icon"></span>
                        <span class="sr-only">Successivo</span>
                    </a>
                </div>
            </div>
            <div class="col">
                <img alt="Logo Videogioco" class="my-3 d-block"
                     src="{{asset($videogioco->logo)}}"/>
                <span class="my-2 d-block">{{$videogioco->autore}}</span>
                <span class="my-2 d-block">Downloads: {{$videogioco->numDownloads}}</span>
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <span class="my-2 d-block pr-2">Tags: {{implode(', ', $videogioco->tags)}}</span>
                    <a class="btn btn-outline-dark text-nowrap align-self-start align-self-md-center my-2"
                       style="height: min-content">Suggerisci altre tags!</a>
                </div>
                <a class="btn btn-outline-dark" data-desc="TODO">Report</a>
            </div>
        </section>
        <section class="mt-4">
            <a class="btn btn-outline-dark"><h4 class="m-0 mx-5">Acquista per:
                    €{{$videogioco->prezzo}}</h4></a>
            <p class="mx-5 mt-4">
                {{$videogioco->descrizione}}
            </p>
        </section>
        <section class="mt-4">
            <h3>Recensioni</h3>
            <div class="border border-dark mb-2">
                <br>
                <div>
                    <div class="d-flex flex-column flex-sm-row">
                        <img alt="thumbs up" class="align-self-start mr-4 mb-5 reviewicon"

                             src="media/thumbs-up.svg"/>
                        <div class="d-flex align-self-end mx-2">
                            <img alt="profile picture" class="rounded-circle d-inline-block float-left align-self-start"
                            >
                            <div class="ml-3 d-flex flex-column">
                                <h5>##First Last</h5>
                                <p class="ml-3">##Text here Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Morbi interdum nunc ut tellus fermentum, id vehicula est pulvinar. Suspendisse
                                    ornare eget quam vitae consequat. Pellentesque neque nunc, ultrices in ultrices ac,
                                    tristique ut quam. Proin placerat orci id arcu finibus consectetur. Ut pulvinar,
                                    velit ut aliquam porta, felis lorem tincidunt sapien, vel tempor libero arcu vel
                                    eros</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-2 mx-3">
                        <span class="align-middle">Questa recensione ti è stata utile?</span>
                        <div class="d-inline-block">
                            <button class="btn btn-outline-dark">
                                <img alt="thumbs up" class="smallicon" src="{{asset('storage/thumbs-up.svg')}}"/>
                                Si
                            </button>
                            <button class="btn btn-outline-dark">
                                <img alt="thumbs down" class="smallicon" src="{{asset('storage/thumbs-down.svg')}}"/>
                                No
                            </button>
                        </div>
                    </div>
                    <hr>
                </div>
                <form class="d-flex flex-sm-row">
                    <label for="nuovaRecensione">Aggiungi la tua recensione!</label>
                    <textarea cols="300" id="nuovaRecensione"></textarea>
                    <button type="submit">Invia Recensione</button>
                </form>
            </div>
        </section>
    </div>
@endsection
