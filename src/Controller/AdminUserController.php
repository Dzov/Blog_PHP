<?php

namespace Blog\Controller;

use Blog\Exception\ResourceNotFoundException;
use Blog\Model\UserManager;
use Blog\Utils\Request;
use Blog\Utils\TokenCSRF;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AdminUserController extends Controller
{
    public static function listAction(): void
    {
        TokenCSRF::setToken();

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

        if (isset($submit)) {
            $id = $parameters['id'];

            UserManager::findById($id);

            if (TokenCSRF::isValid(Request::post('token'))) {
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

        if (isset($submit)) {
            $id = $parameters['id'];

            UserManager::findById($id);

            if (TokenCSRF::isValid(Request::post('token'))) {
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

        if (isset($submit)) {
            $id = $parameters['id'];

            UserManager::findById($id);

            if (TokenCSRF::isValid(Request::post('token'))) {
                UserManager::delete($id);
                $_SESSION['success'][] = 'L\'utilisateur a bien été supprimé';
            } else {
                $_SESSION['errors'][] = 'La session a expiré';
            }
        }

        self::redirect('admin/users');
    }
}
