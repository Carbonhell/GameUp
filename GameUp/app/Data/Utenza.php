<?php


namespace App\Data;


use App\Models\User;

class Utenza
{
    public $id;
    public $username;
    public $email;
    public $avatar;
    public $ruolo;
    public $dataCreazione;
    public $dataAggiornamento;


    public const ROLE_CLIENT = 1;
    public const ROLE_DEVELOPER = 2;
    public const ROLE_ADMIN = 3;

    /**
     * @param User $model
     * @return Utenza
     */
    public static function from(User $model): Utenza
    {
        $utenza = new Utenza();
        $utenza->id = $model->id;
        $utenza->username = $model->username;
        $utenza->email = $model->email;
        $utenza->avatar = $model->avatar;
        $utenza->ruolo = $model->ruolo;
        $utenza->dataCreazione = $model->created_at;
        $utenza->dataAggiornamento = $model->updated_at;
        return $utenza;
    }
}
