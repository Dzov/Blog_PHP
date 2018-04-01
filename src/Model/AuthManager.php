<?php

namespace Blog\Model;

use Blog\Entity\User;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AuthManager extends DatabaseConnection
{
    public static function getUserInformation($username, $password)
    {
        $query = 'SELECT u.first_name, u.last_name, u.username, u.email, u.user_id, u.role 
                  FROM user u WHERE u.username = :username AND u.password = :password';

        return new User(
            self::executeQuery($query, ['username' => $username, 'password' => $password])->fetch()
        );
    }
}
