<?php

namespace Blog\Model;

use Blog\Entity\User;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class UserManager extends DatabaseConnection
{
    public static function findAllUsers()
    {
        $query = 'SELECT * FROM user';

        return parent::executeQuery($query, [])->fetchAll();
    }

    public static function findById(int $userId)
    {
        $query = 'SELECT u.first_name, u.last_name, u.username, u.email, u.user_id, u.role 
                  FROM user u WHERE u.user_id = :id';

        return new User(
            self::executeQuery($query, ['id' => $userId])->fetch()
        );
    }
}
