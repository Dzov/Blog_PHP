<?php

namespace Blog\Model;

/**
 * @author Amélie-Dzovinar Haladjian
 */
abstract class PostManager extends DatabaseConnection
{
    public static function findAllPosts()
    {
        $query = 'SELECT * FROM post INNER JOIN user ON post.admin_user_id = user.user_id';

        return parent::executeQuery($query)->fetchAll();
    }

    public static function findPost($id)
    {
        //TODO
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

