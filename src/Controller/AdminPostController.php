<?php

namespace Blog\Controller;

use Blog\Controller\Exceptions\ResourceNotFoundException;
use Blog\Model\PostManager;
use MongoDB\Driver\Exception\AuthenticationException;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AdminPostController extends Controller
{
    public static function listAction(): void
    {
        self::setToken();

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

            if (strlen($title) < 2 || strlen($title) > 45) {
                $_SESSION['errors'][] = 'Le titre doit faire entre 2 et 45 caractères';
            }
            if (strlen($subtitle) < 2 || strlen($subtitle) > 95) {
                $_SESSION['errors'][] = 'Le chapô doit faire entre 5 et 95 caractères';
            }
            if (strlen($content) < 15) {
                $_SESSION['errors'][] = 'L\'article doit contenir au moins 15 caractères';
            }

            if (!isset($_SESSION['errors'])) {
                PostManager::update($id, $title, $subtitle, $content);
                $_SESSION['success'][] = 'L\'article a bien été modifié';
                self::redirect('admin/posts');
            }
        } else {
            self::renderTemplate(
                'admin-posts-form.twig',
                ['post' => $post]
            );
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

            if (strlen($title) < 2 || strlen($title) > 45) {
                $_SESSION['errors'][] = 'Le titre doit faire entre 2 et 45 caractères';
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
                $_SESSION['success'][] = 'L\'article a bien été ajouté';
                self::redirect('admin/posts');
            }
        } else {
            self::renderTemplate('admin-posts-form.twig');
        }
    }

    /**
     * @throws ResourceNotFoundException
     */
    public static function deleteAction(array $parameters): void
    {
        if (isset($_POST['submit']) && isset($_POST['token']) && isset($_SESSION['token'])) {
            $id = $parameters['id'];

            PostManager::findById($id);

            if (self::tokenIsValid($_POST['token'])) {
                PostManager::delete($id);
                $_SESSION['success'][] = 'L\'article a bien été supprimé';
            } else {
                $_SESSION['errors'][] = 'La session a expiré';
            }
        }
        self::redirect('admin/posts');
    }
}
