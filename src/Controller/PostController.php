<?php

namespace Blog\Controller;

use Blog\Model\PostManager;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class PostController extends Controller
{
    public function listAction()
    {
        $posts = PostManager::findAllPosts();

        $this->renderTemplate('home.twig', ['posts' => $posts]);
    }
}

