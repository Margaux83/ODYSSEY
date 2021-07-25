<?php

namespace App\Core;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require('vendor/autoload.php');

class Mailer
{
    /**
     * @param $firstname
     * @param $name
     * @param $email
     * @param $object
     * @param $body
     * Function to send an email to a user using PHPMailer
     * With ther SMTP server settings
     * With the creation of the header, object and body of the mail
     */
    public function sendMail($firstname, $name, $email, $object, $body) {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = MAILUSER;                               //SMTP username
            $mail->Password   = MAILPWD;                                //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('contact@odyssey.com', 'Odyssey Mailer');
            $mail->addAddress($email, "$firstname $name");        //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $object;
            $mail->Body    = "$body";

            $mail->send();
            return;
        } catch (Exception $e) {
            return;
        }
    }
}