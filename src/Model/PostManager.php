<?php

namespace Blog\Model;

/**
 * @author Amélie-Dzovinar Haladjian
 */
abstract class PostManager extends DatabaseConnection
{
    public static function findAllPosts()
    {
        $query = 'SELECT p.post_id, p.title, p.subtitle, p.updated_at, u.username 
                    FROM post p
                    INNER JOIN user u ON p.author = u.user_id';

        return parent::executeQuery($query)->fetchAll();
    }

    public static function findRecentPosts()
    {
        $query = 'SELECT p.post_id, p.title, p.subtitle, p.updated_at, u.username 
                    FROM post p
                    INNER JOIN user u ON p.author = u.user_id 
                    ORDER BY updated_at desc 
                    LIMIT 3';

        return parent::executeQuery($query)->fetchAll();
    }

    public static function findPost(int $id)
    {
        $query = 'SELECT * FROM post 
                    WHERE post_id = :id';

        return parent::executeQuery($query, [':id' => $id])->fetch();
    }

    public static function findCommentsByPost(int $id)
    {
        $query = 'SELECT c.content, c.posted_at, c.status, u.username
                    FROM comment c
                    INNER JOIN user u ON c.author = u.user_id
                    WHERE c.post_id = :id AND c.status = "PUBLISHED"';

        return parent::executeQuery($query, [':id' => $id])->fetchAll();
    }

    public static function deletePost(int $id)
    {
        $query = 'DELETE FROM post p WHERE p.post_id = :id';

        return parent::executeQuery($query, [':id' => $id]);
    }

    public static function updatePost(int $id, $author, $title, $subtitle, $content, $url)
    {
        $query = 'UPDATE post p 
                  SET p.author = :author, 
                    p.title = :title, 
                    p.subtitle = :subtitle, 
                    p.content = :content, 
                    p.updated_at = :updatedAt, 
                    p.image_url = :url 
                  WHERE p.post_id = :id';

        return parent::executeQuery(
            $query,
            [
                ':author'    => $author,
                ':title'     => $title,
                ':subtitle'  => $subtitle,
                ':content'   => $content,
                ':updatedAt' => date("Y-m-d H:i:s"),
                ':url'       => $url,
                ':id'        => $id
            ]
        );
    }

    public static function addPost($author, $title, $subtitle, $content, $url)
    {
        $query = 'INSERT INTO post p (p.author, p.title, p.subtitle, p.content, p.updated_at, p.image_url) 
                  VALUES (:author, :title, :subtitle, :content, :updatedAt, :url)';

        return parent::executeQuery(
            $query,
            [
                ':author'    => $author,
                ':title'     => $title,
                ':subtitle'  => $subtitle,
                ':content'   => $content,
                ':updatedAt' => date("Y-m-d H:i:s"),
                ':url'       => $url
            ]
        );
    }
}

