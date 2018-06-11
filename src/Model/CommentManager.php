<?php

namespace Blog\Model;

use Blog\Entity\Comment;
use Blog\Entity\User;
use Blog\Exception\ResourceNotFoundException;

/**
 * @author Amélie-Dzovinar Haladjian
 */
abstract class CommentManager extends DatabaseConnection
{
    public static function findAll(): array
    {
        $query = 'SELECT c.id, c.post_id, c.author, c.content, c.posted_at, c.status, c.anon_username, u.id AS user_id, u.username
                  FROM comment c LEFT JOIN user u ON c.author = u.id ORDER BY status, posted_at DESC';

        return array_map(
            function ($item) {
                return new Comment($item);
            },
            parent::executeQuery($query)->fetchAll()
        );
    }

    /**
     * @throws ResourceNotFoundException
     */
    public static function findById(int $id): ?Comment
    {
        $query = 'SELECT c.id FROM comment c WHERE c.id = :id';

        return new Comment(parent::executeQuery($query, ['id' => $id])->fetch());
    }

    public static function insert(int $post_id, string $author, string $content): \PDOStatement
    {
        $query = 'INSERT INTO comment(post_id, author, content, posted_at, status, anon_username) 
                  VALUES (:post_id, :author, :content, :posted_at, :status, :anon_username)';

        return parent::executeQuery(
            $query,
            [
                ':post_id'       => $post_id,
                ':author'        => self::getAuthorId($author) ? self::getAuthorId($author) : null,
                ':content'       => $content,
                ':posted_at'     => date('Y-m-d H:i:s'),
                ':status'        => 'PENDING',
                ':anon_username' => self::getAuthorId($author) ? null : $author
            ]
        );
    }

    private static function getAuthorId(string $username): ?int
    {
        try {
            $query = 'SELECT id FROM user u WHERE u.username = :username';
            $author = new User(parent::executeQuery($query, ['username' => $username])->fetch());

            return $author->getId();
        } catch (ResourceNotFoundException $rnfe) {
            return null;
        }
    }

    public static function publish(int $id): \PDOStatement
    {
        $query = 'UPDATE comment c
                  SET status = :status
                  WHERE c.id = :id';

        return parent::executeQuery($query, ['status' => 'PUBLISHED', 'id' => $id]);
    }

    public static function delete(int $id): \PDOStatement
    {
        $query = 'DELETE FROM comment
                  WHERE id = :id';

        return parent::executeQuery($query, ['id' => $id]);
    }
}
