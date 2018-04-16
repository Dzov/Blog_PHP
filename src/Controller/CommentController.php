<?php

namespace Blog\Controller;

use Blog\Model\CommentManager;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class CommentController extends Controller
{
    public static function saveAction(array $parameters = []): void
    {
        $postId = $parameters['postId'];
        $author = $_POST['author'];
        $content = $_POST['content'];

        CommentManager::insert($postId, $author, $content);

        self::redirect('/post/' . $postId);
    }
}

