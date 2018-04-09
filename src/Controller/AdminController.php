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
    public static function showAdminDashboardAction()
    {
        /*if ($_SESSION['user']['role'] !== 'ADMIN') {
            header('Location: index.php');
        } else {*/
            self::renderTemplate('admin-dashboard.twig', []);
        //}
    }

    public static function listAdminPostsAction()
    {
        $posts = PostManager::findAllPosts();

        self::renderTemplate(
            'admin-posts.twig',
            ['posts' => $posts]
        );
    }

    public static function listAdminCommentsAction()
    {
        $comments = CommentManager::findAllComments();

        self::renderTemplate(
            'admin-comments.twig',
            ['comments' => $comments]
        );
    }

    public static function listAdminUsersAction()
    {
        $users = UserManager::findAllUsers();

        self::renderTemplate(
            'admin-users.twig',
            ['users' => $users]
        );
    }
}
