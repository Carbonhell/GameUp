<?php


namespace App\Repositories;


use App\Data\Videogioco;
use App\Models\User;
use App\Models\Videogiochi;
use Illuminate\Database\Eloquent\Collection;

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
            ->map(function(Videogiochi $videogioco) {
                return Videogioco::from($videogioco);
            })->toArray();
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
        if($titolo) {
            $query->where('titolo', 'LIKE', '%'.$titolo.'%');
        }
        if($prezzo) {
            $query->where('prezzo', '<=', $prezzo);
        }
        if($acquistati && $idUtente) {
            $query->whereHas('compratori', function($query) use ($idUtente) {
                $query->where('users.id', '=', $idUtente);
            });
        }
        if($ordine === 'DESC') {
            $query->orderByDesc('data_pubblicazione');
        } else {
            $query->orderBy('data_pubblicazione');
        }
        $results = $query->get();
        if($tagsObbligatorie) {
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
        if($tagsOpzionali) {
            $tagsOpzionaliCollection = collect($tagsOpzionali);
            $results = $results->filter(function(Videogiochi $videogioco) use ($tagsOpzionaliCollection) {
                /** @var Collection $tags */
                $tags = $videogioco->tags
                    ->pluck('titolo');
                return $tagsOpzionaliCollection->intersect($tags)->count() > 0;
            });
        }
        return $results->map(function(Videogiochi $videogioco) {
            return Videogioco::from($videogioco)
                ->withTags($videogioco->tags->pluck('titolo')->toArray());
        });
    }
}
