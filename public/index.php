<?php

namespace Blog;

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
            CommentController::addCommentAction($_GET['p'], $_POST['author'], $_POST['content']);
            break;
        case 'contact':
            break;
        case 'loginPage':
            AuthController::showLoginAction();
            break;
        case 'login':
            AuthController::loginAction($_POST['username'], $_POST['password']);
            break;
        case 'logout':
            AuthController::logoutAction();
            break;
    }
} else {
    HomeController::listRecentPostsAction();
}


