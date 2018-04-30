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
    public static function editAction(array $parameters): void
    {
        $id = $parameters['id'];

        $post = PostManager::findById($id);

        if (isset($_POST['title']) && isset($_POST['subtitle']) && isset($_POST['content'])) {
            $title = $_POST['title'];
            $subtitle = $_POST['subtitle'];
            $content = $_POST['content'];

            if (strlen($title) < 2 || strlen($title) > 30) {
                $_SESSION['errors'][] = 'Le titre doit faire entre 2 et 30 caractères';
            }
            if (strlen($subtitle) < 2 || strlen($subtitle) > 95) {
                $_SESSION['errors'][] = 'Le chapô doit faire entre 5 et 95 caractères';
            }
            if (strlen($content) < 15) {
                $_SESSION['errors'][] = 'L\'article doit contenir au moins 15 caractères';
            }

            if (!isset($_SESSION['errors'])) {
                PostManager::update($id, $title, $subtitle, $content);
                self::redirect('admin/posts');
            }
        }

        self::renderTemplate(
            'admin-posts-form.twig',
            ['post' => $post]
        );
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

            if (strlen($title) < 2 || strlen($title) > 30) {
                $_SESSION['errors'][] = 'Le titre doit faire entre 2 et 30 caractères';
            }
            if (strlen($subtitle) < 2 || strlen($subtitle) > 95) {
                $_SESSION['errors'][] = 'Le chapô doit faire entre 5 et 95 caractères';
            }
            if (strlen($content) < 15) {
                $_SESSION['errors'][] = 'L\'article doit contenir au moins 15 caractères';
            }
            if (strlen($author) < 2) {
                $_SESSION['errors'][] = 'Votre identifiant doit faire au moins 2 caractères';
            }

            if (!isset($_SESSION['errors'])) {
                PostManager::create($author, $title, $subtitle, $content);
                self::redirect('admin/posts');
            }
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
