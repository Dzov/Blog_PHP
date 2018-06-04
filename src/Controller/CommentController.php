<?php

namespace Blog\Controller;

use Blog\Exception\ResourceNotFoundException;
use Blog\Model\CommentManager;
use Blog\Model\PostManager;
use Blog\Utils\Request;

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
            $author = Request::post('author');

            if (empty($author)) {
                $_SESSION['comment_errors']['author'] = 'Veuillez renseigner votre identifiant';
            } else {
                if (strlen($author) < 2 || strlen($author) >= 20) {
                    $_SESSION['comment_errors']['title'] = 'Votre identifiant doit faire entre 2 et 20 caractères';
                }
            }

            $content = Request::post('content');

            if (empty($content)) {
                $_SESSION['comment_errors']['content'] = 'Veuillez renseigner le corps du commentaire';
            } else {
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


