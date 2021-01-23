<?php


namespace App\Data;


use App\Models\Videogiochi;

class Videogioco
{
    public $id;
    public $autoreId;
    public $logo;
    public $titolo;
    public $descrizione;
    public $prezzo;
    public $dataPubblicazione;
    public $dataCreazione;
    public $dataAggiornamento;

    public $tags;

    public static function from(Videogiochi $model)
    {
        $videogioco = new Videogioco();
        $videogioco->id = $model->id;
        $videogioco->autoreId = $model->autore_id;
        $videogioco->logo = $model->logo;
        $videogioco->titolo = $model->titolo;
        $videogioco->descrizione = $model->descrizione;
        $videogioco->prezzo = $model->prezzo;
        $videogioco->dataPubblicazione = $model->data_pubblicazione;
        $videogioco->dataCreazione = $model->created_at;
        $videogioco->dataAggiornamento = $model->updated_at;
        return $videogioco;
    }

    public function withTags(array $tags) {
        $this->tags = $tags;
        return $this;
    }
}
