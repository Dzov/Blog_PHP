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
} catch (ActionNotFoundException $anfe) {
    header('Location: 500');
} catch (ControllerNotFoundException $cnfe) {
    header('Location: 500');
} catch (AccessDeniedException $ade) {
    header('Location: 403');
} catch (RouteNotFoundException $rnfe) {
    header('Location: 404');
} catch (ResourceNotFoundException $rnfe) {
    header('Location: 404');
}






