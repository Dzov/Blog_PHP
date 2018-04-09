<?php

namespace Blog\Controller;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class ErrorController extends Controller
{
    public static function show()
    {
        self::renderTemplate('404.twig');
    }
}
