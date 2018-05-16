<?php

namespace Blog\Controller;

use Blog\Controller\Exceptions\AuthenticationErrorException;
use Blog\Controller\Exceptions\ResourceNotFoundException;
use Blog\Model\PostManager;
use Blog\Utils\Request;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class AdminPostController extends Controller
{
    /**
     * @throws \Exception
     */
    public static function listAction(): void
    {
        self::setToken();

        $posts = PostManager::findAll();

        self::renderTemplate('admin-posts.twig', ['posts' => $posts]);
    }

    /**
     * @throws ResourceNotFoundException
     * @throws AuthenticationErrorException
     * @throws \Exception
     */
    public static function editAction(array $parameters): void
    {
        $id = $parameters['id'];

        $post = PostManager::findById($id);

        $submit = Request::post('submitPost');

        if (isset($submit)) {
            $vm = [];

            $title = Request::post('title');

            if (empty($title)) {
                $vm['errors']['title'] = 'Veuillez renseigner le titre';
            } else {
                $vm['title'] = $title;

                if (strlen($title) < 2 || strlen($title) > 45) {
                    $vm['errors']['title'] = 'Le titre doit faire entre 2 et 45 caractères';
                }
            }

            $subtitle = Request::post('subtitle');

            if (empty($subtitle)) {
                $vm['errors']['subtitle'] = 'Veuillez renseigner le chapô';
            } else {
                $vm['subtitle'] = $subtitle;

                if (strlen($subtitle) < 2 || strlen($subtitle) > 95) {
                    $vm['errors']['subtitle'] = 'Le chapô doit faire entre 5 et 95 caractères';
                }
            }

            $content = Request::post('content');

            if (empty($content)) {
                $vm['errors']['content'] = 'Veuillez renseigner le contenu de l\'article';
            } else {
                $vm['content'] = $content;

                if (strlen($content) < 15) {
                    $vm['errors']['content'] = 'L\'article doit contenir au moins 15 caractères';
                }
            }

            if (!self::tokenIsValid(Request::post('token'))) {
                $vm['errors']['security'] = '';
            }

            if (!isset($vm['errors'])) {
                PostManager::update($id, $title, $subtitle, $content);
                $_SESSION['success'][] = 'L\'article a bien été modifié';

                self::redirect('admin/posts');

                return;
            } else {
                self::renderTemplate('admin-posts-form.twig', ['vm' => $vm, 'post' => $post]);

                return;
            }
        }

        self::renderTemplate('admin-posts-form.twig', ['post' => $post]);
    }

    /**
     * @throws ResourceNotFoundException
     * @throws AuthenticationErrorException
     * @throws \Exception
     */
    public
    static function createAction(): void
    {
        $submit = Request::post('submitPost');

        if (isset($submit)) {
            $vm = [];

            $title = Request::post('title');

            if (empty($title)) {
                $vm['errors']['title'] = 'Veuillez renseigner le titre';
            } else {
                $vm['title'] = $title;

                if (strlen($title) < 2 || strlen($title) > 45) {
                    $vm['errors']['title'] = 'Le titre doit faire entre 2 et 45 caractères';
                }
            }

            $subtitle = Request::post('subtitle');

            if (empty($subtitle)) {
                $vm['errors']['subtitle'] = 'Veuillez renseigner le chapô';
            } else {
                $vm['subtitle'] = $subtitle;

                if (strlen($subtitle) < 2 || strlen($subtitle) > 95) {
                    $vm['errors']['subtitle'] = 'Le chapô doit faire entre 5 et 95 caractères';
                }
            }

            $content = Request::post('content');

            if (empty($content)) {
                $vm['errors']['content'] = 'Veuillez renseigner le contenu de l\'article';
            } else {
                $vm['content'] = $content;

                if (strlen($content) < 15) {
                    $vm['errors']['content'] = 'L\'article doit contenir au moins 15 caractères';
                }
            }

            $author = Request::post('author');

            if (empty($author)) {
                $vm['errors']['author'] = 'Veuillez renseigner votre identifiant';
            } else {
                $vm['author'] = $author;

                if (strlen($author) < 2) {
                    $vm['errors']['author'] = 'Votre identifiant doit faire au moins 2 caractères';
                }
            }

            if (!self::tokenIsValid(Request::post('token'))) {
                $vm['errors']['security'] = 'Une erreur d\'authentification est survenue';
            }

            if (!isset($vm['errors'])) {
                PostManager::create($author, $title, $subtitle, $content);
                $_SESSION['success'][] = 'L\'article a bien été ajouté';

                self::redirect('admin/posts');

                return;
            } else {
                self::renderTemplate('admin-posts-form.twig', ['vm' => $vm]);

                return;
            }
        }

        self::renderTemplate('admin-posts-form.twig');
    }

    /**
     * @throws ResourceNotFoundException
     * @throws \Exception
     */
    public
    static function deleteAction(
        array $parameters
    ): void
    {
        $submit = Request::post('submit');
        $token = Request::post('token');
        $sessionToken = $_SESSION['token'];

        if (isset($submit) && isset($token) && isset($sessionToken)) {
            $id = $parameters['id'];

            PostManager::findById($id);

            if (self::tokenIsValid($token)) {
                PostManager::delete($id);
                $_SESSION['success'][] = 'L\'article a bien été supprimé';
            } else {
                $_SESSION['errors'][] = 'La session a expiré';
            }
        }

        self::redirect('admin/posts');
    }
}
