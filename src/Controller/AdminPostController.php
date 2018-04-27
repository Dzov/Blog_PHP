<?php

namespace Blog\Controller;

use Blog\Controller\Exceptions\ResourceNotFoundException;
use Blog\Model\PostManager;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AdminPostController extends Controller
{
    public static function listAction(): void
    {
        $posts = PostManager::findAll();

        self::renderTemplate(
            'admin-posts.twig',
            ['posts' => $posts]
        );
    }

    /**
     * @throws ResourceNotFoundException
     */
    public static function showEditAction(array $parameters)
    {
        $id = $parameters['id'];

        $post = PostManager::findById($id);

        self::renderTemplate(
            'admin-posts-form.twig',
            ['post' => $post]
        );
    }

    /**
     * @throws ResourceNotFoundException
     */
    public static function editAction(array $parameters): void
    {
        $id = $parameters['id'];

        PostManager::findById($id);

        if (isset($_POST['title']) && isset($_POST['subtitle']) && isset($_POST['content'])) {
            $title = $_POST['title'];
            $subtitle = $_POST['subtitle'];
            $content = $_POST['content'];
            PostManager::update($id, $title, $subtitle, $content);
            self::redirect('admin/posts');
        }
    }

    /**
     * @throws ResourceNotFoundException
     */
    public static function createAction(): void
    {
        if (isset($_POST['submit']) &&
            isset($_POST['author']) &&
            isset($_POST['title']) &&
            isset($_POST['subtitle']) &&
            isset($_POST['content'])
        ) {
            $author = $_POST['author'];
            $title = $_POST['title'];
            $subtitle = $_POST['subtitle'];
            $content = $_POST['content'];

            PostManager::create($author, $title, $subtitle, $content);

            self::redirect('admin/posts');
        }
        self::renderTemplate('admin-posts-form.twig');
    }

    /**
     * @throws ResourceNotFoundException
     */
    public static function deleteAction(array $parameters): void
    {
        $id = $parameters['id'];

        PostManager::findById($id);
        PostManager::delete($id);
        self::redirect('admin/posts');
    }
}
