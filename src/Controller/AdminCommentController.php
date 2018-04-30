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
        $comments = CommentManager::findAll();

        self::renderTemplate(
            'admin-comments.twig',
            ['comments' => $comments]
        );
    }

    public static function publishAction(array $parameters): void
    {
        if (isset($_POST['submit']) && isset($_POST['token']) && isset($_SESSION['token'])) {
            $id = $parameters['id'];

            if ($_POST['token'] === $_SESSION['token']) {
                CommentManager::publish($id);
                $_SESSION['success'][] = 'Le commentaire a bien été publié';
            } else {
                $_SESSION['errors'][] = 'Une erreur de vérification est survenue';
            }
        }
        self::redirect('admin/comments');
    }

    /**
     * @throws ResourceNotFoundException
     */
    public static function deleteAction(array $parameters): void
    {
        if (isset($_POST['submit']) && isset($_POST['token']) && isset($_SESSION['token'])) {
            $id = $parameters['id'];

            CommentManager::findById($id);

            if ($_POST['token'] === $_SESSION['token']) {
                CommentManager::delete($id);
                $_SESSION['success'][] = 'Le commentaire a bien été supprimé';
            } else {
                $_SESSION['errors'][] = 'Une erreur de vérification est survenue';
            }
        }
        self::redirect('admin/comments');
    }
}
