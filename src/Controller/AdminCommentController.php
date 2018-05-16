<?php

namespace Blog\Controller;

use Blog\Controller\Exceptions\ResourceNotFoundException;
use Blog\Model\CommentManager;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AdminCommentController extends Controller
{
    public static function listAction(): void
    {
        self::setToken();

        $comments = CommentManager::findAll();

        self::renderTemplate(
            'admin-comments.twig',
            ['comments' => $comments]
        );
    }

    public static function publishAction(array $parameters): void
    {
        if (isset($_POST['submit']) && isset($_POST['token']) && isset($_SESSION['security'])) {
            $id = $parameters['id'];

            if (self::tokenIsValid($_POST['token'])) {
                CommentManager::publish($id);
                $_SESSION['success'][] = 'Le commentaire a bien été publié';
            } else {
                $_SESSION['errors'][] = 'La session a expiré';
            }
        }
        self::redirect('admin/comments');
    }

    /**
     * @throws ResourceNotFoundException
     */
    public static function deleteAction(array $parameters): void
    {
        if (isset($_POST['submit']) && isset($_POST['token']) && isset($_SESSION['security'])) {
            $id = $parameters['id'];

            CommentManager::findById($id);

            if (self::tokenIsValid($_POST['token'])) {
                CommentManager::delete($id);
                $_SESSION['success'][] = 'Le commentaire a bien été supprimé';
            } else {
                $_SESSION['errors'][] = 'La session a expiré';
            }
        }
        self::redirect('admin/comments');
    }
}
