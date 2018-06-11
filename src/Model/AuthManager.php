<?php

namespace Blog\Model;

use Blog\Exception\UserNotFoundException;
use Blog\Entity\User;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AuthManager extends DatabaseConnection
{
    /**
     * @throws \Blog\Exception\ResourceNotFoundException
     */
    public static function getUserIdentification(string $username, string $password): ?User
    {
        $query = 'SELECT u.user_id
                  FROM user u WHERE u.username = :username AND u.password = :password';

        return new User(self::executeQuery($query, ['username' => $username, 'password' => $password])->fetch());
    }
}
