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
        $query = 'SELECT * FROM user ORDER BY role, user_id DESC';

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

    public static function delete(int $id): \PDOStatement
    {
        $query = 'DELETE FROM user
                  WHERE user_id = :id';

        return parent::executeQuery($query, ['id' => $id]);
    }

    public static function grant(int $id): \PDOStatement
    {
        $query = 'UPDATE user 
                    SET role = :role
                  WHERE user_id = :id';

        return parent::executeQuery($query, ['role' => 'ADMIN', 'id' => $id]);
    }

    public static function deny(int $id): \PDOStatement
    {
        $query = 'UPDATE user 
                    SET role = :role
                  WHERE user_id = :id';

        return parent::executeQuery($query, ['role' => 'REGISTERED_USER', 'id' => $id]);
    }
}
