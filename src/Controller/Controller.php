<?php

namespace Blog\Controller;

use Blog\Exception\ResourceNotFoundException;
use Blog\Model\UserManager;
use Twig_Environment;
use Twig_Function;
use Twig_Loader_Filesystem;

/**
 * @author Amélie-Dzovinar Haladjian
 */
abstract class Controller
{
    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    protected static function renderTemplate(string $path, array $parameters = []): void
    {
        $loader = new Twig_Loader_Filesystem('../src/View');
        $twig = new Twig_Environment($loader);

        $asset = new Twig_Function(
            'asset',
            function ($url) {
                return str_replace('//', '/', $_SERVER['BASE'] . '/' . $url);
            }
        );

        $twig->addFunction($asset);

        self::addGlobalVariables($twig);

        $twig->load($path);

        echo $twig->render($path, $parameters);
    }

    protected static function redirect(string $url): void
    {
        $url = str_replace('//', '/', $_SERVER['BASE'] . '/' . $url);

        header("Location: $url");
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
