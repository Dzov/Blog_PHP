<?php

namespace Blog\Model;

/**
 * @author Amélie-Dzovinar Haladjian
 */
abstract class CommentManager extends DatabaseConnection
{
    public static function addComment($post_id, $author, $content)
    {
        $query = 'INSERT INTO comment(post_id, author, content, posted_at, status) 
                  VALUES (:post_id, :author, :content, :posted_at, :status)';

        return parent::executeQuery(
            $query,
            [':post_id'   => $post_id,
             ':author'    => $author,
             ':content'   => $content,
             ':posted_at' => date('Y-m-d H:i:s'),
             ':status'    => 'PENDING'
            ]
        );
    }
}
