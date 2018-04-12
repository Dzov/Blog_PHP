<?php

namespace Blog\Controller;

use Blog\Model\CommentManager;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class CommentController extends Controller
{
    public static function addCommentAction(int $post_id, string $author, string $content)
    {
        CommentManager::addComment($post_id, $author, $content);

        header("Location: index.php?action=post&p=$post_id");
    }
}

