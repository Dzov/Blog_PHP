<?php

namespace Blog\Controller;

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

        if (isset($_SESSION['user'])) {
            $twig->addGlobal('user', $_SESSION['user']);
        }

        $asset = new Twig_Function(
            'asset',
            function ($url) {
                return $_SERVER['BASE'] . '/' . $url;
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
}
