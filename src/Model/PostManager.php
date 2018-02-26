<?php

namespace Blog\Model;

/**
 * @author Amélie-Dzovinar Haladjian
 */
abstract class PostManager extends DatabaseConnection
{
    public static function findAllPosts()
    {
        $query = 'SELECT * FROM post';

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

