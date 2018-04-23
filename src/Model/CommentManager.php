<?php

namespace Blog\Model;

use Blog\Controller\Exceptions\ResourceNotFoundException;
use Blog\Entity\Comment;
use Blog\Entity\User;

/**
 * @author Amélie-Dzovinar Haladjian
 */
abstract class CommentManager extends DatabaseConnection
{
    public static function findAll(): array
    {
        $query = 'SELECT c.comment_id, c.post_id, c.author, c.content, c.posted_at, c.status, u.user_id, u.username 
                  FROM comment c INNER JOIN user u ON c.author = u.user_id ORDER BY status, posted_at DESC';

        return parent::executeQuery($query, [])->fetchAll();
    }

    /**
     * @throws ResourceNotFoundException
     */
    public static function findById(int $id): ?Comment
    {
        $query = 'SELECT c.comment_id, c.post_id, c.author, c.content, c.posted_at, c.status, u.user_id, u.username 
                  FROM comment c INNER JOIN user u ON c.author = u.user_id WHERE c.comment_id = :id';

        return new Comment(parent::executeQuery($query, ['id' => $id])->fetch());
    }

    /**
     * @throws ResourceNotFoundException
     */
    public static function insert(int $post_id, string $author, string $content): \PDOStatement
    {
        $query = 'INSERT INTO comment(post_id, author, content, posted_at, status) 
                  VALUES (:post_id, :author, :content, :posted_at, :status)';

        return parent::executeQuery(
            $query,
            [
                ':post_id'   => $post_id,
                ':author'    => self::getAuthorId($author),
                ':content'   => $content,
                ':posted_at' => date('Y-m-d H:i:s'),
                ':status'    => 'PENDING'
            ]
        );
    }

    /**
     * @throws ResourceNotFoundException
     */
    private static function getAuthorId(string $author): int
    {
        $query = 'SELECT user_id FROM user u WHERE u.username = :author';

        $author = new User(parent::executeQuery($query, ['author' => $author])->fetch());

        return $author->getUser_id();
    }

    public static function publish(int $id): \PDOStatement
    {
        $query = 'UPDATE comment c
                  SET status = :status
                  WHERE c.comment_id = :id';

        return parent::executeQuery($query, ['status' => 'PUBLISHED', 'id' => $id]);
    }

    public static function delete(int $id): \PDOStatement
    {
        $query = 'DELETE FROM comment
                  WHERE comment_id = :id';

        return parent::executeQuery($query, ['id' => $id]);
    }
}
