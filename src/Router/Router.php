<?php

namespace Blog\Router;

use Blog\Exceptions\RouteNotFoundException;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class Router
{
    private $routes;

    public function __construct()
    {
        $routes = new Routes();
        $this->routes = $routes->getRoutes();
    }

    /**
     * @throws RouteNotFoundException
     */
    public function getMatchingRoute(string $requestUrl = ''): ?array
    {
        foreach ($this->routes as $uriPattern => $route) {

            $parameters = $route['parameters'] ?? [];

            if ($this->routeMatch($requestUrl, $uriPattern, $parameters)) {

                $controllerClassName = $this->getControllerClassName($route);

                $actionName = $this->getActionName($route);

                return ['controller' => $controllerClassName, 'action' => $actionName, 'parameters' => $parameters];
            }
        }

        throw new RouteNotFoundException();
    }

    private function getControllerClassName(array $route): string
    {
        $controller = $route['controller'];
        $controller = 'Blog\\Controller\\' . $controller . 'Controller';

        return $controller;
    }

    private function getActionName(array $route): string
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

    private function getParameters(array $parameterKeys, array $parameters, array $matches)
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
