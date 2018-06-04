<?php

namespace Blog\Controller;

use Blog\Exception\ResourceNotFoundException;
use Blog\Model\CommentManager;
use Blog\Utils\Request;
use Blog\Utils\TokenCSRF;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AdminCommentController extends Controller
{
    /**
     * @throws \Exception
     */
    public static function listAction(): void
    {
        TokenCSRF::setToken();

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

        if (isset($submit)) {
            $id = $parameters['id'];

            if (TokenCSRF::isValid(Request::post('token'))) {
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

        if (isset($submit)) {
            $id = $parameters['id'];

            CommentManager::findById($id);

            if (TokenCSRF::isValid(Request::post('token'))) {
                CommentManager::delete($id);
                $_SESSION['success'][] = 'Le commentaire a bien été supprimé';
            } else {
                $_SESSION['errors'][] = 'La session a expiré';
            }
        }
        self::redirect('admin/comments');
    }
}
