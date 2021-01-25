<?php


namespace App\Repositories;


use App\Data\Videogioco;
use App\Models\Videogiochi;
use App\Models\VideogiochiRichieste;
use App\Models\VideogiochiRichiesteImmagini;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

class VideogiocoRepository
{
    public function getVideogioco(int $idVideogioco)
    {
        $model = Videogiochi::find($idVideogioco);
        if ($model) {
            return Videogioco::from($model);
        }
        return null;
    }

    /**
     * @return array
     */
    public function ottieniUltimiVideogiochiPubblicati(): array
    {
        return Videogiochi::orderByDesc('data_pubblicazione')
            ->take(10)
            ->get()
            ->map(
                function (Videogiochi $videogioco) {
                    return Videogioco::from($videogioco);
                }
            )->toArray();
    }

    public function applicaCriteri(
        string $titolo = null,
        float $prezzo = null,
        array $tagsObbligatorie = null,
        array $tagsOpzionali = null,
        int $idUtente = null,
        bool $acquistati = false,
        string $ordine = 'DESC'
    ) {
        $query = Videogiochi::with('tags');
        if ($titolo) {
            $query->where('titolo', 'LIKE', '%' . $titolo . '%');
        }
        if ($prezzo) {
            $query->where('prezzo', '<=', $prezzo);
        }
        if ($acquistati && $idUtente) {
            $query->whereHas(
                'compratori',
                function ($query) use ($idUtente) {
                    $query->where('users.id', '=', $idUtente);
                }
            );
        }
        if ($ordine === 'DESC') {
            $query->orderByDesc('data_pubblicazione');
        } else {
            $query->orderBy('data_pubblicazione');
        }
        $results = $query->get();
        if ($tagsObbligatorie) {
            $tagsObbligatorieCollection = collect($tagsObbligatorie);
            $results = $results->filter(
                function (Videogiochi $videogioco) use ($tagsObbligatorieCollection) {
                    /** @var Collection $tags */
                    $tags = $videogioco->tags
                        ->pluck('titolo');
                    return $tagsObbligatorieCollection->intersect($tags)->count(
                        ) === $tagsObbligatorieCollection->count();
                }
            );
        }
        if ($tagsOpzionali) {
            $tagsOpzionaliCollection = collect($tagsOpzionali);
            $results = $results->filter(
                function (Videogiochi $videogioco) use ($tagsOpzionaliCollection) {
                    /** @var Collection $tags */
                    $tags = $videogioco->tags
                        ->pluck('titolo');
                    return $tagsOpzionaliCollection->intersect($tags)->count() > 0;
                }
            );
        }
        return $results->map(
            function (Videogiochi $videogioco) {
                return Videogioco::from($videogioco);
            }
        );
    }

    public function createRichiestaPubblicazione(
        int $idAutore,
        UploadedFile $logo,
        string $titolo,
        array $immagini,
        string $descrizione,
        float $prezzo,
        UploadedFile $eseguibile
    ) {
        $richiesta = new VideogiochiRichieste();
        $richiesta->autore_id = $idAutore;
        $richiesta->logo = \Storage::putFile('public/uploads/videogiochi_immagini', $logo);
        $richiesta->titolo = $titolo;
        $richiesta->descrizione = $descrizione;
        $richiesta->prezzo = $prezzo;
        $richiesta->tipo = VideogiochiRichieste::TYPE_PUBLISH;
        $richiesta->eseguibile = \Storage::putFile('richieste/eseguibili', $eseguibile);
        $richiesta->save();

        foreach ($immagini as $immagine) {
            $richiestaImmagini = new VideogiochiRichiesteImmagini();
            $richiestaImmagini->richiesta_id = $richiesta->id;
            $richiestaImmagini->immagine = \Storage::putFile('richieste/immagini', $immagine);
            $richiestaImmagini->save();
        }
    }
}
