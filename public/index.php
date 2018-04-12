<?php

namespace Blog;

use Blog\Router\Router;

require_once '../vendor/autoload.php';

session_start();

$router = new Router();

$url = str_replace($_SERVER['BASE'] . '/', '', $_SERVER['REQUEST_URI']);

$router->get($url);



