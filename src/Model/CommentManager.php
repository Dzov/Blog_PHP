<?php

namespace Blog\Model;

/**
 * @author Amélie-Dzovinar Haladjian
 */
abstract class CommentManager extends DatabaseConnection
{
    public static function addComment(int $post_id, string $author, string $content)
    {
        $query = 'INSERT INTO comment(post_id, author, content, posted_at, status) 
                  VALUES (:post_id, :author, :content, :posted_at, :status)';

        return parent::executeQuery(
            $query,
            [':post_id'   => $post_id,
             ':author'    => intval(self::getAuthor($author)),
             ':content'   => $content,
             ':posted_at' => date('Y-m-d H:i:s'),
             ':status'    => 'PENDING'
            ]
        );

    }

    private static function getAuthor(string $author)
    {
        $query = 'SELECT user_id FROM user u WHERE u.username = :author';

        return parent::executeQuery($query, [':author' => $author])->fetch();
    }
}
