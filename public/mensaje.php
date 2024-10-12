<?php
    // Muostrar mensaje condicional
    $resultado = $_GET['resultado'] ?? null;
    
    require '../includes/funciones.php';
    incluirTemplate('header');
?>

<?php if(intval($resultado) === 1): ?>
    <main class="contenedor-acciones">
        <h1>Cuenta Creada Exitosamente</h1>
        <p>Te hemos enviado un correo electrónico para confirmar tu cuenta. Por favor, revisa tu bandeja de entrada y sigue las instrucciones para activar tu cuenta.</p>
    </main>
<?php elseif (intval($resultado) === 2): ?>
    <main class="contenedor-acciones">
        <h1>Correo Enviado Exitosamente</h1>
        <p>Te hemos enviado un correo electrónico para reestablecer tu contraseña. Por favor, revisa tu bandeja de entrada y sigue las instrucciones para reestablecerla.</p>
    </main>
<?php endif; ?>

<?php incluirTemplate('footer'); ?>

    <script src="build/js/app.js"></script>
    <script src="build/js/modernizr.js"></script>
    <script src="build/js/swiper.js"></script>
</body>
</html>