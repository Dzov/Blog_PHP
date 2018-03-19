<?php

namespace Blog;

use Blog\Controller\AdminController;
use Blog\Controller\AuthController;
use Blog\Controller\CommentController;
use Blog\Controller\HomeController;
use Blog\Controller\PostController;

session_start();

require_once '../vendor/autoload.php';

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'listPosts':
            PostController::listPostsAction();
            break;
        case 'post':
            if (isset($_GET['p'])) {
                PostController::showPostAction((int) $_GET['p']);
            }
            break;
        case 'comment':
            CommentController::addCommentAction($_GET['p'], htmlspecialchars($_POST['author']), htmlspecialchars($_POST['content']));
            break;
        case 'contact':
            break;
        case 'loginPage':
            AuthController::showLoginAction();
            break;
        case 'login':
            AuthController::loginAction(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']));
            break;
        case 'logout':
            AuthController::logoutAction();
            break;
        case 'admin':
            AdminController::showAdminDashboardAction();
            break;
        case 'adminPosts':
            AdminController::listAdminPostsActions();
            break;
        case 'adminComments':
            AdminController::listAdminCommentsActions();
            break;
        case 'adminUsers':
            AdminController::listAdminUsersActions();
            break;
    }
} else {
    HomeController::listRecentPostsAction();
}


