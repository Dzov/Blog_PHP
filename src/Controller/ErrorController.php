<?php

namespace Blog\Controller;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class ErrorController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public static function show404Action(): void
    {
        header("HTTP/1.0 404 Not Found");
        self::renderTemplate('404.twig');
    }

    /**
     * {@inheritdoc}
     */
    public static function show403Action(): void
    {
        header('HTTP/1.0 403 Forbidden');
        self::renderTemplate('403.twig');
    }

    /**
     * {@inheritdoc}
     */
    public static function show500Action(): void
    {
        self::renderTemplate('500.twig');
    }
}
