<?php

namespace Blog\Controller;

use Blog\Model\CommentManager;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class CommentController extends Controller
{
    public static function addCommentAction(int $post_id, string $author, string $content): void
    {
        CommentManager::addComment($post_id, $author, $content);

        $redirectUrl = $_SERVER['BASE'] . '/post/' . $post_id;

        header("Location: $redirectUrl");
    }
}

