<?php

    use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};

    class Mailer{

        function enviarEmail($email, $asunto, $cuerpo){
            require_once 'config.php';
            require './phpmailer/src/PHPMailer.php';
            require './phpmailer/src/SMTP.php';
            require './phpmailer/src/Exception.php';

            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_OFF;
                $mail->isSMTP();
                $mail->Host       = MAIL_HOST; 
                $mail->SMTPAuth   = true; 
                $mail->Username   = MAIL_USER; //CORREO DE PRUEBA, SE CAMBIAN EN config.php
                $mail->Password   = MAIL_PASS;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = MAIL_PORT;

                //Emisor
                $mail->setFrom(MAIL_USER, 'Viajes Mirys');
                //Receptor
                $mail->addAddress($email);
                
                //Content
                $mail->isHTML(true);
                $mail->Subject = $asunto;

                $mail->Body    = utf8_decode($cuerpo);

                $mail->setLanguage('es', '../phpmailer/language/phpmailer.lang-es.php');

                if($mail->send()){
                    return true;
                } else {
                    return false;
                }


            } catch (Exception $e) {
                echo "Error al enviar el correo electronico: {$mail->ErrorInfo}";
                return false;
            }
        }

    }

?>