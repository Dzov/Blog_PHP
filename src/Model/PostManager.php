<?php

namespace Blog\Model;

use Blog\Controller\Exceptions\ResourceNotFoundException;
use Blog\Entity\Comment;
use Blog\Entity\Post;
use Blog\Entity\User;

/**
 * @author Amélie-Dzovinar Haladjian
 */
abstract class PostManager extends DatabaseConnection
{
    public static function findAll(): array
    {
        $query = 'SELECT p.post_id, p.title, p.subtitle, p.updated_at, p.author, u.username 
                    FROM post p
                    INNER JOIN user u ON p.author = u.user_id';

        return array_map(
            function ($item) {
                return new Post($item);
            },
            parent::executeQuery($query)->fetchAll()
        );
    }

    public static function findById(int $id): ?Post
    {
        $query = 'SELECT * FROM post 
                    WHERE post_id = :id';

        return new Post(parent::executeQuery($query, [':id' => $id])->fetch());
    }


    public static function findCommentsByPost(int $id): ?array
    {
        $query = 'SELECT c.content, c.posted_at, c.status, u.username
                    FROM comment c
                    INNER JOIN user u ON c.author = u.user_id
                    WHERE c.post_id = :id AND c.status = "PUBLISHED"';

        return array_map(
            function ($item) {
                return new Comment($item);
            },
            parent::executeQuery($query, [':id' => $id])->fetchAll()
        );
    }

    public static function delete(int $id): \PDOStatement
    {
        $query = 'DELETE FROM post WHERE post.post_id = :id';

        return parent::executeQuery($query, [':id' => $id]);
    }

    public static function update(int $id, string $title, string $subtitle, string $content): \PDOStatement
    {
        $query = 'UPDATE post p 
                  SET p.title = :title, 
                    p.subtitle = :subtitle, 
                    p.content = :content, 
                    p.updated_at = :updatedAt 
                  WHERE p.post_id = :id';

        return parent::executeQuery(
            $query,
            [
                ':title'     => $title,
                ':subtitle'  => $subtitle,
                ':content'   => $content,
                ':updatedAt' => date("Y-m-d H:i:s"),
                ':id'        => $id
            ]
        );
    }

    public static function create(string $author, string $title, string $subtitle, string $content): \PDOStatement
    {
        $query = 'INSERT INTO post (post.author, post.title, post.subtitle, post.content, post.updated_at) 
                  VALUES (:author, :title, :subtitle, :content, :updatedAt)';

        return parent::executeQuery(
            $query,
            [
                ':author'    => self::getAuthorId($author),
                ':title'     => $title,
                ':subtitle'  => $subtitle,
                ':content'   => $content,
                ':updatedAt' => date("Y-m-d H:i:s")
            ]
        );
    }

    private static function getAuthorId(string $author): ?string
    {
        $query = 'SELECT user_id FROM user u WHERE u.username = :author';

        try {
            $author = new User(parent::executeQuery($query, ['author' => $author])->fetch());

            return $author->getUser_id();
        } catch (ResourceNotFoundException $rnfe) {
            echo 'Cet utilisateur n\'existe pas';
        }
    }
}

