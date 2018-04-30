<?php

namespace Blog;

use Blog\Controller\Exceptions\ControllerNotFoundException;
use Blog\Controller\Exceptions\ActionNotFoundException;
use Blog\Controller\Exceptions\ResourceNotFoundException;
use Blog\Controller\Exceptions\RouteNotFoundException;
use Blog\Controller\Exceptions\AccessDeniedException;
use OAuthProvider;

require_once '../vendor/autoload.php';

session_start();

$token = bin2hex(random_bytes(64));


if (!isset ($_SESSION['token'])) {
    $_SESSION['token'] = $token;
}


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







