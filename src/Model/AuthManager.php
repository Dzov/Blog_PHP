<?php

namespace Blog\Model;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AuthManager extends DatabaseConnection
{
    public static function getUserInformation($username, $password)
    {
        $query = 'SELECT * FROM user u WHERE u.username = :username';

        return self::executeQuery($query, [':username' => $username])->fetch();
    }
}
