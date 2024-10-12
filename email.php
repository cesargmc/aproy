<?php
    // Configuración SMTP para Mailtrap
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'path/to/PHPMailer/src/Exception.php';
    require 'path/to/PHPMailer/src/PHPMailer.php';
    require 'path/to/PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';  // Servidor SMTP de Mailtrap
        $mail->SMTPAuth = true;
        $mail->Username = '650a67d9d9bb10'; // Usuario SMTP
        $mail->Password = 'b5060909a4cd15'; // Contraseña SMTP
        $mail->Port = 2525;

        // Configuración del email
        $mail->setFrom('noreply@tu-dominio.com', 'Soporte Técnico');
        $mail->addAddress($email); // Correo del destinatario

        // Contenido del email
        $mail->isHTML(true);
        $mail->Subject = 'Confirma tu cuenta';
        $mail->Body = "Haz click en el siguiente enlace para confirmar tu cuenta: <a href='$url'>Confirmar cuenta</a>";

        // Enviar el email
        $mail->send();
        echo 'El mensaje ha sido enviado';

    } catch (Exception $e) {
        echo "Error al enviar el email: {$mail->ErrorInfo}";
    }
