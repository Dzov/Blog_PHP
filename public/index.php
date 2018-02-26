<?php

namespace Blog;

use Blog\Controller\PostController;

require_once '../vendor/autoload.php';

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'listPosts':
            $controller = new PostController();
            $controller->listPostsAction();
            break;
        case 'post':
            if (isset($_GET['p'])) {
                $controller = new PostController();
                $controller->showPostAction((int) $_GET['p']);
            }
            break;
    }
} else {
    $controller = new PostController();
    $controller->listPostsAction();
}


