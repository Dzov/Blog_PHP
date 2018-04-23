<?php

namespace Blog\Model;

use Blog\Entity\User;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class UserManager extends DatabaseConnection
{
    public static function findAll(): array
    {
        $query = 'SELECT * FROM user';

        return parent::executeQuery($query, [])->fetchAll();
    }

    /**
     * @throws \Blog\Controller\Exceptions\ResourceNotFoundException
     */
    public static function findById(int $userId): ?User
    {
        $query = 'SELECT u.first_name, u.last_name, u.username, u.email, u.user_id, u.role 
                  FROM user u WHERE u.user_id = :id';

        return new User(self::executeQuery($query, ['id' => $userId])->fetch());
    }
}
