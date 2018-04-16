<?php

namespace Blog;

use Blog\Controller\Exceptions\ControllerNotFoundException;
use Blog\Controller\Exceptions\ActionNotFoundException;
use Blog\Controller\Exceptions\RouteNotFoundException;
use Blog\Controller\Exceptions\AccessDeniedException;

require_once '../vendor/autoload.php';

session_start();

try {
    new Kernel();
} catch (ActionNotFoundException $anfe) {
    echo $anfe->getMessage();
} catch (ControllerNotFoundException $anfe) {
    echo $anfe->getMessage();
} catch (AccessDeniedException $ade) {
    header('Location: 403');
} catch (RouteNotFoundException $rnfe) {
    header('Location: 404');
}







