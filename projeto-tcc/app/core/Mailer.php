<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__.'/../libraries/PHPMailer/src/Exception.php';
require_once __DIR__.'/../libraries/PHPMailer/src/PHPMailer.php';
require_once __DIR__.'/../libraries/PHPMailer/src/SMTP.php';
class Mailer
{
    public static function enviar($destinatario, $assunto, $mensagem)
    {
        $mail = new PHPMailer(true);

        try{

            $mail->isSMTP();

            $mail->Host = 'smtp.gmail.com';

            $mail->SMTPAuth = true;

            $mail->Username = 'sistemaescolar.tcc@gmail.com';

            $mail->Password = 'nbtc nmkm dojm nvhh';

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            $mail->Port = 587;

            $mail->setFrom('sistemaescolar.tcc@gmail.com','Sistema Escolar');

            $mail->addAddress($destinatario);

            $mail->isHTML(true);

            $mail->Subject = $assunto;

            $mail->Body = $mensagem;

            $mail->send();

            return true;

        }catch(Exception $e){

    throw new Exception($mail->ErrorInfo);

        }
    }
}