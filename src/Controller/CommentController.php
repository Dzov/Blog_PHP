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

            if (strlen($author) < 2 || strlen($author) >= 20) {
                $_SESSION['errors'][] = 'Votre identifiant doit faire entre 2 et 20 caractères';
            }
            if (strlen($content) < 5) {
                $_SESSION['errors'][] = 'Votre commentaire doit contenir au moins 5 caractères';
            }

            if (!isset($_SESSION['errors'])) {
                CommentManager::insert($postId, $author, $content);
            }
        }

        self::redirect('/posts/' . $postId);
    }
}

