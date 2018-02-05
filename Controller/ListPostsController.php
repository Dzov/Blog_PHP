<?php

namespace Blog\Controller;

use PostManager;

require 'Model/PostManager.php';

/**
 * @author Amélie-Dzovinar Haladjian
 */
class ListPostsController
{
    private $em;

    public function __construct()
    {
        $this->em = new PostManager();
    }

    public function getPosts()
    {
        return $this->em->findAllPosts();
    }
}
