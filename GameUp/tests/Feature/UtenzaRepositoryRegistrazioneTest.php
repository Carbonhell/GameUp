<?php

namespace Tests\Feature;

use App\Models\User;
use App\Repositories\UtenzaRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UtenzaRepositoryRegistrazioneTest extends TestCase
{
    private $idsToDelete = [];

    /**
     * A basic test example.
     *
     * @param string $username
     * @param string $password
     * @param string $email
     * @param UploadedFile|null $avatar
     * @return void
     * @dataProvider utenteProvider
     * @throws \Exception
     */
    public function test_create_utente(
        string $username,
        string $password,
        string $email,
        UploadedFile $avatar = null
    ): void {
        $utenzaRepository = app(UtenzaRepository::class);
        // Un inserimento di un utente che si vuole registrare
        $result = $utenzaRepository->createUtente($username, $password, $email, $avatar);
        $savedUser = User::find($result->id);
        // Mantieni gli id dei modelli generati per cancellarli alla fine del test
        $this->idsToDelete[] = $savedUser->id;
        self::assertNotNull($savedUser);
        self::assertEquals($savedUser->username, $username);
        self::assertTrue($utenzaRepository->checkPassword($savedUser->id, $password));
        self::assertEquals($savedUser->email, $email);
        if ($avatar) {
            self::assertNotNull($savedUser->avatar);
        }
        // Non deve essere possibile registrarsi con lo stesso username o la stessa email già presenti nel database
        $this->expectException(QueryException::class);
        $utenzaRepository->createUtente($username, $password, $email, $avatar);
    }

    public function tearDown(): void
    {
        User::destroy($this->idsToDelete);
        parent::tearDown();
    }

    public function utenteProvider(): array
    {
        return [
            'senza avatar' => [
                'test',
                'test',
                'test@test.dev'
            ],
            'con avatar' => [
                'test2',
                'test2',
                'test2@test.dev',
                UploadedFile::fake()->image('test.png')
            ]
        ];
    }
}
