<?php


namespace App\Services;


use App\Data\Videogioco;
use App\Repositories\VideogiocoRepository;

class VideogiocoService
{
    private $videogiocoRepository;

    public function __construct(VideogiocoRepository $videogiocoRepository)
    {
        $this->videogiocoRepository = $videogiocoRepository;
    }

    /**
     * @return Videogioco[]
     */
    public function ottieniUltimiVideogiochiPubblicati(): array
    {
        return $this->videogiocoRepository->ottieniUltimiVideogiochiPubblicati();
    }

    public function applicaCriteri(
        string $titolo = null,
        float $prezzo = null,
        array $tagsObbligatorie = null,
        array $tagsOpzionali = null,
        bool $acquistati = false,
        string $ordine = 'DESC'
    ) {
        $idUtente = \Auth::id();
        return $this->videogiocoRepository->applicaCriteri(
            $titolo,
            $prezzo,
            $tagsObbligatorie,
            $tagsOpzionali,
            $idUtente,
            $acquistati,
            $ordine
        );
    }

    public
    function getLogo(
        int $idVideogioco
    ) {
        $videogioco = $this->videogiocoRepository->getVideogioco($idVideogioco);
        if ($videogioco) {
            return \Storage::get($videogioco->logo);
        }
        return null;
    }

}
