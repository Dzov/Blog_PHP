<?php

namespace Blog;

use Blog\Controller\ListPostsController;

require 'Controller/ListPostsController.php';

$controller = new ListPostsController();

$controller->listPostsAction();
