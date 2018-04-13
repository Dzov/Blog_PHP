<?php

namespace Blog\Router;

use Blog\Controller\Exceptions\AccessDeniedException;
use Blog\Controller\Exceptions\ActionNotFoundException;
use Blog\Controller\Exceptions\ControllerNotFoundException;
use Blog\Entity\User;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class Kernel
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var array|null
     */
    private $route;

    /**
     * @var string
     */
    private $controller;

    /**
     * @var string
     */
    private $action;

    /**
     * @var array|null
     */
    private $parameters;

    /**
     * @var User|null
     */
    private $currentUser;

    public function __construct()
    {
        $this->router = new Router();
        $this->prepare();
        $this->execute($this->getController(), $this->getAction(), $this->getParameters());
    }

    public function setRoute(array $route = []): void
    {
        $this->route = $route;
    }

    public function setController(string $controller): void
    {
        $this->controller = $controller;
    }

    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    public function setParameters(array $parameters = []): void
    {
        $this->parameters = $parameters;
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    public function getRoute(): ?array
    {
        return $this->route;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getParameters(): ?array
    {
        return $this->parameters;
    }

    /**
     * @throws \Blog\Controller\Exceptions\RouteNotFoundException
     */
    public function getMatchingRoute(string $url): ?array
    {
        return $this->getRouter()->getMatchingRoute($url);
    }

    public function setRoutingElements(array $matchingRoute = []): void
    {
        $this->setController($matchingRoute['controller']);
        $this->setAction($matchingRoute['action']);
        $this->setParameters($matchingRoute['parameters']);
    }

    /**
     * @throws AccessDeniedException
     * @throws ActionNotFoundException
     * @throws ControllerNotFoundException
     */
    public function execute(string $controller, string $action, array $parameters = []): void
    {
        if (!class_exists($controller)) {
            throw new ControllerNotFoundException();
        }

        if (!method_exists($controller, $action)) {
            throw new ActionNotFoundException();
        }

        if (strpos($controller, 'Admin') && $this->getUserRole() !== 'ADMIN') {
            throw new AccessDeniedException('Vous n\'avez pas les droits');
        }

        $controller::$action($parameters);
    }

    /**
     * @throws \Blog\Controller\Exceptions\RouteNotFoundException
     */
    private function prepare(): void
    {
        $url = str_replace($_SERVER['BASE'] . '/', '', $_SERVER['REQUEST_URI']);
        $this->setRoute($this->getMatchingRoute($url));
        $this->setRoutingElements($this->getRoute());
        $this->setCurrentUser();
    }

    public function getCurrentUser(): ?User
    {
        return $this->currentUser;
    }

    public function getUserRole(): ?string
    {
        return $this->currentUser->getRole();
    }

    public function setCurrentUser(): void
    {
        if (isset($_SESSION['user']))
        {
            $this->currentUser = $_SESSION['user'];
        }
    }
}
