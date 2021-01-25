<?php

namespace App\Http\Controllers;

use App\Services\UtenzaService;
use App\Services\VideogiocoService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VideogiocoControl extends Controller
{
    private $videogiocoService;
    private $utenzaService;

    public function __construct(VideogiocoService $videogiocoService, UtenzaService $utenzaService)
    {
        $this->videogiocoService = $videogiocoService;
        $this->utenzaService = $utenzaService;
    }

    /**
     * @return View
     */
    public function paginaIniziale(): View
    {
        return view(
            'paginainiziale',
            [
                'ultimiVideogiochiPubblicati' => $this->videogiocoService->ottieniUltimiVideogiochiPubblicati()
            ]
        );
    }

    /**
     * @param Request $request
     * @return View
     */
    public function catalogo(Request $request)
    {
        if (empty($request->all())) {
            $videogiochi = $this->videogiocoService->ottieniUltimiVideogiochiPubblicati();
        } else {
            $tagsObbligatorie = $request->input('tagsObbligatorie');
            if ($tagsObbligatorie) {
                // In case the user decides to use spaces after commas
                $tagsObbligatorie = str_replace(' ', '', $tagsObbligatorie);
                $tagsObbligatorie = explode(',', $tagsObbligatorie);
            }
            $tagsOpzionali = $request->input('tagsOpzionali');
            if ($tagsOpzionali) {
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
        return view(
            'catalogo',
            [
                'videogiochi' => $videogiochi
            ]
        );
    }

    public function ottieniDatiVideogioco(Request $request): View
    {
        $idVideogioco = $request->input('idVideogioco', 1);
        $videogioco = $this->videogiocoService->ottieniDatiVideogioco($idVideogioco);
        return view(
            'dettagliVideogioco',
            [
                'videogioco' => $videogioco
            ]
        );
    }

    public function avviaPubblicazioneVideogioco()
    {
        if (!$this->utenzaService->isSviluppatore()) {
            return redirect()->route('home');
        }
        return view('richiestaPubblicazioneVideogioco');
    }

    public function richiediPubblicazioneVideogioco(Request $request): RedirectResponse
    {
        if (!$this->utenzaService->isSviluppatore()) {
            return redirect()->route('home');
        }
        $request->validate(
            [
                'titolo' => 'required',
                'descrizione' => 'required',
                'prezzo' => 'required',
                'logo' => 'required',
                'immagine' => 'required|size:3',
                'eseguibile' => 'required',
            ]
        );
        $this->videogiocoService->richiediPubblicazioneVideogioco(
            $request->file('logo'),
            $request->input('titolo'),
            $request->file('immagine'),
            $request->input('descrizione'),
            $request->input('prezzo'),
            $request->file('eseguibile')
        );
        return redirect()->route('home', ['richiestaPubblicazione' => true]);
    }

}
