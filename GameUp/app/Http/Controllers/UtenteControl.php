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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|RedirectResponse|Response
     */
    public function login(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ]
        );
        if ($this->utenzaService->isAuthorized()) {
            return back();
        }
        if ($this->utenzaService->login($request->input('username'), $request->input('password'))) {
            $request->session()->regenerate();
            return back();
        }
        return back()->withErrors(['message' => 'Dati non corretti!']);
    }

    public function logout(): RedirectResponse
    {
        $this->utenzaService->logout();
        return response()->redirectToRoute('home');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function registrazione(Request $request): View
    {
        return view('registrazione');
    }

    public function effettuaRegistrazione(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed',
                'avatar' => 'required|max:5000'
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

    // TODO
    public function tentaRecuperoPassword(Request $request): Response
    {
        return response();
    }

    // TODO
    public function resetPassword(Request $request): Response
    {
        return response();
    }

    public function visualizzaProfilo(): View
    {
        $user = $this->utenzaService->getAuthenticatedUser();
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
        $user = $this->utenzaService->getAuthenticatedUser();
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
