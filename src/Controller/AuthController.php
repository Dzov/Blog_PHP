<?php

namespace Blog\Controller;

use Blog\Controller\Exceptions\ResourceNotFoundException;
use Blog\Model\AuthManager;
use Blog\Model\UserManager;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AuthController extends Controller
{
    public static function loginAction(): void
    {
        if (isset($_POST['submit']) &&
            isset($_POST['username']) &&
            isset($_POST['password'])
        ) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $encryptedPassword = sha1($password);

            try {
                $user = AuthManager::getUserIdentification($username, $encryptedPassword);

                $_SESSION['userId'] = $user->getUser_id();

                self::redirect('index.php');
            } catch (ResourceNotFoundException $rnfe) {
                self::renderTemplate('login.twig', ['error' => 'Ces identifiants sont erronés']);
            }
        }

        self::renderTemplate('login.twig', []);
    }

    public static function logoutAction(): void
    {
        unset($_SESSION['userId']);

        self::redirect('index.php');
    }

    public static function registerAction(): void
    {
        if (isset($_POST['submit']) &&
            isset($_POST['first_name']) &&
            isset($_POST['last_name']) &&
            isset($_POST['email']) &&
            isset($_POST['password']) &&
            isset($_POST['username'])
        ) {
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = sha1($_POST['password']);

            UserManager::create($firstName, $lastName, $username, $email, $password);

            self::redirect('login/show');
        }

        self::renderTemplate('registration.twig', []);
    }
}
