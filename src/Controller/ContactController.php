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
    public static function showAction()
    {
        self::renderTemplate('contact.twig');
    }

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
            $email = $_POST['email'];
            $message = $_POST['message'];

            $transport = (new Swift_SmtpTransport(Parameters::$mail_host, Parameters::$mail_port, 'ssl'))
                ->setUsername(Parameters::$mail_username)
                ->setPassword(Parameters::$mail_password);

            $mailer = new Swift_Mailer($transport);

            $message = (new Swift_Message('Blog: Nouveau message'))
                ->setFrom([$email => $firstName .' '. $lastName])
                ->setTo([Parameters::$mail_username => Parameters::$mail_receiver])
                ->setBody($message);

            $result = $mailer->send($message);

            if ($result) {
                self::redirect('contact/success');
            }
        }
    }

    public static function validateAction()
    {
        self::renderTemplate('message-sent.twig');
    }
}
