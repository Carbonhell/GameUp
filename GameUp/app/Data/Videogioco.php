<?php


namespace App\Data;


use App\Models\Videogiochi;

class Videogioco
{
    public $id;
    public $autore;
    public $logo;
    public $titolo;
    public $descrizione;
    public $prezzo;
    public $dataPubblicazione;
    public $dataCreazione;
    public $dataAggiornamento;
    public $numDownloads;

    public $tags;
    public $immagini;

    public static function from(Videogiochi $model)
    {
        $videogioco = new Videogioco();
        $videogioco->id = $model->id;
        $videogioco->autore = $model->autore->username;
        $videogioco->logo = $model->logo;
        $videogioco->titolo = $model->titolo;
        $videogioco->descrizione = $model->descrizione;
        $videogioco->prezzo = $model->prezzo;
        $videogioco->dataPubblicazione = $model->data_pubblicazione;
        $videogioco->dataCreazione = $model->created_at;
        $videogioco->dataAggiornamento = $model->updated_at;
        $videogioco->numDownloads = $model->compratori_count ?? 0;

        $videogioco->tags = $model->tags->pluck('titolo')->toArray();
        $videogioco->immagini = $model->immagini->pluck('immagine')->toArray();
        return $videogioco;
    }
}
