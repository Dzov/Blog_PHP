<?php

namespace Blog\Controller;

use Blog\Model\AuthManager;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AuthController extends Controller
{
    public static function showLoginAction()
    {
        self::renderTemplate('login.twig', []);
    }

    public static function loginAction($username, $password)
    {
        $user = AuthManager::getUserInformation($username, $password);

        if ($user && sha1($password) === $user['password']) {
            $_SESSION['user'] = $user;

            header("Location: index.php");

        } else {
            echo 'Wrong information';
        }
    }

    public static function logoutAction()
    {
        session_unset();

        session_destroy();

        header('Location: index.php');
    }
}
