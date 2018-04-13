<?php

namespace Blog\Controller;

use Blog\Model\PostManager;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class HomeController extends Controller
{
    public static function listRecentPostsAction(): void
    {
        $posts = PostManager::findRecentPosts();

        self::renderTemplate('home.twig', ['posts' => $posts]);
    }
}
