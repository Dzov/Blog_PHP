<?php

namespace Blog;

use Blog\Controller\PostController;

require_once '../vendor/autoload.php';

$controller = new PostController();

$controller->listPostsAction();


