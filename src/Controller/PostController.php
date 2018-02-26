<?php

namespace Blog\Controller;

use Blog\Model\PostManager;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class PostController extends Controller
{
    public static function listPostsAction()
    {
        $posts = PostManager::findAllPosts();

        self::renderTemplate('posts.twig', ['posts' => $posts]);
    }

    public static function showPostAction($id)
    {
        $post = PostManager::findPost($id);

        self::renderTemplate('post.twig', ['post' => $post]);
    }
}

