<?php

namespace Blog\Router;

use Blog\Controller\Exceptions\ControllerNotFoundException;
use Controller\Exceptions\ActionNotFoundException;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class Router
{
    private $routes =
        [
            ''                      => ['controller' => 'Home', 'action' => 'listRecentPosts'],
            'listPosts'             => ['controller' => 'Post', 'action' => 'listPosts'],
            'post/{id}'             => [
                'controller' => 'Post',
                'action'     => 'showPost',
                'parameters' => ['id' => '[0-9]+']
            ],
            'about'                 => ['controller' => 'About', 'action' => 'show'],
            'contact'               => ['controller' => 'Contact', 'action' => 'show'],
            'loginPage'             => ['controller' => 'Auth', 'action' => 'showLogin'],
            'login'                 => ['controller' => 'Auth', 'action' => 'login'],
            'logout'                => ['controller' => 'Auth', 'action' => 'logout'],
            'admin'                 => ['controller' => 'Admin', 'action' => 'showDashboard'],
            'adminPosts'            => ['controller' => 'Admin', 'action' => 'listPosts'],
            'adminComments'         => ['controller' => 'Admin', 'action' => 'listComments'],
            'publishPendingComment/{id}' => [
                'controller' => 'Admin',
                'action'     => 'publishPendingComment',
                'parameters' => ['id' => '[0-9]+']
            ],
            'adminUsers'            => ['controller' => 'Admin', 'action' => 'listUsers'],
        ];

    /**
     * @throws \Exception
     */
    public function get(string $requestUrl = '')
    {
        foreach ($this->routes as $uriPattern => $route) {

            $parameters = $route['parameters'] ?? [];

            if ($this->routeMatch($requestUrl, $uriPattern, $parameters)) {

                $controllerClassName = $this->getControllerClassName($route);

                $actionName = $this->getActionName($route);

                $this->executeAction($controllerClassName, $actionName, $parameters);
            }
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

    private function routeMatch(
        string $requestUrl,
        string $uriPattern,
        array &$parameters = []
    ): bool
    {
        $parameterKeys = [];

        $regex = $this->generateRegex($uriPattern, $parameters, $parameterKeys);

        $matches = [];

        $match = preg_match($regex, $requestUrl, $matches);

        $parameters = $this->getParameters($parameterKeys, $parameters, $matches);

        return $match;
    }

    private function getParameters($parameterKeys, $parameters, $matches)
    {
        foreach ($parameterKeys as $key => $parameterKey) {
            if ($matches) {
                $parameters[$parameterKey] = $matches[$key + 1];
            }
        }

        return $parameters;
    }

    private function generateRegex(
        string $uriPattern,
        array $parameters = [],
        array &$parameterKeys = []
    ): string
    {
        $parameterKeys = [];

        $uriParts = explode('/', $uriPattern);

        for ($i = 0; $i < count($uriParts); $i++) {
            if (strlen($uriParts[$i]) === 0) {
                continue;
            }

            if ($uriParts[$i][0] === '{' && $uriParts[$i][strlen($uriParts[$i]) - 1] === '}') {
                $parameterName = substr($uriParts[$i], 1, -1);

                $uriParts[$i] = '(' . $parameters[$parameterName] . ')';

                $parameterKeys[] = $parameterName;
            }
        }

        return '/^' . implode('\/', $uriParts) . '$/';
    }
}
