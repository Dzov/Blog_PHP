<?php

namespace Blog;

use Blog\Exceptions\AccessDeniedException;
use Blog\Exceptions\ActionNotFoundException;
use Blog\Exceptions\ControllerNotFoundException;
use Blog\Exceptions\ResourceNotFoundException;
use Blog\Exceptions\RouteNotFoundException;
use Blog\Entity\User;
use Blog\Model\UserManager;
use Blog\Router\Router;

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

    /**
     * @throws RouteNotFoundException
     * @throws AccessDeniedException
     * @throws ActionNotFoundException
     * @throws ControllerNotFoundException
     * @throws ResourceNotFoundException
     */
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
     * @throws RouteNotFoundException
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

        if (strpos($controller, 'Admin') && ($this->getUserRole() !== 'ADMIN' || $this->getUserRole() === null)) {
            throw new AccessDeniedException();
        }

        $controller::$action($parameters);
    }

    /**
     * @throws ResourceNotFoundException
     * @throws RouteNotFoundException
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

    /**
     * @throws ResourceNotFoundException
     */
    public function getUserFromSession(): ?User
    {
        if (!isset($_SESSION['userId'])) {
            return null;
        }

        $userId = $_SESSION['userId'];

        return UserManager::findById($userId);
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function setCurrentUser(): void
    {
        $this->currentUser = $this->getUserFromSession();
    }

    public function getUserRole(): ?string
    {
        if (null === $this->currentUser) {
            return null;
        }

        return $this->currentUser->getRole();
    }
}
