<?php

namespace Blog\Utils;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class Request
{
    public static function get(string $key)
    {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        }

        return null;
    }

    public static function post(string $key)
    {
        if (isset($_POST[$key])) {
            return $_POST[$key];
        }

        return null;
    }
}
