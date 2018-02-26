<?php

namespace Blog\Model;

use Blog\Config\Parameters;
use http\Exception;
use PDO;

/**
 * @author Amélie-Dzovinar Haladjian
 */
abstract class DatabaseConnection
{
    private static $db;

    private static function getDb()
    {
        try {
            if (null === self::$db) {
                self::$db = new PDO(
                    'mysql:host=' . Parameters::$host . ';dbname=' . Parameters::$dbName . ';charset=utf8',
                    Parameters::$user,
                    Parameters::$password
                );
            }

            return self::$db;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function executeQuery($query, $parameters = null)
    {
        if (null === $parameters) {
            $results = self::getDb()->query($query);
        } else {
            $results = self::getDb()->prepare($query);
            $results->execute($parameters);
        }

        return $results;
    }
}

