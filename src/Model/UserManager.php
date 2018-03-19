<?php

namespace Blog\Model;

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
}
