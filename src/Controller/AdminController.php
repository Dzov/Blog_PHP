<?php

namespace Blog\Controller;

use Blog\Model\CommentManager;
use Blog\Model\PostManager;
use Blog\Model\UserManager;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AdminController extends Controller
{
    public static function showDashboardAction(): void
    {
        self::renderTemplate('admin-dashboard.twig', []);
    }

    public static function listPostsAction(): void
    {
        $posts = PostManager::findAllPosts();

        self::renderTemplate(
            'admin-posts.twig',
            ['posts' => $posts]
        );
    }

    public static function listCommentsAction(): void
    {
        $comments = CommentManager::findAllComments();

        self::renderTemplate(
            'admin-comments.twig',
            ['comments' => $comments]
        );
    }

    public static function listUsersAction(): void
    {
        $users = UserManager::findAllUsers();

        self::renderTemplate(
            'admin-users.twig',
            ['users' => $users]
        );
    }

    public static function publishCommentAction(array $parameters): void
    {
        $id = $parameters['id'];

        CommentManager::publishComment($id);

        self::redirect('adminComments');
    }

    public static function deleteCommentAction(array $parameters): void
    {
        $id = $parameters['id'];

        CommentManager::delete($id);

        self::redirect('adminComments');
    }
}
