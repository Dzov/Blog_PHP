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

    public static function showEditAction(array $parameters)
    {
        $id = $parameters['id'];

        $post = PostManager::findById($id);

        self::renderTemplate(
            'admin-posts-form.twig',
            ['post' => $post]
        );
    }

    public static function editAction(array $parameters): void
    {
        $id = $parameters['id'];
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $content = $_POST['content'];

        PostManager::update($id, $title, $subtitle, $content);

        self::redirect('adminPosts');
    }

    public static function createAction(): void
    {
        if (isset($_POST['submit'])) {
            $author = $_POST['author'];
            $title = $_POST['title'];
            $subtitle = $_POST['subtitle'];
            $content = $_POST['content'];

            PostManager::insert($author, $title, $subtitle, $content);

            self::redirect('adminPosts');
        }

        self::renderTemplate('admin-posts-form.twig');
    }

    /**
     * @throws Exceptions\ResourceNotFoundException
     */
    public static function deleteAction(array $parameters): void
    {
        $id = $parameters['id'];

        try {
            PostManager::findById($id);
            PostManager::delete($id);
            self::redirect('adminPosts');
        } catch (ResourceNotFoundException $rnfe) {
            echo 'Cet article n\existe pas';
        }
    }
}
