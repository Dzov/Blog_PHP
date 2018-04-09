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
    public static function showDashboardAction()
    {
        if ($_SESSION['user']['role'] !== 'ADMIN') {
            header('Location: index.php');
        } else {
        self::renderTemplate('admin-dashboard.twig', []);
        }
    }

    public static function listPostsAction()
    {
        $posts = PostManager::findAllPosts();

        self::renderTemplate(
            'admin-posts.twig',
            ['posts' => $posts]
        );
    }

    public static function listCommentsAction()
    {
        $comments = CommentManager::findAllComments();

        self::renderTemplate(
            'admin-comments.twig',
            ['comments' => $comments]
        );
    }

    public static function listUsersAction()
    {
        $users = UserManager::findAllUsers();

        self::renderTemplate(
            'admin-users.twig',
            ['users' => $users]
        );
    }

    public static function publishPendingCommentAction(array $parameters)
    {
        $id = $parameters['id'];

        $publishedComment = CommentManager::publishComment($id);

        $redirectUrl = $_SERVER['BASE'] . '/adminComments';

        if ($publishedComment->rowCount() > 0) {
            header("Location: $redirectUrl");
            echo "Le commentaire a bien été publié";
        } else {
            echo 'Oops, something went wrong';
        }
    }
}
