<?php

namespace App\Http\Controllers;

use App\Services\VideogiocoService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VideogiocoControl extends Controller
{
    private $videogiocoService;

    public function __construct(VideogiocoService $videogiocoService) {
        $this->videogiocoService = $videogiocoService;
    }

    /**
     * @return View
     */
    public function paginaIniziale(): View
    {
        return view('paginainiziale', [
            'ultimiVideogiochiPubblicati' => $this->videogiocoService->ottieniUltimiVideogiochiPubblicati()
        ]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function catalogo(Request $request)
    {
        if(empty($request->all())) {
            $videogiochi = $this->videogiocoService->ottieniUltimiVideogiochiPubblicati();
        } else {
            $tagsObbligatorie = $request->input('tagsObbligatorie');
            if($tagsObbligatorie) {
                // In case the user decides to use spaces after commas
                $tagsObbligatorie = str_replace(' ', '', $tagsObbligatorie);
                $tagsObbligatorie = explode(',', $tagsObbligatorie);
            }
            $tagsOpzionali = $request->input('tagsOpzionali');
            if($tagsOpzionali) {
                // In case the user decides to use spaces after commas
                $tagsOpzionali = str_replace(' ', '', $tagsOpzionali);
                $tagsOpzionali = explode(',', $tagsOpzionali);
            }
            $videogiochi = $this->videogiocoService->applicaCriteri(
                $request->input('titolo'),
                $request->input('prezzo'),
                $tagsObbligatorie,
                $tagsOpzionali,
                $request->input('acquistati') ? true : false,
                $request->input('ordine') ? 'ASC' : 'DESC',
            );
        }
        return view('catalogo', [
            'videogiochi' => $videogiochi
        ]);
    }

    public function getLogo(int $idVideogioco): Response
    {
        $logoFile = $this->videogiocoService->getLogo($idVideogioco);
        return response($logoFile);
    }
}
