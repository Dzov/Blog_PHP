<?php

namespace Blog\Controller;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AboutController extends Controller
{
    public static function showAction(){
        self::renderTemplate('about.twig');
    }
}
