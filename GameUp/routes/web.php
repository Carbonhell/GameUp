<?php

use App\Http\Controllers\UtenteControl;
use App\Http\Controllers\VideogiocoControl;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [VideogiocoControl::class, 'paginaIniziale'])->name('home');

Route::prefix('utenza')->group(function() {
    Route::post('login', [UtenteControl::class, 'login'])->name('login');
    Route::get('registrazione', [UtenteControl::class, 'registrazione'])->name('registrazione');
    Route::post('registrazione', [UtenteControl::class, 'effettuaRegistrazione'])->name('effettuaRegistrazione');
    Route::get('recuperoPassword', [UtenteControl::class, 'tentaRecuperoPassword'])->name('recuperoPassword');
    Route::middleware('auth')->group(function() {
        Route::get('avatar', [UtenteControl::class, 'getAvatar'])->name('avatar');
        Route::get('logout', [UtenteControl::class, 'logout'])->name('logout');
        Route::get('visualizzaProfilo', [UtenteControl::class, 'visualizzaProfilo'])->name('visualizzaProfilo');
        Route::get('modificaProfilo', [UtenteControl::class, 'modificaProfilo'])->name('modificaProfilo');
        Route::post('modificaProfilo', [UtenteControl::class, 'modificaDatiProfilo'])->name('modificaDatiProfilo');
    });
});

Route::prefix('videogiochi')->group(function() {
    Route::get('logo/{idVideogioco}', [VideogiocoControl::class, 'getLogo'])->name('getLogo');
    Route::get('catalogo', [VideogiocoControl::class, 'catalogo'])->name('catalogo');
    Route::get('dettagli', [VideogiocoControl::class, 'ottieniDatiVideogioco'])->name('dettagliVideogioco');
    Route::get('iniziaRichiestaPubblicazione', [VideogiocoControl::class, 'avviaPubblicazioneVideogioco'])->name('avviaPubblicazioneVideogioco');
    Route::post('richiediPubblicazioneVideogioco', [VideogiocoControl::class, 'richiediPubblicazioneVideogioco'])->name('richiediPubblicazioneVideogioco');
});

