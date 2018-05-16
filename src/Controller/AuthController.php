<?php

namespace Blog\Controller;

use Blog\Controller\Exceptions\ResourceNotFoundException;
use Blog\Model\AuthManager;
use Blog\Model\UserManager;
use Blog\Utils\Request;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AuthController extends Controller
{
    public static function loginAction(): void
    {
        $submit = Request::post('submit');
        $username = Request::post('username');
        $password = Request::post('password');

        if (isset($submit) &&
            isset($username) &&
            isset($password)
        ) {
            $encryptedPassword = sha1($password);

            try {
                $user = AuthManager::getUserIdentification($username, $encryptedPassword);

                $_SESSION['userId'] = $user->getUser_id();

                self::redirect('index.php');
            } catch (ResourceNotFoundException $rnfe) {
                $_SESSION['errors'][] = 'Ces identifiants sont erronés';
            }
        }

        self::renderTemplate('login.twig');
    }

    public static function logoutAction(): void
    {
        unset($_SESSION['userId']);
        unset($_SESSION['errors']);
        unset($_SESSION['security']);

        self::redirect('index.php');
    }

    /**
     * @throws ResourceNotFoundException
     */
    public static function registerAction(): void
    {
        $firstName = Request::post('first_name');
        $lastName = Request::post('last_name');
        $username = Request::post('username');
        $email = Request::post('email');
        $password = sha1(Request::post('password'));

        if (isset($submit) &&
            isset($first_name) &&
            isset($last_name) &&
            isset($email) &&
            isset($password) &&
            isset($username)
        ) {
            if (UserManager::findByUsername($username)) {
                $_SESSION['errors'][] = 'Cet identifiant existe déjà';
            }
            if (UserManager::findByEmail($email)) {
                $_SESSION['errors'][] = 'Cet email existe déjà';
            }
            if (strlen($firstName) < 2 || strlen($firstName) >= 30) {
                $_SESSION['errors'][] = 'Votre prénom doit faire entre 2 et 30 caractères';
            }
            if (strlen($lastName) < 2 || strlen($lastName) >= 40) {
                $_SESSION['errors'][] = 'Votre nom de famille doit faire entre 2 et 40 caractères';
            }
            if (strlen($username) < 2 || strlen($lastName) >= 20) {
                $_SESSION['errors'][] = 'Votre identifiant doit faire entre 2 et 20 caractères';
            }
            if (strlen($email) < 6 || strlen($lastName) >= 50) {
                $_SESSION['errors'][] = 'Votre email doit faire entre 6 et 50 caractères';
            }
            if (strlen($password) < 6) {
                $_SESSION['errors'][] = 'Votre mot de passe doit faire au moins 6 caractères';
            }

            if (!isset($_SESSION['errors'])) {
                UserManager::create($firstName, $lastName, $username, $email, $password);
                self::redirect('login/show');
            }
        }

        self::renderTemplate('registration.twig');
    }
}
