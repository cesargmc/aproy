<?php
    // Base de datos
    require '../includes/config/database.php';
    $db = conectarDB();
    $errores = [];

    // Verificar si el token existe
    $token = $_GET['token'] ?? '';

    if (!$token) {
        header('Location: login.php');
    }

    // Verificar que el token sea válido y no haya expirado
    $query = "SELECT * FROM Usuario WHERE token = '$token' AND expiracion_token > NOW()";
    $resultado = mysqli_query($db, $query);

    if ($resultado->num_rows === 0) {
        $errores[] = "Token no válido o expirado.";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $password_confirm = mysqli_real_escape_string($db, $_POST['password_confirm']);

        if (empty($password) || empty($password_confirm)) {
            $errores[] = "Debes ingresar ambas contraseñas.";
        } elseif ($password !== $password_confirm) {
            $errores[] = "Las contraseñas no coinciden.";
        } else {
            // Hashear la nueva contraseña
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            // Actualizar el usuario con la nueva contraseña y eliminar el token
            $query = "UPDATE Usuario SET password = '$password_hash', token = NULL, expiracion_token = NULL WHERE token = '$token'";
            $resultado_update = mysqli_query($db, $query);

            if ($resultado_update) {
                header('Location: login.php');
            }
        }
    }

    require '../includes/funciones.php';
    incluirTemplate('header');
?>

<main class="contenedor-acciones">
    <div class="login">
        <h1>Restablecer Contraseña</h1>

        <?php foreach ($errores as $error): ?>
            <div class="alerta error"><?php echo $error; ?></div>
        <?php endforeach; ?>

        <form method="POST" class="formulario acciones">
            <fieldset>
                <div class="password-container">
                    <input type="password" name="password" placeholder="Tu nueva contraseña" id="password" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                        <!-- Ícono de contraseña oculta -->
                        <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M9.34268 18.7819L7.41083 18.2642L8.1983 15.3254C7.00919 14.8874 5.91661 14.2498 4.96116 13.4534L2.80783 15.6067L1.39362 14.1925L3.54695 12.0392C2.35581 10.6103 1.52014 8.87466 1.17578 6.96818L3.14386 6.61035C3.90289 10.8126 7.57931 14.0001 12.0002 14.0001C16.4211 14.0001 20.0976 10.8126 20.8566 6.61035L22.8247 6.96818C22.4803 8.87466 21.6446 10.6103 20.4535 12.0392L22.6068 14.1925L21.1926 15.6067L19.0393 13.4534C18.0838 14.2498 16.9912 14.8874 15.8021 15.3254L16.5896 18.2642L14.6578 18.7819L13.87 15.8418C13.2623 15.9459 12.6376 16.0001 12.0002 16.0001C11.3629 16.0001 10.7381 15.9459 10.1305 15.8418L9.34268 18.7819Z"></path>
                        </svg>

                        <!-- Ícono de contraseña visible -->
                        <svg id="eyeOpen" style="display: none;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3ZM12.0003 19C16.2359 19 19.8603 16.052 20.7777 12C19.8603 7.94803 16.2359 5 12.0003 5C7.7646 5 4.14022 7.94803 3.22278 12C4.14022 16.052 7.7646 19 12.0003 19ZM12.0003 16.5C9.51498 16.5 7.50026 14.4853 7.50026 12C7.50026 9.51472 9.51498 7.5 12.0003 7.5C14.4855 7.5 16.5003 9.51472 16.5003 12C16.5003 14.4853 14.4855 16.5 12.0003 16.5ZM12.0003 14.5C13.381 14.5 14.5003 13.3807 14.5003 12C14.5003 10.6193 13.381 9.5 12.0003 9.5C10.6196 9.5 9.50026 10.6193 9.50026 12C9.50026 13.3807 10.6196 14.5 12.0003 14.5Z"></path>
                        </svg>
                    </span>
                </div>

                <label for="password_confirm">Confirmar Contraseña</label>
                <input type="password" name="password_confirm" placeholder="Confirma tu nueva contraseña" id="password_confirm" required>
            </fieldset>

            <input type="submit" value="Restablecer Contraseña" class="boton boton-verde">
        </form>
    </div>
</main>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeOpen.style.display = 'inline';
            eyeClosed.style.display = 'none';
        } else {
            passwordInput.type = 'password';
            eyeOpen.style.display = 'none';
            eyeClosed.style.display = 'inline';
        }
    }
</script>