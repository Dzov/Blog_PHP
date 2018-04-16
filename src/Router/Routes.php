<?php

namespace Blog\Router;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class Routes
{
    private $routes =
        [
            ''                    => ['controller' => 'Home', 'action' => 'listRecentPosts'],
            'listPosts'           => ['controller' => 'Post', 'action' => 'listPosts'],
            'post/{id}'           => [
                'controller' => 'Post',
                'action'     => 'showPost',
                'parameters' => ['id' => '[0-9]+']
            ],
            'post/addComment/{postId}' => [
                'controller' => 'Comment',
                'action'     => 'addComment',
                'parameters' => ['postId' => '[0-9]+']
            ],
            'about'               => ['controller' => 'About', 'action' => 'show'],
            'contact'             => ['controller' => 'Contact', 'action' => 'show'],
            'loginPage'           => ['controller' => 'Auth', 'action' => 'showLogin'],
            'login'               => ['controller' => 'Auth', 'action' => 'login'],
            'logout'              => ['controller' => 'Auth', 'action' => 'logout'],
            'admin'               => ['controller' => 'Admin', 'action' => 'showDashboard'],
            'adminPosts'          => ['controller' => 'AdminPosts', 'action' => 'listPosts'],
            'adminComments'       => ['controller' => 'Admin', 'action' => 'listComments'],
            'publish/{id}'        => [
                'controller' => 'Admin',
                'action'     => 'publishComment',
                'parameters' => ['id' => '[0-9]+']
            ],
            'delete/{id}'         => [
                'controller' => 'Admin',
                'action'     => 'deleteComment',
                'parameters' => ['id' => '[0-9]+']
            ],
            'adminUsers'          => ['controller' => 'Admin', 'action' => 'listUsers'],
            '404'                 => ['controller' => 'Error', 'action' => 'show404'],
            '403'                 => ['controller' => 'Error', 'action' => 'show403']
        ];

    public function getRoutes(): array
    {
        return $this->routes;
    }
}
