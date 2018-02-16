<?php

namespace Blog;

use Blog\Controller\ListPostsController;

require __DIR__ . '/vendor/autoload.php';


$controller = new ListPostsController();

$controller->listPostsAction();
