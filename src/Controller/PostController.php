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

    public static function showPostAction(array $parameters)
    {
        $id = $parameters['id'];

        $post = PostManager::findPost($id);

        $comments = PostManager::findCommentsByPost($id);

        self::renderTemplate('post.twig', ['post' => $post, 'comments' => $comments]);
    }
}

