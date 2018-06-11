<?php

namespace Blog\Utils;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class Request
{
    public static function get(string $name)
    {
        if (isset($_GET[$name])) {
            return $_GET[$name];
        }

        return null;
    }

    public static function post(string $name)
    {
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }

        return null;
    }
}
