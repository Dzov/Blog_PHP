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
        if (isset($_POST['submit']) &&
            isset($_POST['first_name']) &&
            isset($_POST['last_name']) &&
            isset($_POST['email']) &&
            isset($_POST['message'])
        ) {
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $email = str_replace(array("\n", "\r", PHP_EOL), '', $_POST['email']);
            $message = $_POST['message'];

            if (strlen($firstName) < 2 || strlen($firstName) >= 30) {
                $_SESSION['errors'][] = 'Votre prénom doit faire entre 2 et 30 caractères';
            }
            if (strlen($lastName) < 2 || strlen($lastName) >= 40) {
                $_SESSION['errors'][] = 'Votre nom de famille doit faire entre 2 et 40 caractères';
            }
            if (strlen($email) < 6 || strlen($lastName) >= 50) {
                $_SESSION['errors'][] = 'Votre email doit faire entre 6 et 50 caractères';
            }
            if (strlen($message) < 5) {
                $_SESSION['errors'][] = 'Votre message doit contenir au moins 5 caractères';
            }

            if (!isset($_SESSION['errors'])) {
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
            }
        }

        self::renderTemplate('contact.twig');
    }

    public static function validateAction()
    {
        self::renderTemplate('message-sent.twig');
    }
}
