<?php

namespace Petshop\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Petshop\Core\Exception as PetshopException;

class SendMail
{
    public static function enviar(string $paraNome, string $paraEmail, string $assunto, string $mensagem, string $replyToName='', string $replyToEmail='')
    {

        //Cria uma instância e habilita as excessões (true)
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();  
            $mail->Host = MAIL_HOST;                  
            $mail->SMTPAuth = true;                           
            $mail->Username = MAIL_USER;               
            $mail->Password = MAIL_PASS;                     
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     
            $mail->Port = MAIL_PORT;                                   

            //Recipients
            $mail->setFrom(MAIL_USER, MAIL_NAME);

            $mail->addAddress($paraEmail, $paraNome);     

            if ($replyToName && $replyToEmail) {
                $mail->addReplyTo($replyToEmail, $replyToName);
            }
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');   

            //Content
            $mail->isHTML(true);                                  
            $mail->Subject = $assunto;
            $mail->Body    = $mensagem;
            $mail->AltBody = 'Esta mensagem esta formatada com HTML, abra no navegador';

            if (!$mail->send()) {
                error_log('Erro de e-mail: ' . $mail->ErrorInfo);
                throw new PetshopException('Erro ao enviar a mensagem, tente novamente mais tarde');
            }
            return true;
        } catch (Exception $e) {
            error_log('Erro de e-mail: ' . $mail->ErrorInfo);
            throw new PetshopException('Erro do processo de envio de mensagem');
        }
    }
}
