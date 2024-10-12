<?php
    // Base de datos
    require 'includes/config/database.php';
    $db = conectarDB();

    // Configuración SMTP para Mailtrap
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/PHPMailer/PHPMailer/src/Exception.php';
    require 'vendor/PHPMailer/PHPMailer/src/PHPMailer.php';
    require 'vendor/PHPMailer/PHPMailer/src/SMTP.php';

    // Arreglo de errores
    $errores = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        if (!$email) {
            $errores[] = "El email es obligatorio.";
        }

        // Verificar si el email existe en la base de datos
        $query = "SELECT * FROM Usuario WHERE email = '$email'";
        $resultado = mysqli_query($db, $query);

        if ($resultado->num_rows) {
            // El usuario existe, generar un token
            $usuario = mysqli_fetch_assoc($resultado);
            $token = bin2hex(random_bytes(5));

            // Almacenar el token en la base de datos con expiración de 1 hora
            $query = "UPDATE Usuario SET token = '$token', expiracion_token = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = '$email'";

            $resultado_token = mysqli_query($db, $query);

            if ($resultado_token) {
                // Enviar el correo con el enlace de restablecimiento
                $url = "http://localhost:3000/reestablecer.php?token=" . $token;

                $mail = new PHPMailer(true);

                try {
                    // Configuración del servidor SMTP
                    $mail->isSMTP();
                    $mail->Host = 'smtp.mailtrap.io';
                    $mail->SMTPAuth = true;
                    $mail->Username = '650a67d9d9bb10'; // Usuario SMTP
                    $mail->Password = 'b5060909a4cd15'; // Contraseña SMTP
                    $mail->Port = 2525;

                    // Configuración del email
                    $mail->setFrom('noreply@mirys.com', 'Restablece tu password');
                    $mail->addAddress($email);

                    // Contenido del email
                    $mail->isHTML(true);
                    $mail->Subject = 'Restablece tu password';
                    $mail->Body = "Haz click en el siguiente enlace para restablecer tu password: <a href='$url'>Restablecer password</a>";

                    // Enviar el correo
                    $mail->send();

                    // Redirigir al usuario a la página de mensaje
                    header("Location: mensaje.php?resultado=2");
                    exit();

                } catch (Exception $e) {
                    echo "Error al enviar el email: {$mail->ErrorInfo}";
                }
            }
        } else {
            $errores[] = "El email no está registrado.";
        }
    }

    // Incluye el header
    require 'includes/funciones.php';
    incluirTemplate('headerAcciones');
?>

<main class="contenedor-acciones">
    <div class="login">
        <h1>Olvidé mi Contraseña</h1>

        <?php foreach ($errores as $error): ?>
            <div class="alerta error"><?php echo $error; ?></div>
        <?php endforeach; ?>

        <form method="POST" class="formulario acciones">
            <fieldset>
                <p class="comentario">Reestablece tu contraseña escribiendo tu email a continuación</p>
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Tu email" id="email" required>
            </fieldset>

            <input type="submit" value="Enviar Instrucciones" class="boton boton-verde">
        </form>

        <div class="enlaces-acciones">
            <a href="login.php">¿Ya tienes una cuenta? Inicia Sesión</a>
            <a href="signup.php">¿Aún no tienes una cuenta? Crea una</a>
        </div>
    </div>
</main>
