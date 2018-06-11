<?php

namespace Blog\Model;

use Blog\Entity\User;
use Blog\Exception\ResourceNotFoundException;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class UserManager extends DatabaseConnection
{
    public static function findAll(): array
    {
        $query = 'SELECT * FROM user ORDER BY role, id DESC';

        return array_map(
            function ($item) {
                return new User($item);
            },
            parent::executeQuery($query)->fetchAll()
        );
    }

    /**
     * @throws \Blog\Exception\ResourceNotFoundException
     */
    public static function findById(int $userId): ?User
    {
        $query = 'SELECT u.first_name, u.last_name, u.username, u.email, u.id, u.role 
                  FROM user u WHERE u.id = :id';

        return new User(self::executeQuery($query, ['id' => $userId])->fetch());
    }

    public static function findByUsernameOrEmail(string $username = null, string $email = null): ?User
    {
        $query = 'SELECT u.first_name, u.last_name, u.username, u.email, u.id, u.role 
                  FROM user u WHERE u.username = :username OR u.email = :email';

        try {
            return new User(self::executeQuery($query, ['username' => $username, 'email' => $email])->fetch());
        } catch (ResourceNotFoundException $rnfe) {
            return null;
        }
    }

    public static function delete(int $id): \PDOStatement
    {
        $query = 'DELETE FROM user
                  WHERE id = :id';

        return parent::executeQuery($query, ['id' => $id]);
    }

    public static function grant(int $id): \PDOStatement
    {
        $query = 'UPDATE user 
                    SET role = :role
                  WHERE id = :id';

        return parent::executeQuery($query, ['role' => 'ADMIN', 'id' => $id]);
    }

    public static function deny(int $id): \PDOStatement
    {
        $query = 'UPDATE user 
                    SET role = :role
                  WHERE id = :id';

        return parent::executeQuery($query, ['role' => 'REGISTERED_USER', 'id' => $id]);
    }

    public static function create(
        string $firstName,
        string $lastName,
        string $username,
        string $email,
        string $password
    ): \PDOStatement
    {
        $query = 'INSERT INTO user (user.first_name, user.last_name, user.username, user.email, user.password, user.role) 
                  VALUES (:firstName, :lastName, :username, :email, :password, :role)';

        return parent::executeQuery(
            $query,
            [
                ':firstName' => $firstName,
                ':lastName'  => $lastName,
                ':username'  => $username,
                ':email'     => $email,
                ':password'  => $password,
                ':role'      => 'REGISTERED_USER'
            ]
        );
    }
}
