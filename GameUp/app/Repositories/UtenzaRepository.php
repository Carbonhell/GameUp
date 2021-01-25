<?php


namespace App\Repositories;


use App\Data\Utenza;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\UploadedFile;

class UtenzaRepository
{
    /**
     * @return Utenza[]
     */
    public function allUsers(): array
    {
        return User::all()
            ->map(
                function (User $user) {
                    return Utenza::from($user);
                }
            )->toArray();
    }

    /**
     * @param int $idUtente
     * @return Utenza|null
     */
    public function getUtente(int $idUtente): ?Utenza
    {
        $model = User::find($idUtente);
        if ($model) {
            return Utenza::from($model);
        }
        return null;
    }

    /**
     * @param string $username
     * @return Utenza|null
     */
    public function findUsername(string $username): ?Utenza
    {
        $model = User::where('username', '=', $username)->first();
        if ($model) {
            return Utenza::from($model);
        }
        return null;
    }

    /**
     * @param string $email
     * @return Utenza|null
     */
    public function findEmail(string $email): ?Utenza
    {
        $model = User::where('email', '=', $email)->first();
        if ($model) {
            return Utenza::from($model);
        }
        return null;
    }

    /**
     * @param string $username
     * @param string $password
     * @param string $email
     * @param UploadedFile $avatar
     * @return Authenticatable
     */
    public function createUtente(
        string $username,
        string $password,
        string $email,
        UploadedFile $avatar = null
    ): Authenticatable {
        $model = new User();
        $model->fill(
            [
                'username' => $username,
                'password' => \Hash::make($password),
                'email' => $email,
            ]
        );

        if ($avatar) {
            $filePath = \Storage::putFile('public/uploads/avatars', $avatar);
            $model->avatar = $filePath;
        }

        $model->save();
        return $model;
    }

    public function modificaDatiProfilo(
        int $idUtente,
        string $username = null,
        string $nuovaPassword = null,
        string $email = null,
        bool $isSviluppatore = null,
        UploadedFile $avatar = null
    ): bool {
        $user = User::find($idUtente);
        if (!$user || (!$username && !$nuovaPassword && !$email && $isSviluppatore === null && !$avatar)) {
            return false;
        }
        if ($username) {
            $user->username = $username;
        }
        if ($nuovaPassword) {
            $user->password = \Hash::make($nuovaPassword);
        }
        if ($email) {
            $user->email = $email;
        }
        if ($isSviluppatore !== null) {
            $user->ruolo = $isSviluppatore ? Utenza::ROLE_DEVELOPER : Utenza::ROLE_CLIENT;
        }
        if ($avatar) {
            $filePath = \Storage::putFile('public/uploads/avatars', $avatar);
            $user->avatar = $filePath;
        }
        $user->update();
        return true;
    }

    /**
     * @param int $utenteId
     * @param string $password
     * @return bool
     */
    public function checkPassword(int $idUtente, string $password): bool
    {
        $user = User::find($idUtente);
        if (!$user) {
            return false;
        }
        return \Hash::check($password, $user->password);
    }
}
