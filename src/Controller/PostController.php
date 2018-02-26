<?php

namespace Blog\Controller;

use Blog\Model\PostManager;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class PostController extends Controller
{
    public function listPostsAction()
    {
        $posts = PostManager::findAllPosts();

        $this->renderTemplate('home.twig', ['posts' => $posts]);
    }

    public function showPostAction($id)
    {
        $post = PostManager::findPost($id);

        $this->renderTemplate('post.twig', ['post' => $post]);
    }
}

