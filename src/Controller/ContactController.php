<?php

namespace Blog\Controller;

use Blog\Config\Parameters;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class ContactController extends Controller
{
    public static function sendAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vm = [];

            if (empty($_POST['first_name'])) {
                $vm['errors']['firstName'] = 'Veuillez renseigner votre prénom';
            } else {
                $firstName = $_POST['first_name'];
                $vm['firstName'] = $firstName;

                if (strlen($firstName) < 2 || strlen($firstName) >= 30) {
                    $vm['errors']['firstName'] = 'Votre prénom doit faire entre 2 et 30 caractères';
                }
            }

            if (empty($_POST['last_name'])) {
                $vm['errors']['lastName'] = 'Veuillez renseigner votre nom de famille';
            } else {
                $lastName = $_POST['last_name'];
                $vm['lastName'] = $lastName;

                if (strlen($lastName) < 2 || strlen($lastName) >= 40) {
                    $vm['errors']['lastName'] = 'Votre nom de famille doit faire entre 2 et 40 caractères';
                }
            }

            if (empty($_POST['email'])) {
                $vm['errors']['email'] = 'Veuillez renseigner votre email';
            } else {
                $email = str_replace(array("\n", "\r", PHP_EOL), '', $_POST['email']);
                $vm['email'] = $email;

                if (strlen($email) < 6 || strlen($lastName) >= 50) {
                    $vm['errors']['email'] = 'Votre email doit faire entre 6 et 50 caractères';
                }
            }

            if (empty($_POST['message'])) {
                $vm['errors']['message'] = 'Veuillez renseigner le corps du mail';
            } else {
                $message = $_POST['message'];
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

    public
    static function validateAction()
    {
        self::renderTemplate('message-sent.twig');
    }
}
