<?php

namespace Blog\Controller;

use Blog\Controller\Exceptions\ResourceNotFoundException;
use Blog\Model\UserManager;

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
     */
    public static function grantAdminAction(array $parameters)
    {
        if (isset($_POST['submit']) && isset($_POST['token']) && isset($_SESSION['token'])) {
            $id = $parameters['id'];

            UserManager::findById($id);

            if (self::tokenIsValid($_POST['token'])) {
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
     */
    public static function denyAdminAction(array $parameters)
    {
        if (isset($_POST['submit']) && isset($_POST['token']) && isset($_SESSION['token'])) {
            $id = $parameters['id'];

            UserManager::findById($id);

            if (self::tokenIsValid($_POST['token'])) {
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
     */
    public static function deleteAction(array $parameters): void
    {
        if (isset($_POST['submit']) && isset($_POST['token']) && isset($_SESSION['token'])) {
            $id = $parameters['id'];

            UserManager::findById($id);

            if (self::tokenIsValid($_POST['token'])) {
                UserManager::delete($id);
                $_SESSION['success'][] = 'L\'utilisateur a bien été supprimé';
            } else {
                $_SESSION['errors'][] = 'La session a expiré';
            }
        }

        self::redirect('admin/users');
    }
}
