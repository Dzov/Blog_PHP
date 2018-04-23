<?php

namespace Blog\Controller;

use Blog\Controller\Exceptions\ResourceNotFoundException;
use Blog\Model\AuthManager;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AuthController extends Controller
{
    public static function showAction(): void
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
        } catch (ResourceNotFoundException $rnfe) {
            self::renderTemplate('login.twig', ['error' => 'Ces identifiants sont erronés']);
        }
    }

    public static function logoutAction(): void
    {
        unset($_SESSION['userId']);

        self::redirect('index.php');
    }
}
