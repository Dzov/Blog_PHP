<?php

namespace Blog;

use Blog\Controller\CommentController;
use Blog\Controller\HomeController;
use Blog\Controller\PostController;
use Blog\Router\Router;

require_once '../vendor/autoload.php';

$router = new Router();

$url = str_replace($_SERVER['BASE'] . '/', '', $_SERVER['REQUEST_URI']);

$router->get($url);


/*
    switch ($_GET['url']) {
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
        default :
            HomeController::listRecentPostsAction();
}*/


