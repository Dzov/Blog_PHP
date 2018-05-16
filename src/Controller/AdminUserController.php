<?php

namespace Blog\Controller;

use Blog\Controller\Exceptions\ResourceNotFoundException;
use Blog\Model\UserManager;
use Blog\Utils\Request;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AdminUserController extends Controller
{
    public static function listAction(): void
    {
        self::setToken();

        $users = UserManager::findAll();

        self::renderTemplate(
            'admin-users.twig',
            ['users' => $users]
        );
    }

    /**
     * @throws ResourceNotFoundException
     * @throws \Exception
     */
    public static function grantAdminAction(array $parameters)
    {
        $submit = Request::post('submit');
        $token = Request::post('token');

        if (isset($submit) && isset($token) && isset($_SESSION['token'])) {
            $id = $parameters['id'];

            UserManager::findById($id);

            if (self::tokenIsValid($token)) {
                UserManager::grant($id);
                $_SESSION['success'][] = 'L\'utilisateur a maintenant le role admin';
            } else {
                $_SESSION['errors'][] = 'La session a expiré';
            }
        }

        self::redirect('admin/users');
    }

    /**
     * @throws ResourceNotFoundException
     * @throws \Exception
     */
    public static function denyAdminAction(array $parameters)
    {
        $submit = Request::post('submit');
        $token = Request::post('token');

        if (isset($submit) && isset($token) && isset($_SESSION['token'])) {
            $id = $parameters['id'];

            UserManager::findById($id);

            if (self::tokenIsValid($token)) {
                UserManager::deny($id);
                $_SESSION['success'][] = 'Le role admin de l\'utilisateur a bien été retiré';
            } else {
                $_SESSION['errors'][] = 'La session a expiré';
            }
        }

        self::redirect('admin/users');
    }

    /**
     * @throws ResourceNotFoundException
     * @throws \Exception
     */
    public static function deleteAction(array $parameters): void
    {
        $submit = Request::post('submit');
        $token = Request::post('token');

        if (isset($submit) && isset($token) && isset($_SESSION['token'])) {
            $id = $parameters['id'];

            UserManager::findById($id);

            if (self::tokenIsValid($token)) {
                UserManager::delete($id);
                $_SESSION['success'][] = 'L\'utilisateur a bien été supprimé';
            } else {
                $_SESSION['errors'][] = 'La session a expiré';
            }
        }

        self::redirect('admin/users');
    }
}
