<?php

namespace Blog\Controller;

use Blog\Controller\Exceptions\ResourceNotFoundException;
use Blog\Model\UserManager;
use Exception;
use Twig_Environment;
use Twig_Function;
use Twig_Loader_Filesystem;

/**
 * @author Amélie-Dzovinar Haladjian
 */
abstract class Controller
{
    protected static function renderTemplate(string $path, array $parameters = []): void
    {
        $loader = new Twig_Loader_Filesystem('../src/View');
        $twig = new Twig_Environment($loader);

        self::addGlobalVariables($twig);

        $asset = new Twig_Function(
            'asset',
            function ($url) {
                return str_replace('//', '/', $_SERVER['BASE'] . '/' . $url);
            }
        );

        $twig->addFunction($asset);

        try {
            $twig->load($path);

            echo $twig->render($path, $parameters);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    protected static function setToken(): void
    {
        $token = bin2hex(random_bytes(64));

        if (!isset ($_SESSION['security'])) {
            $_SESSION['security']['token'] = $token;
            $_SESSION['security']['createdAt'] = new \DateTime();
            $_SESSION['security']['attempts'] = 0;
        }
    }

    protected static function tokenIsValid(string $token): bool
    {
        $createdAt = $_SESSION['security']['createdAt'];
        $expiresAt = $createdAt->add(new \DateInterval('PT10M'));

        if (isset($_SESSION['security']) &&
            (new \DateTime() < $expiresAt) &&
            $_SESSION['security']['token'] === $token
        ) {
            return true;
        }

        $_SESSION['security']['attempts'] += 1;

        if ($_SESSION['security']['attempts'] >= 3) {
            unset($_SESSION['security']);
        }

        return false;
    }

    protected static function redirect($url): void
    {
        $url = str_replace('//', '/', $_SERVER['BASE'] . '/' . $url);

        header("Location: $url");

        //return;
    }

    protected static function addGlobalVariables(Twig_Environment $twig): void
    {
        try {
            if (isset($_SESSION['userId'])) {
                $userId = $_SESSION['userId'];
                $user = UserManager::findById($userId);
                $twig->addGlobal('currentUser', $user);
            }
        } catch (ResourceNotFoundException $rnfe) {
            echo 'Cet utilisateur n\'existe pas';
        }

        if (isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
            $twig->addGlobal('errors', $errors);
        }

        if (isset($_SESSION['success'])) {
            $success = $_SESSION['success'];
            unset($_SESSION['success']);
            $twig->addGlobal('success', $success);
        }

        if (isset($_SESSION['security']['token'])) {
            $token = $_SESSION['security']['token'];
            $twig->addGlobal('token', $token);
        }
    }
}
