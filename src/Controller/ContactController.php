<?php

namespace Blog\Controller;

use Blog\Config\Parameters;
use Blog\Utils\Request;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class ContactController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public static function sendAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vm = [];

            $firstName = Request::post('first_name');

            if (empty($firstName)) {
                $vm['errors']['firstName'] = 'Veuillez renseigner votre prénom';
            } else {
                $vm['firstName'] = $firstName;

                if (strlen($firstName) < 2 || strlen($firstName) >= 30) {
                    $vm['errors']['firstName'] = 'Votre prénom doit faire entre 2 et 30 caractères';
                }
            }

            $lastName = Request::post('last_name');

            if (empty($lastName)) {
                $vm['errors']['lastName'] = 'Veuillez renseigner votre nom de famille';
            } else {
                $vm['lastName'] = $lastName;

                if (strlen($lastName) < 2 || strlen($lastName) >= 40) {
                    $vm['errors']['lastName'] = 'Votre nom de famille doit faire entre 2 et 40 caractères';
                }
            }

            $email = Request::post('email');

            if (empty($email)) {
                $vm['errors']['email'] = 'Veuillez renseigner votre email';
            } else {
                $email = str_replace(array("\n", "\r", PHP_EOL), '', $email);
                $vm['email'] = $email;

                if (strlen($email) < 6 || strlen($lastName) >= 50) {
                    $vm['errors']['email'] = 'Votre email doit faire entre 6 et 50 caractères';
                }
            }

            $message = Request::post('message');

            if (empty($message)) {
                $vm['errors']['message'] = 'Veuillez renseigner le corps du mail';
            } else {
                $vm['message'] = $message;

                if (strlen($message) < 5) {
                    $vm['errors']['message'] = 'Votre message doit contenir au moins 5 caractères';
                }
            }

            if (!isset($vm['errors'])) {
                $transport = (new Swift_SmtpTransport(Parameters::$mail_host, Parameters::$mail_port, 'ssl'))
                    ->setUsername(Parameters::$mail_username)
                    ->setPassword(Parameters::$mail_password);

                $mailer = new Swift_Mailer($transport);

                $message = (new Swift_Message('Blog: Nouveau message'))
                    ->setFrom([$email => $firstName . ' ' . $lastName])
                    ->setTo([Parameters::$mail_username => Parameters::$mail_receiver])
                    ->setBody($message);

                $result = $mailer->send($message);

                if ($result) {
                    self::redirect('contact/success');
                }
            } else {
                self::renderTemplate('contact.twig', ['vm' => $vm]);

                return;
            }
        }

        self::renderTemplate('contact.twig');
    }

    /**
     * {@inheritdoc}
     */
    public static function validateAction()
    {
        self::renderTemplate('message-sent.twig');
    }
}
