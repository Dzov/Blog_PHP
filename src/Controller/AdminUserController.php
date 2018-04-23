<?php

namespace Blog\Controller;

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
}
