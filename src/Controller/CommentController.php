<?php

namespace Blog\Controller;

use Blog\Controller\Exceptions\ResourceNotFoundException;
use Blog\Model\CommentManager;
use Blog\Model\PostManager;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class CommentController extends Controller
{
    /**
     * @throws ResourceNotFoundException
     */
    public static function saveAction(array $parameters = []): void
    {
        $postId = $parameters['postId'];

        PostManager::findById($postId);

        if (isset($_POST['author']) && isset($_POST['author'])) {
            $author = $_POST['author'];
            $content = $_POST['content'];

            CommentManager::insert($postId, $author, $content);

            self::redirect('/posts/' . $postId);
        }
    }
}

