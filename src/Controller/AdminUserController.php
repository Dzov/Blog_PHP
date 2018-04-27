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
        $id = $parameters['id'];

        UserManager::findById($id);
        UserManager::grant($id);

        self::redirect('admin/users');
    }

    /**
     * @throws ResourceNotFoundException
     */
    public static function denyAdminAction(array $parameters)
    {
        $id = $parameters['id'];

        UserManager::findById($id);
        UserManager::deny($id);

        self::redirect('admin/users');
    }

    /**
     * @throws ResourceNotFoundException
     */
    public static function deleteAction(array $parameters): void
    {
        $id = $parameters['id'];

        UserManager::findById($id);
        UserManager::delete($id);

        self::redirect('admin/users');
    }
}
