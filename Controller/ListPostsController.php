<?php

namespace Blog\Controller;

use Exception;
use PostManager;
use Twig_Environment;
use Twig_Loader_Filesystem;

require 'Model/PostManager.php';

/**
 * @author Amélie-Dzovinar Haladjian
 */
class ListPostsController
{
    public function listPostsAction()
    {
        $posts = $this->getPosts();

        $this->renderTemplate('home.twig', ['posts' => $posts]);
    }

    private function getPosts()
    {
        $em = new PostManager();

        return $em->findAllPosts();
    }

    private function renderTemplate(string $path, array $parameters)
    {
        $loader = new Twig_Loader_Filesystem('Views/templates');
        $twig = new Twig_Environment($loader);

        try {
            $twig->load($path);

            echo $twig->render($path, $parameters);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
