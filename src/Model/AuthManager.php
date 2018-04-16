<?php

namespace Blog\Model;

use Blog\Controller\Exceptions\UserNotFoundException;
use Blog\Entity\User;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AuthManager extends DatabaseConnection
{
    /**
     * @throws UserNotFoundException
     */
    public static function getUserIdentification(string $username, string $password): ?User
    {
        $query = 'SELECT u.user_id
                  FROM user u WHERE u.username = :username AND u.password = :password';

        $user = self::executeQuery($query, ['username' => $username, 'password' => $password])->fetch();

        if (false === $user) {
            throw new UserNotFoundException();
        }

        return new User($user);
    }
}
