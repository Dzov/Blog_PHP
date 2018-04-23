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
            'post/list'                   => ['controller' => 'Post', 'action' => 'list'],
            'post/{id}'                   => [
                'controller' => 'Post',
                'action'     => 'showPost',
                'parameters' => ['id' => '[0-9]+']
            ],
            'comment/{postId}/add'        => [
                'controller' => 'Comment',
                'action'     => 'save',
                'parameters' => ['postId' => '[0-9]+']
            ],
            'about'                       => ['controller' => 'About', 'action' => 'show'],
            'contact'                     => ['controller' => 'Contact', 'action' => 'show'],
            'contact/send'                => ['controller' => 'Contact', 'action' => 'send'],
            'contact/success'             => ['controller' => 'Contact', 'action' => 'validate'],
            'login/show'                  => ['controller' => 'Auth', 'action' => 'show'],
            'login'                       => ['controller' => 'Auth', 'action' => 'login'],
            'logout'                      => ['controller' => 'Auth', 'action' => 'logout'],
            'admin'                       => ['controller' => 'Admin', 'action' => 'show'],
            'admin/posts'                 => ['controller' => 'AdminPost', 'action' => 'list'],
            'admin/posts/create'          => ['controller' => 'AdminPost', 'action' => 'create'],
            'admin/posts/{id}/showEdit'   => [
                'controller' => 'AdminPost',
                'action'     => 'showEdit',
                'parameters' => ['id' => '[0-9]+']
            ],
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
            'admin/user/{id}/grant'       => [
                'controller' => 'AdminUser',
                'action'     => 'grantAdmin',
                'parameters' => ['id' => '[0-9]+']
            ],
            'admin/user/{id}/deny'        => [
                'controller' => 'AdminUser',
                'action'     => 'denyAdmin',
                'parameters' => ['id' => '[0-9]+']
            ],
            'admin/user/{id}/delete'      => [
                'controller' => 'AdminUser',
                'action'     => 'delete',
                'parameters' => ['id' => '[0-9]+']
            ],
            '404'                         => ['controller' => 'Error', 'action' => 'show404'],
            '403'                         => ['controller' => 'Error', 'action' => 'show403']
        ];

    public function getRoutes(): array
    {
        return $this->routes;
    }
}
