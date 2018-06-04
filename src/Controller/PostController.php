<?php

namespace Blog\Controller;

use Blog\Exception\ResourceNotFoundException;
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

    /**
     * @throws ResourceNotFoundException
     */
    public static function showPostAction(array $parameters): void
    {
        $id = $parameters['id'];
        $post = PostManager::findById($id);
        $comments = PostManager::findCommentsByPost($id);

        if (isset($_SESSION['comment_errors'])) {
            $vm['errors'] = $_SESSION['comment_errors'];
            unset($_SESSION['comment_errors']);
            self::renderTemplate('post.twig', ['post' => $post, 'comments' => $comments, 'vm' => $vm]);

            return;
        }

        self::renderTemplate('post.twig', ['post' => $post, 'comments' => $comments]);
    }
}

