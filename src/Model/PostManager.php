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
                    JOIN user u ON p.author = u.user_id';

        return parent::executeQuery($query)->fetchAll();
    }

    public static function findRecentPosts()
    {
        $query = 'SELECT p.post_id, p.title, p.subtitle, p.updated_at, u.username 
                    FROM post p
                    JOIN user u ON p.author = u.user_id 
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
                    JOIN user u ON c.author = u.user_id
                    WHERE c.post_id = :id AND c.status = "PUBLISHED"';

        return parent::executeQuery($query, [':id' => $id])->fetchAll();
    }

    public static function deletePost(int $id)
    {
        //TODO
    }

    public static function updatePost(int $id)
    {
        //TODO
    }

    public static function addPost()
    {
        //TODO
    }
}

