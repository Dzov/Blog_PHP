<?php

namespace Blog\Controller;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class ErrorController extends Controller
{
    public static function showAction(): void
    {
        self::renderTemplate('404.twig');
    }
}
