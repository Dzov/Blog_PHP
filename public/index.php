<?php

namespace Blog;

use Blog\Exceptions\ControllerNotFoundException;
use Blog\Exceptions\ActionNotFoundException;
use Blog\Exceptions\ResourceNotFoundException;
use Blog\Exceptions\RouteNotFoundException;
use Blog\Exceptions\AccessDeniedException;

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






