<?php

namespace Blog\Router;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class Routes
{
    private $routes =
        [
            ''                            => ['controller' => 'Home', 'action' => 'show'],
            'posts/list'                  => ['controller' => 'Post', 'action' => 'list'],
            'posts/{id}'                  => [
                'controller' => 'Post',
                'action'     => 'showPost',
                'parameters' => ['id' => '[0-9]+']
            ],
            'comments/{postId}/add'       => [
                'controller' => 'Comment',
                'action'     => 'save',
                'parameters' => ['postId' => '[0-9]+']
            ],
            'about'                       => ['controller' => 'About', 'action' => 'show'],
            'contact'                     => ['controller' => 'Contact', 'action' => 'send'],
            'contact/success'             => ['controller' => 'Contact', 'action' => 'validate'],
            'login'                       => ['controller' => 'Auth', 'action' => 'login'],
            'register'                    => ['controller' => 'Auth', 'action' => 'register'],
            'logout'                      => ['controller' => 'Auth', 'action' => 'logout'],
            'admin'                       => ['controller' => 'Admin', 'action' => 'show'],
            'admin/posts'                 => ['controller' => 'AdminPost', 'action' => 'list'],
            'admin/posts/create'          => ['controller' => 'AdminPost', 'action' => 'create'],
            'admin/posts/{id}/edit'       => [
                'controller' => 'AdminPost',
                'action'     => 'edit',
                'parameters' => ['id' => '[0-9]+']
            ],
            'admin/posts/{id}/delete'     => [
                'controller' => 'AdminPost',
                'action'     => 'delete',
                'parameters' => ['id' => '[0-9]+']
            ],
            'admin/comments'              => ['controller' => 'AdminComment', 'action' => 'list'],
            'admin/comments/{id}/publish' => [
                'controller' => 'AdminComment',
                'action'     => 'publish',
                'parameters' => ['id' => '[0-9]+']
            ],
            'admin/comments/{id}/delete'  => [
                'controller' => 'AdminComment',
                'action'     => 'delete',
                'parameters' => ['id' => '[0-9]+']
            ],
            'admin/users'                 => ['controller' => 'AdminUser', 'action' => 'list'],
            'admin/users/{id}/grant'      => [
                'controller' => 'AdminUser',
                'action'     => 'grantAdmin',
                'parameters' => ['id' => '[0-9]+']
            ],
            'admin/users/{id}/deny'       => [
                'controller' => 'AdminUser',
                'action'     => 'denyAdmin',
                'parameters' => ['id' => '[0-9]+']
            ],
            'admin/users/{id}/delete'     => [
                'controller' => 'AdminUser',
                'action'     => 'delete',
                'parameters' => ['id' => '[0-9]+']
            ],
            '403'                         => ['controller' => 'Error', 'action' => 'show403'],
            '404'                         => ['controller' => 'Error', 'action' => 'show404'],
            '500'                         => ['controller' => 'Error', 'action' => 'show500'],
        ];

    public function getRoutes(): array
    {
        return $this->routes;
    }
}
