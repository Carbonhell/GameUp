<?php

namespace Tests\Feature;

use App\Services\UtenzaService;
use Tests\TestCase;

class UtenzaRepositoryLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @param string $username
     * @param string $password
     * @return void
     * @dataProvider loginParameters
     */
    public function test_login(string $username, string $password, bool $result): void
    {
        $utenzaRepository = app(UtenzaService::class);
        self::assertEquals($utenzaRepository->login($username, $password), $result);
    }

    public function loginParameters()
    {
        return [
            'username non esistente' => [
                'nonEsistente', 'nonEsistente', false
            ],
            'password non corretta' => [
                'admin', 'errore', false
            ],
            'credenziali corrette' => [
                'admin', 'root', true
            ]
        ];
    }
}
