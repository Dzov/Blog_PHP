<?php

namespace Blog\Controller;

use Blog\Model\CommentManager;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class CommentController extends Controller
{
    public static function addCommentAction($post_id, $author, $content)
    {
        $commentAdded = CommentManager::addComment($post_id, $author, $content);

        if ($commentAdded) {
            header("Location: index.php?action=post&p=$post_id");
        }
    }
}

