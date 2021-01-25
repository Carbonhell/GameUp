<?php


namespace App\Services;


use App\Data\Utenza;
use App\Repositories\UtenzaRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UtenzaService
{
    private $utenzaRepository;

    public function __construct(UtenzaRepository $utenzaRepository)
    {
        $this->utenzaRepository = $utenzaRepository;
    }

    public function isAdmin()
    {
        if (!$this->isAuthenticated()) {
            return false;
        }
        return Auth::user()->ruolo === Utenza::ROLE_ADMIN;
    }

    public function isAuthenticated()
    {
        return Auth::check();
    }

    public function isSviluppatore()
    {
        if (!$this->isAuthenticated()) {
            return false;
        }
        return Auth::user()->ruolo === Utenza::ROLE_DEVELOPER;
    }

    public function login(string $username, string $password): bool
    {
        return Auth::attempt(['username' => $username, 'password' => $password]);
    }

    public function logout(): void
    {
        Auth::logout();
    }

    /**
     * @param string $username
     * @param string $password
     * @param string $email
     * @param File $avatar
     * @return bool
     */
    public function registraUtente(string $username, string $password, string $email, UploadedFile $avatar = null): bool
    {
        if ($this->usernameExists($username) || $this->emailExists($email)) {
            return false;
        }
        $auth = $this->utenzaRepository->createUtente($username, $password, $email, $avatar);
        Auth::login($auth);
        return true;
    }

    /**
     * @param string $username
     * @return bool
     */
    public
    function usernameExists(
        string $username
    ): bool {
        return $this->utenzaRepository->findUsername($username) !== null;
    }

    /**
     * @param string $email
     * @return bool
     */
    public
    function emailExists(
        string $email
    ): bool {
        return $this->utenzaRepository->findEmail($email) !== null;
    }

    /**
     * @param string $passwordAttuale
     * @param string|null $username
     * @param string|null $nuovaPassword
     * @param string|null $email
     * @param UploadedFile|null $avatar
     * @param bool|null $isSviluppatore
     * @return bool
     */
    public function modificaDatiProfilo(
        string $passwordAttuale,
        string $username = null,
        string $nuovaPassword = null,
        string $email = null,
        UploadedFile $avatar = null,
        bool $isSviluppatore = null
    ): bool {
        if (!$this->utenzaRepository->checkPassword(Auth::id(), $passwordAttuale)) {
            return false;
        }
        $this->utenzaRepository->modificaDatiProfilo(
            Auth::id(),
            $username,
            $nuovaPassword,
            $email,
            $isSviluppatore,
            $avatar
        );
        return true;
    }

    /**
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public
    function getAvatar(): ?string
    {
        $avatarPath = Auth::user()->avatar;
        return $avatarPath ? \Storage::get($avatarPath) : null;
    }

    /**
     * @return Utenza|null
     */
    public
    function getUtenteAutenticato(): ?Utenza
    {
        if (!$this->isAuthenticated()) {
            return null;
        }
        return Utenza::from(Auth::user());
    }
}
