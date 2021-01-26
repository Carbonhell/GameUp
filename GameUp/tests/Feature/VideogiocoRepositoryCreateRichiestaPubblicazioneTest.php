<?php

namespace Tests\Feature;

use App\Models\VideogiochiRichieste;
use App\Models\VideogiochiRichiesteImmagini;
use App\Repositories\VideogiocoRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class VideogiocoRepositoryCreateRichiestaPubblicazioneTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @param int $idAutore
     * @param UploadedFile $logo
     * @param string $titolo
     * @param array $immagini
     * @param string $descrizione
     * @param float $prezzo
     * @param UploadedFile $eseguibile
     * @return void
     * @dataProvider richiesta_dataset_corretta
     */
    public function test_crea_richiesta_pubblicazione(
        int $idAutore,
        UploadedFile $logo,
        string $titolo,
        array $immagini,
        string $descrizione,
        float $prezzo,
        UploadedFile $eseguibile
    ): void {
        $videogiocoRepository = app(VideogiocoRepository::class);
        $videogiocoRepository->createRichiestaPubblicazione(
            $idAutore,
            $logo,
            $titolo,
            $immagini,
            $descrizione,
            $prezzo,
            $eseguibile
        );
        $lastRichiesta = VideogiochiRichieste::latest()->first();
        self::assertEquals($lastRichiesta->autore_id, $idAutore);
        self::assertEquals($lastRichiesta->titolo, $titolo);
        self::assertEquals($lastRichiesta->descrizione, $descrizione);
        self::assertEquals($lastRichiesta->prezzo, $prezzo);
    }
    /**
    * @param int $idAutore
    * @param UploadedFile $logo
    * @param string $titolo
    * @param array $immagini
    * @param string $descrizione
    * @param float $prezzo
    * @param UploadedFile $eseguibile
    * @return void
    * @dataProvider richiesta_dataset_exception
    */
    public function test_crea_richiesta_pubblicazione_exception(
        int $idAutore,
        UploadedFile $logo,
        string $titolo,
        array $immagini,
        string $descrizione,
        float $prezzo,
        UploadedFile $eseguibile
    ): void {
        $this->expectException(QueryException::class);
        $videogiocoRepository = app(VideogiocoRepository::class);
        $videogiocoRepository->createRichiestaPubblicazione(
            $idAutore,
            $logo,
            $titolo,
            $immagini,
            $descrizione,
            $prezzo,
            $eseguibile
        );
    }

    public function tearDown(): void
    {
        VideogiochiRichiesteImmagini::latest('id')
            ->limit(3)
            ->delete();
        VideogiochiRichieste::latest()
            ->first()
            ->delete();
        parent::tearDown();
    }

    public function richiesta_dataset_exception(): array
    {
        return [
            'id autore non corretto' => [
                0,
                UploadedFile::fake()->image('test.png'),
                'brawl stars',
                [
                    UploadedFile::fake()->image('immagine1.png'),
                    UploadedFile::fake()->image('immagine2.png'),
                    UploadedFile::fake()->image('immagine3.png')
                ],
                'lorem ipsum descrizione molto lunga lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum',
                2.34,
                UploadedFile::fake()->create('eseguibile.exe')
            ]
        ];
    }

    public function richiesta_dataset_corretta(): array
    {
        return [
            'id autore corretto' => [
                1,
                UploadedFile::fake()->image('test.png'),
                'brawl stars',
                [
                    UploadedFile::fake()->image('immagine1.png'),
                    UploadedFile::fake()->image('immagine2.png'),
                    UploadedFile::fake()->image('immagine3.png')
                ],
                'lorem ipsum descrizione molto lunga lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum',
                2.34,
                UploadedFile::fake()->create('eseguibile.exe')
            ]
        ];
    }
}
