<?php
namespace App\Http\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use System\Config\Config;

class MailServise 
{
    public static function send($address,$subject,$body)
    {
        $mail = new Phpmailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = Config::get('mail.SMTP.host');                     //Set the SMTP server to send through
            $mail->SMTPAuth   = Config::get('mail.SMTP.SMTPAUTH');                                   //Enable SMTP authentication
            $mail->Username   = Config::get('mail.SMTP.Username');                     //SMTP username
            $mail->Password   = Config::get('mail.SMTP.Password');                               //SMTP password
            $mail->SMTPSecure = Config::get('mail.SMTP.SMTPSecure');            //Enable implicit TLS encryption
            $mail->Port       = Config::get('mail.SMTP.Port');                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom(Config::get('mail.SMTP.setFrom.mail'), Config::get('mail.SMTP.setFrom.name'));
            $mail->addAddress($address);     //Add a recipient
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
        
            $result = $mail->send();
            return $result;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}