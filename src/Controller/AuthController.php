<?php

namespace Blog\Controller;

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

        $user = AuthManager::getUserInformation($username, $encryptedPassword);

        $_SESSION['user'] = $user;

        header("Location: index.php");
    }

    public static function logoutAction(): void
    {
        unset($_SESSION['user']);

        header('Location: index.php');
    }
}
