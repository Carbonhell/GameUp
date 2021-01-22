<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UtenteControl extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function login(Request $request): Response
    {
        return response();
    }

    public function logout(): Response
    {
        return response();
    }

    public function registrazione(Request $request): Response
    {
        return response();
    }

    public function tentaRecuperoPassword(Request $request): Response
    {
        return response();
    }

    public function resetPassword(Request $request): Response
    {
        return response();
    }

    public function visualizzaProfilo(): Response
    {
        return response();
    }

    public function modificaProfilo(): Response
    {
        return response();
    }

    public function modificaDatiProfilo(Request $request): Response
    {
        return response();
    }
}
