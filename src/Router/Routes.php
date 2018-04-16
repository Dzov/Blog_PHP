<?php

namespace Blog\Router;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class Routes
{
    private $routes =
        [
            ''                         => ['controller' => 'Home', 'action' => 'show'],
            'listPosts'                => ['controller' => 'Post', 'action' => 'list'],
            'post/{id}'                => [
                'controller' => 'Post',
                'action'     => 'showPost',
                'parameters' => ['id' => '[0-9]+']
            ],
            'post/addComment/{postId}' => [
                'controller' => 'Comment',
                'action'     => 'save',
                'parameters' => ['postId' => '[0-9]+']
            ],
            'about'                    => ['controller' => 'About', 'action' => 'show'],
            'contact'                  => ['controller' => 'Contact', 'action' => 'show'],
            'contact/send'             => ['controller' => 'Contact', 'action' => 'send'],
            'loginPage'                => ['controller' => 'Auth', 'action' => 'show'],
            'login'                    => ['controller' => 'Auth', 'action' => 'login'],
            'logout'                   => ['controller' => 'Auth', 'action' => 'logout'],
            'admin'                    => ['controller' => 'Admin', 'action' => 'show'],
            'adminPosts'               => ['controller' => 'AdminPost', 'action' => 'list'],
            'adminPosts/create'        => ['controller' => 'AdminPost', 'action' => 'create'],
            'adminPosts/{id}/showEdit' => [
                'controller' => 'AdminPost',
                'action'     => 'showEdit',
                'parameters' => ['id' => '[0-9]+']
            ],
            'adminPosts/{id}/edit'     => [
                'controller' => 'AdminPost',
                'action'     => 'edit',
                'parameters' => ['id' => '[0-9]+']
            ],
            'adminPosts/{id}/delete'   => [
                'controller' => 'AdminPost',
                'action'     => 'delete',
                'parameters' => ['id' => '[0-9]+']
            ],
            'adminComments'            => ['controller' => 'AdminComment', 'action' => 'list'],
            'publish/{id}'             => [
                'controller' => 'AdminComment',
                'action'     => 'publish',
                'parameters' => ['id' => '[0-9]+']
            ],
            'delete/{id}'              => [
                'controller' => 'AdminComment',
                'action'     => 'delete',
                'parameters' => ['id' => '[0-9]+']
            ],
            'adminUsers'               => ['controller' => 'AdminUser', 'action' => 'list'],
            '404'                      => ['controller' => 'Error', 'action' => 'show404'],
            '403'                      => ['controller' => 'Error', 'action' => 'show403']
        ];

    public function getRoutes(): array
    {
        return $this->routes;
    }
}
