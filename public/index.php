<?php

namespace Blog;

use Blog\Controller\HomeController;
use Blog\Controller\PostController;

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
        case 'about':
            break;
        case 'contact':
            break;
    }
} else {
    HomeController::listRecentPostsAction();
}


