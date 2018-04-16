<?php

namespace Blog\Controller;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class ErrorController extends Controller
{
    public static function show404Action(): void
    {
        self::renderTemplate('404.twig');
    }

    public static function show403Action(): void
    {
        self::renderTemplate('403.twig');
    }
}
