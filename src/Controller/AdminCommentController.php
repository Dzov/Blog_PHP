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
        $id = $parameters['id'];

        CommentManager::publish($id);

        self::redirect('admin/comments');
    }

    public static function deleteAction(array $parameters): void
    {
        $id = $parameters['id'];

        try {
            CommentManager::findById($id);
            CommentManager::delete($id);

            self::redirect('admin/comments');
        } catch (ResourceNotFoundException $rnfe) {
            self::redirect('404');
        }
    }
}
