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

    public function isAuthenticated()
    {
        return Auth::check();
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
    public function registraUtente(string $username, string $password, string $email, UploadedFile $avatar): bool
    {
        if ($this->usernameExists($username) || $this->emailExists($email)) {
            return false;
        }
        $auth = $this->utenzaRepository->createUtente($username, $password, $email, $avatar);
        Auth::login($auth);
        return true;
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

    public
    function getAvatar()
    {
        $avatarPath = Auth::user()->avatar;
        return \Storage::get($avatarPath);
    }

    /**
     * @return Utenza
     */
    public
    function getUtenteAutenticato(): Utenza
    {
        return Utenza::from(Auth::user());
    }
}
