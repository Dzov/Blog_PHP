<?php

namespace Blog\Controller;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AboutController extends Controller
{
    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public static function showAction(){
        self::renderTemplate('about.twig');
    }
}
