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
        $encryptedPassword = sha1($password);

        $user = AuthManager::getUserInformation($username, $encryptedPassword);

        $_SESSION['user'] = $user;

        header("Location: index.php");
    }

    public static function logoutAction()
    {
        unset($_SESSION['user']);

        header('Location: index.php');
    }
}
