<?php

namespace Blog;

use Blog\Controller\ListPostsController;




require 'Controller/ListPostsController.php';

$controller = new ListPostsController();

$posts = $controller->getPosts();

require 'Views/bona/index.html';

