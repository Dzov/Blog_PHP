<?php

namespace Blog\Controller;

use Exception;
use PostManager;
use Twig_Environment;
use Twig_Loader_Filesystem;

require 'Model/PostManager.php';
require 'vendor/twig/twig/lib/Twig/Loader/Filesystem.php';

/**
 * @author Amélie-Dzovinar Haladjian
 */
class ListPostsController
{
    private $em;

    public function listPostsAction()
    {
        $posts = $this->getPosts();

        $this->renderTemplate('index.php', [$posts]);
    }

    public function __construct()
    {
        $this->em = new PostManager();
    }

    private function getPosts()
    {
        return $this->em->findAllPosts();
    }

    private function renderTemplate(string $path, array $parameters)
    {
        $loader = new Twig_Loader_Filesystem('Views/templates');
        $twig = new Twig_Environment(
            $loader, array(
                'cache' => 'Blog/vendor/twig/twig/src/Util',
            )
        );

        try {
            $twig->load($path);

            echo $twig->render($path, $parameters);

        } catch (Exception $e) {
            var_dump($e->getMessage());
        }

    }
}
