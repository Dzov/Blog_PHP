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
    public static function saveAction(array $parameters = []): void
    {
        try {
            $postId = $parameters['postId'];

            PostManager::findById($postId);

            if (isset($_POST['author']) && isset($_POST['author'])) {
                $author = $_POST['author'];
                $content = $_POST['content'];

                CommentManager::insert($postId, $author, $content);

                self::redirect('/posts/' . $postId);
            }
        } catch (ResourceNotFoundException $rnfe) {
            echo 'Cet article n\'existe pas';
        }
    }
}

