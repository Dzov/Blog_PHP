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
        $commentAdded = CommentManager::addComment($post_id, $author, $content);

        if ($commentAdded->rowCount() > 0) {
            header("Location: index.php?action=post&p=$post_id");
        } else {
            echo 'Oops, something went wrong';
        }
    }
}

