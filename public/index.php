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



