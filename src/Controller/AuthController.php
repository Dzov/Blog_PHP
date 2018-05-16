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

        self::renderTemplate('login-form.twig');
    }

    public static function logoutAction(): void
    {
        unset($_SESSION['userId']);
        unset($_SESSION['errors']);
        unset($_SESSION['security']);

        self::redirect('index.php');
    }

    /**
     * @throws \Exception
     */
    public static function registerAction(): void
    {
        $submit = Request::post('submit');

        if (isset($submit)) {
            $vm = [];

            $firstName = Request::post('first_name');
            if (empty($firstName)) {
                $vm['errors']['firstName'] = 'Veuillez renseigner votre prénom';
            } else {
                $vm['firstName'] = $firstName;

                if (strlen($firstName) < 2 || strlen($firstName) >= 30) {
                    $vm['errors']['firstName'] = 'Votre prénom doit faire entre 2 et 30 caractères';
                }
            }

            $lastName = Request::post('last_name');
            if (empty($lastName)) {
                $vm['errors']['lastName'] = 'Veuillez renseigner votre nom de famille';
            } else {
                $vm['lastName'] = $lastName;

                if (strlen($lastName) < 2 || strlen($lastName) >= 40) {
                    $vm['errors']['lastName'] = 'Votre nom de famille doit faire entre 2 et 40 caractères';
                }
            }

            $username = Request::post('username');
            if (empty($username)) {
                $vm['errors']['username'] = 'Veuillez renseigner votre identifiant';
            } else {
                $vm['username'] = $username;

                if (strlen($username) < 2 || strlen($username) >= 20) {
                    $vm['errors']['username'] = 'Votre identifiant doit faire entre 2 et 20 caractères';
                }

                try {
                    if (UserManager::findByUsername($username)) {
                        $vm['errors']['username'] = 'Cet identifiant existe déjà';
                    }
                } catch (ResourceNotFoundException $rnfe) {
                }
            }

            $email = Request::post('email');
            if (empty($email)) {
                $vm['errors']['email'] = 'Veuillez renseigner votre email';
            } else {
                $vm['email'] = $email;

                if (strlen($email) < 6 || strlen($email) >= 50) {
                    $vm['errors']['email'] = 'Votre email doit faire entre 6 et 50 caractères';
                }

                try {
                    if (UserManager::findByEmail($email)) {
                        $vm['errors']['email'] = 'Cet email existe déjà';
                    }
                } catch (ResourceNotFoundException $rnfe) {
                }
            }

            $password = sha1(Request::post('password'));
            if (empty($password)) {
                $vm['errors']['password'] = 'Veuillez renseigner votre mot de passe';
            } elseif (strlen($password) < 6) {
                $vm['errors']['password'] = 'Votre mot de passe doit faire au moins 6 caractères';
            }

            if (!self::tokenIsValid(Request::post('token'))) {
                $vm['errors']['security'] = 'Une erreur d\'authentification est survenue, veuillez reesayer ultérieurement';
            }

            if (!isset($vm['errors'])) {
                var_dump(isset($vm['errors']));
                UserManager::create($firstName, $lastName, $username, $email, $password);
                self::redirect('login');

                return;
            } else {
                self::renderTemplate('registration-form.twig', ['vm' => $vm]);

                return;
            }
        }
        self::setToken();

        self::renderTemplate('registration-form.twig');
    }
}

