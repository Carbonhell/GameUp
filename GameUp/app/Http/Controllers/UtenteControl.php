<?php

namespace App\Http\Controllers;

use App\Data\Utenza;
use App\Services\UtenzaService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UtenteControl extends Controller
{
    private $utenzaService;

    public function __construct(UtenzaService $utenzaService)
    {
        $this->utenzaService = $utenzaService;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ]
        );
        if ($this->utenzaService->isAuthenticated()) {
            return back();
        }
        if ($this->utenzaService->login($request->input('username'), $request->input('password'))) {
            $request->session()->regenerate();
            return back();
        }
        return back()->withErrors(['message' => 'Dati non corretti!']);
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        $this->utenzaService->logout();
        return response()->redirectToRoute('home');
    }

    /**
     * @return View
     */
    public function registrazione(): View
    {
        return view('registrazione');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function effettuaRegistrazione(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'username' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed',
                'avatar' => 'max:5000'
            ]
        );
        if (!$this->utenzaService->registraUtente(
            $request->input('username'),
            $request->input('password'),
            $request->input('email'),
            $request->file('avatar')
        )) {
            return back()->withErrors(['message' => 'Registrazione fallita, username o email non unici!']);
        }
        return response()->redirectToRoute('home');
    }

    public function visualizzaProfilo(): View
    {
        $user = $this->utenzaService->getUtenteAutenticato();
        return view(
            'visualizzaProfilo',
            [
                'username' => $user->username,
                'email' => $user->email,
                'isSviluppatore' => $user->ruolo === Utenza::ROLE_DEVELOPER
            ]
        );
    }

    public function modificaProfilo(): View
    {
        $user = $this->utenzaService->getUtenteAutenticato();
        return view(
            'modificaProfilo',
            [
                'username' => $user->username,
                'email' => $user->email,
                'isSviluppatore' => $user->ruolo === Utenza::ROLE_DEVELOPER
            ]
        );
    }

    public function modificaDatiProfilo(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'email' => 'email',
                'nuovaPassword' => 'confirmed|nullable',
                'isSviluppatore' => 'boolean|nullable',
                'passwordAttuale' => 'required'
            ]
        );
        if ($this->utenzaService->modificaDatiProfilo(
            $request->input('passwordAttuale'),
            $request->input('username'),
            $request->input('nuovaPassword'),
            $request->input('email'),
            $request->file('avatar'),
            $request->input('isSviluppatore')
        )) {
            return response()->redirectToRoute('visualizzaProfilo');
        }
        return back()->withErrors(['message' => 'Qualcosa è andato storto!']);
    }

    public function getAvatar(): Response
    {
        $avatarFile = $this->utenzaService->getAvatar();
        return response($avatarFile);
    }
}
