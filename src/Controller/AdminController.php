<?php

namespace Blog\Controller;

use Blog\Model\CommentManager;
use Blog\Model\PostManager;
use Blog\Model\UserManager;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AdminController extends Controller
{
    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public static function showAction(): void
    {
        self::renderTemplate('admin-dashboard.twig', []);
    }
}
