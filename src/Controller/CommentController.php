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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['author'])) {
                $_SESSION['comment_errors']['author'] = 'Veuillez renseigner votre identifiant';
            } else {
                $author = $_POST['author'];
                if (strlen($author) < 2 || strlen($author) >= 20) {
                    $_SESSION['comment_errors']['title'] = 'Votre identifiant doit faire entre 2 et 20 caractères';
                }
            }

            if (empty($_POST['content'])) {
                $_SESSION['comment_errors']['content'] = 'Veuillez renseigner le corps du commentaire';
            } else {
                $content = $_POST['content'];
                if (strlen($content) < 4) {
                    $_SESSION['comment_errors']['content'] = 'Votre commentaire doit contenir au moins 4 caractères';
                }
            }

            if (!isset($_SESSION['comment_errors'])) {
                CommentManager::insert($postId, $author, $content);
                $_SESSION['success'][] = 'Le commentaire a bien été enregistré, il sera publié après validation';
            }
        }

        self::redirect('/posts/' . $postId);
    }
}


