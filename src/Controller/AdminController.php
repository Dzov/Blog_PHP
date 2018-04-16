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
    public static function showAction(): void
    {
        self::renderTemplate('admin-dashboard.twig', []);
    }
}
