<?php


namespace App\Services;


use App\Data\Videogioco;
use App\Repositories\VideogiocoRepository;
use Illuminate\Http\UploadedFile;

class VideogiocoService
{
    private $videogiocoRepository;
    private $utenzaService;

    public function __construct(VideogiocoRepository $videogiocoRepository, UtenzaService $utenzaService)
    {
        $this->videogiocoRepository = $videogiocoRepository;
        $this->utenzaService = $utenzaService;
    }

    public function ottieniDatiVideogioco(int $idVideogioco): ?Videogioco
    {
        return $this->videogiocoRepository->getVideogioco($idVideogioco);
    }

    /**
     * @return Videogioco[]
     */
    public function ottieniUltimiVideogiochiPubblicati(): array
    {
        return $this->videogiocoRepository->ottieniUltimiVideogiochiPubblicati();
    }

    /**
     * @param string|null $titolo
     * @param float|null $prezzo
     * @param array|null $tagsObbligatorie
     * @param array|null $tagsOpzionali
     * @param bool $acquistati
     * @param string $ordine
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
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

    public function richiediPubblicazioneVideogioco(
        UploadedFile $logo,
        string $titolo,
        array $immagini,
        string $descrizione,
        float $prezzo,
        UploadedFile $eseguibile
    ): void {
        if (!$this->utenzaService->isSviluppatore()) {
            return;
        }
        $autoreId = $this->utenzaService->getUtenteAutenticato()->id;
        $this->videogiocoRepository->createRichiestaPubblicazione(
            $autoreId,
            $logo,
            $titolo,
            $immagini,
            $descrizione,
            $prezzo,
            $eseguibile
        );
    }

}
