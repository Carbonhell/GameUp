<?php

namespace App\Admin\Controllers;

use App\Data\Videogioco;
use App\Http\Controllers\Controller;
use App\Models\VideogiochiRichieste;
use App\Repositories\VideogiocoRepository;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->description('Di seguito la lista delle richieste effettuate dagli sviluppatori')
            ->body($this->grid());
    }

    public function grid()
    {
        $grid = new Grid(new VideogiochiRichieste());
        $grid->column('autore.username', 'Autore');
        $grid->column('logo', 'Logo')->image();
        $grid->column('titolo', 'Titolo');
        $grid->column('tipo', 'Tipo')->display(
            function ($tipo) {
                return $tipo === VideogiochiRichieste::TYPE_PUBLISH ? 'Pubblicazione' : 'Modifica';
            }
        );

        return $grid;
    }

    public function edit(int $id, Content $content)
    {
        return $content
            ->title('Risoluzione richiesta')
            ->body($this->form($id)->edit($id));
    }

    public function form(int $id)
    {
        $form = new Form(new VideogiochiRichieste());
        $form->display('autore.username', 'Autore');
        $form->display('titolo', 'Titolo');
        $states = [
            'on' => ['value' => 1, 'text' => 'Approva', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'Rifiuta', 'color' => 'danger']
        ];
        $form->switch('esito', 'Esito')
            ->states($states)
            ->required();
        $form->textarea('commento', 'Commento')->required();

        return $form;
    }

    public function update(int $id, VideogiocoRepository $videogiocoRepository)
    {
        $richiesta = VideogiochiRichieste::findOrFail($id);
        $richiesta->esito = request('esito') === 'on';
        $richiesta->commento = request('commento');
        $richiesta->update();

        // Genera il videogioco
        if($richiesta->esito) {
            $videogioco = new Videogioco();
            $videogioco->autore = $richiesta->autore_id;
            $videogioco->logo = str_replace('public', 'storage', $richiesta->logo);
            $videogioco->titolo = $richiesta->titolo;
            $videogioco->descrizione = $richiesta->descrizione;
            $videogioco->prezzo = $richiesta->prezzo;
            $videogioco->dataPubblicazione = now();
            $videogioco->immagini = $richiesta->immagini->pluck('immagine')->toArray();
            $videogiocoRepository->creaVideogioco($videogioco);
        }

        admin_toastr('Richiesta risolta con successo!');
        return redirect()->route('admin.home');
    }
}
