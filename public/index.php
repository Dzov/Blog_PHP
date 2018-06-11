<?php

namespace Blog;

use Blog\Exception\ControllerNotFoundException;
use Blog\Exception\ActionNotFoundException;
use Blog\Exception\ResourceNotFoundException;
use Blog\Exception\RouteNotFoundException;
use Blog\Exception\AccessDeniedException;

require_once '../vendor/autoload.php';

session_start();

try {
    new Kernel();
} catch (ActionNotFoundException | ControllerNotFoundException | \Twig_Error_Loader | \Twig_Error_Runtime | \Twig_Error_Syntax $e) {
    header('Location: 500');
} catch (AccessDeniedException $ade) {
    header('Location: 403');
} catch (RouteNotFoundException | ResourceNotFoundException $rnfe) {
    header('Location: 404');
}






