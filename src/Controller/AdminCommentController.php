<?php

namespace Blog\Controller;

use Blog\Controller\Exceptions\ResourceNotFoundException;
use Blog\Model\CommentManager;
use Blog\Utils\Request;

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

    /**
     * @throws \Exception
     */
    public static function publishAction(array $parameters): void
    {
        $submit = Request::post('submit');
        $token = Request::post('token');

        if (isset($submit) && isset($token) && isset($_SESSION['security'])) {
            $id = $parameters['id'];

            if (self::tokenIsValid($token)) {
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
     * @throws \Exception
     */
    public static function deleteAction(array $parameters): void
    {
        $submit = Request::post('submit');
        $token = Request::post('token');

        if (isset($submit) && isset($token) && isset($_SESSION['security'])) {
            $id = $parameters['id'];

            CommentManager::findById($id);

            if (self::tokenIsValid($token)) {
                CommentManager::delete($id);
                $_SESSION['success'][] = 'Le commentaire a bien été supprimé';
            } else {
                $_SESSION['errors'][] = 'La session a expiré';
            }
        }
        self::redirect('admin/comments');
    }
}
