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

        if($commentAdded)
        {
            var_dump('Comment was successfully added and is now pending approval');
        }
    }
}

