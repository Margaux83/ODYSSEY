<?php

namespace App\Core;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require('vendor/autoload.php');

class Mailer
{
    public function sendMail($firstname, $name, $email, $object, $body) {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = MAILUSER;                     //SMTP username
            $mail->Password   = MAILPWD;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('contact@odyssey.com', 'Odyssey Mailer');
            $mail->addAddress($email, "$firstname $name");     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $object;
            $mail->Body    = "$body";

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'qzdqz';
        }
    }
}