<?php

namespace Blog\Controller;

use Blog\Model\PostManager;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class PostController extends Controller
{
    public static function listAction(): void
    {
        $posts = PostManager::findAll();

        self::renderTemplate('posts.twig', ['posts' => $posts]);
    }

    public static function showPostAction(array $parameters): void
    {
        $id = $parameters['id'];

        $post = PostManager::findById($id);

        $comments = PostManager::findCommentsByPost($id);

        self::renderTemplate('post.twig', ['post' => $post, 'comments' => $comments]);
    }
}

