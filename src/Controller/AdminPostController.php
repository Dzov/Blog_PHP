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

        try {
            $post = PostManager::findById($id);

            self::renderTemplate(
                'admin-posts-form.twig',
                ['post' => $post]
            );
        } catch (ResourceNotFoundException $rnfe) {
            echo 'Cet article n\'existe pas';
        }
    }

    public static function editAction(array $parameters): void
    {
        $id = $parameters['id'];

        try {
            PostManager::findById($id);

            if (isset($_POST['title']) && isset($_POST['subtitle']) && isset($_POST['content'])) {
                $title = $_POST['title'];
                $subtitle = $_POST['subtitle'];
                $content = $_POST['content'];
                PostManager::update($id, $title, $subtitle, $content);
                self::redirect('adminPosts');
            }
        } catch (ResourceNotFoundException $rnfe) {
            echo 'Cet article n\'existe pas';
        }
    }

    public static function createAction(): void
    {
        try {
            if (isset($_POST['submit']) &&
                isset($_POST['author']) &&
                isset($_POST['title']) &&
                isset($_POST['subtitle']) &&
                isset($_POST['content'])) {
                $author = $_POST['author'];
                $title = $_POST['title'];
                $subtitle = $_POST['subtitle'];
                $content = $_POST['content'];

                PostManager::create($author, $title, $subtitle, $content);

                self::redirect('adminPosts');
            }
            self::renderTemplate('admin-posts-form.twig');
        } catch (ResourceNotFoundException $rnfe) {
            echo 'Cet utilisateur n\'existe pas';
        }
    }

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
