<?php

namespace Blog\Controller;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class HomeController extends Controller
{
    public static function showAction(): void
    {
        self::renderTemplate('home.twig');
    }
}
