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

        self::renderTemplate('admin-posts.twig', ['posts' => $posts]);
    }

    /**
     * @throws ResourceNotFoundException
     */
    public static function editAction(array $parameters): void
    {
        $id = $parameters['id'];

        $post = PostManager::findById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vm = [];

            if (empty($_POST['title'])) {
                $vm['errors']['title'] = 'Veuillez renseigner le titre';
            } else {
                $title = $_POST['title'];
                $vm['title'] = $title;

                if (strlen($title) < 2 || strlen($title) > 45) {
                    $vm['errors']['title'] = 'Le titre doit faire entre 2 et 45 caractères';
                }
            }

            if (empty($_POST['subtitle'])) {
                $vm['errors']['subtitle'] = 'Veuillez renseigner le chapô';
            } else {
                $subtitle = $_POST['subtitle'];
                $vm['subtitle'] = $subtitle;

                if (strlen($subtitle) < 2 || strlen($subtitle) > 95) {
                    $vm['errors']['subtitle'] = 'Le chapô doit faire entre 5 et 95 caractères';
                }
            }

            if (empty($_POST['content'])) {
                $vm['errors']['content'] = 'Veuillez renseigner le contenu de l\'article';
            } else {
                $content = $_POST['content'];
                $vm['content'] = $content;

                if (strlen($content) < 15) {
                    $vm['errors']['content'] = 'L\'article doit contenir au moins 15 caractères';
                }
            }

            if (!isset($vm['errors'])) {
                PostManager::update($id, $title, $subtitle, $content);
                $_SESSION['success'][] = 'L\'article a bien été modifié';

                self::redirect('admin/posts');
            } else {
                self::renderTemplate('admin-posts-form.twig', ['vm' => $vm, 'post' => $post]);

                return;
            }
        }

        self::renderTemplate('admin-posts-form.twig', ['post' => $post]);
    }

    /**
     * @throws ResourceNotFoundException
     */
    public static function createAction(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vm = [];

            if (empty($_POST['title'])) {
                $vm['errors']['title'] = 'Veuillez renseigner le titre';
            } else {
                $title = $_POST['title'];
                $vm['title'] = $title;

                if (strlen($title) < 2 || strlen($title) > 45) {
                    $vm['errors']['title'] = 'Le titre doit faire entre 2 et 45 caractères';
                }
            }

            if (empty($_POST['subtitle'])) {
                $vm['errors']['subtitle'] = 'Veuillez renseigner le chapô';
            } else {
                $subtitle = $_POST['subtitle'];
                $vm['subtitle'] = $subtitle;

                if (strlen($subtitle) < 2 || strlen($subtitle) > 95) {
                    $vm['errors']['subtitle'] = 'Le chapô doit faire entre 5 et 95 caractères';
                }
            }

            if (empty($_POST['content'])) {
                $vm['errors']['content'] = 'Veuillez renseigner le contenu de l\'article';
            } else {
                $content = $_POST['content'];
                $vm['content'] = $content;

                if (strlen($content) < 15) {
                    $vm['errors']['content'] = 'L\'article doit contenir au moins 15 caractères';
                }
            }

            if (empty($_POST['author'])) {
                $vm['errors']['author'] = 'Veuillez renseigner votre identifiant';
            } else {
                $author = $_POST['author'];
                $vm['author'] = $author;

                if (strlen($author) < 2) {
                    $vm['errors']['author'] = 'Votre identifiant doit faire au moins 2 caractères';
                }
            }

            if (!isset($vm['errors'])) {
                PostManager::create($author, $title, $subtitle, $content);
                $_SESSION['success'][] = 'L\'article a bien été ajouté';

                self::redirect('admin/posts');
            } else {
                self::renderTemplate('admin-posts-form.twig', ['vm' => $vm]);

                return;
            }
        }

        self::renderTemplate('admin-posts-form.twig');
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
