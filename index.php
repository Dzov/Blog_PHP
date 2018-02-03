<?php

namespace Blog;

use Blog\Controller\ListPostsController;

require 'Controller/ListPostsController.php';
require 'vendor/autoload.php';


$controller = new ListPostsController();

$controller->listPostsAction();
