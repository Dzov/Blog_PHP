<?php

namespace Blog\Router;

use Blog\Controller\ErrorController;
use Blog\Controller\HomeController;
use Controller\Exceptions\ActionNotFoundException;
use Controller\Exceptions\ControllerNotFoundException;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class Router
{
    private $routes =
        [
            ''          => ['controller' => 'Home', 'action' => 'listRecentPosts'],
            'listPosts' => ['controller' => 'Post', 'action' => 'listPosts'],
            'post/{id}' => [
                'controller' => 'Post',
                'action'     => 'showPost',
                'parameters' => ['id' => '[0-9]+']
            ],
            'about'     => ['controller' => 'About', 'action' => 'show'],
            'contact'   => ['controller' => 'Contact', 'action' => 'show'],
            'admin'     => ['controller' => 'Admin', 'action' => 'show'],
        ];

    /**
     * @throws \Exception
     */
    public function get(string $requestUrl = '')
    {
        // ^$
        // ^listPosts$
        // ^post\/([0-9]+)$
        // ^admin\/post\/([0-9]+)$

        foreach ($this->routes as $uriPattern => $route) {

            $parameters = $route['parameters'] ?? [];

            if ($this->routeMatch($requestUrl, $uriPattern, $parameters)) {

                $controllerClassName = $this->getControllerClassName($route);

                $actionName = $this->getActionName($route);

                $this->executeAction($controllerClassName, $actionName, $parameters);
            }
        }

        if ($requestUrl === '' || $requestUrl === 'index.php') {
            HomeController::listRecentPostsAction();
        } else {
            ErrorController::show();
        }
    }

    /**
     * @throws ControllerNotFoundException
     * @throws ActionNotFoundException
     */
    public function executeAction($controller, $action, $parameters = [])
    {
        if (!class_exists($controller)) {
            throw new ControllerNotFoundException();
        }

        if (!method_exists($controller, $action)) {
            throw new ActionNotFoundException();
        }

        $controller::$action($parameters);
    }

    private function getControllerClassName($route): string
    {
        $controller = $route['controller'];
        $controller = 'Blog\\Controller\\' . $controller . 'Controller';

        return $controller;
    }

    private function getActionName($route): string
    {
        $action = $route['action'] . 'Action';

        return $action;
    }

    private function routeMatch(string $requestUrl, string $uriPattern, array &$parameters = []): bool
    {
        $regex = $this->generateRegex($uriPattern, $parameters);

        $matches = [];

        $match = preg_match($regex, $requestUrl, $matches);

        return $match;
    }

    private function generateRegex(string $uriPattern, array $parameters = []): string
    {
        $uriParts = explode('/', $uriPattern);

        for ($i = 0; $i < count($uriParts); $i++) {
            if (strlen($uriParts[$i]) === 0) {
                continue;
            }

            if ($uriParts[$i][0] === '{' && $uriParts[$i][strlen($uriParts[$i]) - 1] === '}') {
                $parameterName = substr($uriParts[$i], 1, -1);

                $uriParts[$i] = '(' . $parameters[$parameterName] . ')';
            }
        }

        return '/^' . implode('\/', $uriParts) . '$/';
    }
}
