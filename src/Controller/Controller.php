<?php

namespace Blog\Controller;

use Exception;
use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * @author Amélie-Dzovinar Haladjian
 */
abstract class Controller
{
    protected static function renderTemplate(string $path, array $parameters = [])
    {
        $loader = new Twig_Loader_Filesystem('../src/View');
        $twig = new Twig_Environment($loader);

        try {
            $twig->load($path);

            echo $twig->render($path, $parameters);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
