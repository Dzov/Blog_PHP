<?php

namespace Blog\Controller;

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
        if (isset($_POST['submit']))
        {
            $to = "amelie2360@gmail.com";
            $from = $_POST['email'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $subject = "Quelqu'un souhaite vous contacter";
            $subject2 = "Votre message a bien été envoyé";
            $message = "Message de la part de " . $first_name . " " . $last_name . ": " . "\n\n" . $_POST['message'];
            $message2 = "Voici une copie de votre message: " . "\n\n" . $_POST['message'];

            $headers = "From:" . $from;
            $headers2 = "From:" . $to;
            mail($to,$subject,$message,$headers);
            mail($from,$subject2,$message2,$headers2);

            self::redirect('contact/success');
        }
    }

    public static function validateAction()
    {
        self::renderTemplate('message-sent.twig');
    }
}
