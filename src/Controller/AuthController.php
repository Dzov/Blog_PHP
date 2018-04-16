<?php

namespace Blog\Controller;

use Blog\Controller\Exceptions\UserNotFoundException;
use Blog\Model\AuthManager;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AuthController extends Controller
{
    public static function showLoginAction(): void
    {
        self::renderTemplate('login.twig', []);
    }

    public static function loginAction(): void
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $encryptedPassword = sha1($password);

        try {
            $user = AuthManager::getUserIdentification($username, $encryptedPassword);

            $_SESSION['userId'] = $user->getUser_id();

            self::redirect('index.php');
        } catch (UserNotFoundException $unfe) {
            self::renderTemplate('login.twig', ['error' => 'Ces identifiants sont erronés']);
        }
    }

    public static function logoutAction(): void
    {
        unset($_SESSION['userId']);

        self::redirect('index.php');
    }
}
