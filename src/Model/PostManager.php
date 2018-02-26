<?php

namespace Blog\Model;

/**
 * @author Amélie-Dzovinar Haladjian
 */
abstract class PostManager extends DatabaseConnection
{
    public static function findAllPosts()
    {
        $query = 'SELECT post_id, title, subtitle, updated_at, u.username 
                    FROM post 
                    LEFT JOIN user u 
                    ON post.admin_user_id = u.user_id';

        return parent::executeQuery($query)->fetchAll();
    }

    public static function findRecentPosts()
    {
        $query = 'SELECT post_id, title, subtitle, updated_at, u.username 
                    FROM post 
                    LEFT JOIN user u 
                    ON post.admin_user_id = u.user_id ORDER BY updated_at desc LIMIT 3';

        return parent::executeQuery($query)->fetchAll();
    }

    public static function findPost($id)
    {
        $query = 'SELECT * FROM post 
                    WHERE post_id = :id';

        return parent::executeQuery($query, [':id' => $id])->fetch();
    }

    public static function deletePost($id)
    {
        //TODO
    }

    public static function updatePost($id)
    {
        //TODO
    }

    public static function addPost()
    {
        //TODO
    }
}

