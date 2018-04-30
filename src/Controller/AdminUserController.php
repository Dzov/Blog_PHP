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

            if ($_POST['token'] === $_SESSION['token']) {
                UserManager::grant($id);
                $_SESSION['success'][] = 'L\'utilisateur a maintenant le role admin';
            } else {
                $_SESSION['errors'][] = 'Une erreur de vérification est survenue';
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

            if ($_POST['token'] === $_SESSION['token']) {
                UserManager::deny($id);
                $_SESSION['success'][] = 'Le role admin de l\'utilisateur a bien été retiré';
            } else {
                $_SESSION['errors'][] = 'Une erreur de vérification est survenue';
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

            if ($_POST['token'] === $_SESSION['token']) {
                UserManager::delete($id);
                $_SESSION['success'][] = 'L\'utilisateur a bien été supprimé';
            } else {
                $_SESSION['errors'][] = 'Une erreur de vérification est survenue';
            }
        }

        self::redirect('admin/users');
    }
}
