<?php

namespace Blog\Router;

use Blog\Controller\Controller;
use Blog\Controller\HomeController;
use Blog\Controller\PostController;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class Router
{
    private $routes =
        [
            '/' => ['controller' => 'HomeController', 'action' => 'listRecentPostsAction'],
            'listPosts' => ['controller' => 'PostController', 'action' => 'listPostsAction'],
            'post/{id}' => ['controller' => 'PostController', 'action' => 'showPostAction', 'parameters' => ['id' => '\d']],
        ];

    public function load(string $url = '')
    {
        $parameters = $this->parseUrl($url);

        foreach ($this->routes as $name => $route) {
            if ($url === $name) {
                PostController::listPostsAction();
                $route['controller'] . 'Controller::' . $route['action'] . 'Action()';
            }
        }

        if ($url === '' || $url === 'index.php') {
            HomeController::listRecentPostsAction();
        }

        //var_dump(preg_match('/^\/post\/([a-zA-Z0-9]+)$/', $url, $parameters));
        //var_dump($parameters);
    }

    public function parseUrl($url)
    {
        if (preg_match('/^[a-zA-Z]+\/([a-zA-Z0-9]+)$/', $url, $parameters)) {
            return $parameters;
        }
    }

    /*

    foreach ($routeur as $uriRouteur => $cmdsRouteur)
    {
    if (routeVerify($uriRequest, $uriRouteur))
    {
    echo 'Appelle du controller ' . $cmdsRouteur['controller'] . ' et de l\'action ' . $cmdsRouteur['action'];
    }
    }

    function routeVerify($uriRequest, $uriRouter)
    {
        $parameters = [];

        var_dump($parameters);

        return $uriRequest === $uriRouter;
    }*/
}
