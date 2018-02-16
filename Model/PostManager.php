<?php

use Blog\Model\DatabaseConnection;

require "DatabaseConnection.php";

/**
 * @author Amélie-Dzovinar Haladjian
 */
class PostManager extends DatabaseConnection
{
    public function findAllPosts()
    {
        $query = 'SELECT * FROM post';

        return $this->executeQuery($query)->fetchAll();
    }

    public function findPost($id)
    {
        //TODO
    }

    public function deletePost($id)
    {
        //TODO
    }

    public function updatePost($id)
    {
        //TODO
    }

    public function addPost()
    {
        //TODO
    }
}

