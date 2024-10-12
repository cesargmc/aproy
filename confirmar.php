<?php
require 'includes/config/database.php';
$db = conectarDB();

// Obtener el token desde la URL
$token = $_GET['token'];

if (!$token) {
    header('Location: /');
    exit();
}

// Verificar si el token existe en la base de datos
$query = "SELECT id, confirmado FROM Usuario WHERE token = '$token' LIMIT 1";
$resultado = mysqli_query($db, $query);

if ($resultado && mysqli_num_rows($resultado) === 1) {
    $usuario = mysqli_fetch_assoc($resultado);

    // Verificar si la cuenta ya ha sido confirmada
    if ($usuario['confirmado'] == 1) {
        echo "Esta cuenta ya ha sido confirmada.";
    } else {
        // Actualizar el estado a 'confirmado'
        $query = "UPDATE Usuario SET confirmado = 1, token = '' WHERE id = " . $usuario['id'];
        mysqli_query($db, $query);
    }
} else {
    echo "Token no válido o ya utilizado.";
}

    require 'includes/funciones.php';
    incluirTemplate('header', $inicio = false);
?>

<main class="contenedor-acciones">
    <h1>Cuenta Confirmada Exitosamente</h1>
    <p>¡Tu cuenta ha sido confirmada exitosamente! Inicia Sesión</p>
</main>

<?php incluirTemplate('footer'); ?>

    <script src="build/js/app.js"></script>
    <script src="build/js/modernizr.js"></script>
    <script src="build/js/swiper.js"></script>
</body>
</html>