<?php

namespace Controller;

use Blog\Controller\Controller;
use Blog\Model\PostManager;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AdminPostsController extends Controller
{
    public static function listPostsAction(): void
    {
        $posts = PostManager::findAllPosts();

        self::renderTemplate(
            'admin-posts.twig',
            ['posts' => $posts]
        );
    }
}
