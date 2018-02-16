<?php

namespace Blog\Model;

use http\Exception;
use PDO;

/**
 * @author Amélie-Dzovinar Haladjian
 */
abstract class DatabaseConnection
{
    private static $db;

    private function getDb()
    {
        try
        {
            require 'db_config.php';

            self::$db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $password);
            return self::$db;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    protected function executeQuery($query, $parameters = null)
    {
        if(null === $parameters)
        {
            $results = $this->getDb()->query($query);
        } else {
            $results = $this->getDb()->prepare($query);
            $results->execute($parameters);
        }

        return $results;
    }
}

