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

        try {
            if (isset($_SESSION['userId'])) {
                $userId = $_SESSION['userId'];
                $user = UserManager::findById($userId);
                $twig->addGlobal('currentUser', $user);
            }
        } catch (ResourceNotFoundException $rnfe) {
            echo 'Cet utilisateur n\'existe pas';
        }

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

    protected static function redirect($url)
    {
        $url = str_replace('//', '/', $_SERVER['BASE'] . '/' . $url);

        header("Location: $url");
    }
}
