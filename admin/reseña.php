<?php
    session_start();

    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit();
    }

    // Verificar el rol del usuario
    $admin = $_SESSION['usuario']['admin'];
    if ($admin != 1) {
        // El usuario no es administrador
        header("Location: ../public/index.php");
        exit();
    }

    // Importar la conexion
    require '../includes/config/database.php';
    $db = conectarDB();

    // Eliminar mensaje
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_mensaje = $_POST['id']; // Obtén el ID del mensaje a eliminar
    
        // Consulta para eliminar el mensaje
        $query_eliminar = "DELETE FROM Mensaje WHERE id = ?";
        $stmt = mysqli_prepare($db, $query_eliminar);
        mysqli_stmt_bind_param($stmt, "i", $id_mensaje);
        mysqli_stmt_execute($stmt);
        
        // Verifica si se eliminó correctamente
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            header('Location: /admin/reseña.php?resultado=1');
        } else {
            header('Location: /admin/reseña.php?resultado=2');
        }
    
        mysqli_stmt_close($stmt);
    }

    $query = "
    SELECT 
        Mensaje.*, 
        usuario.nombre AS nombre_usuario, 
        usuario.apellido AS apellido_usuario, 
        viajes.titulo AS titulo_viaje 
    FROM Mensaje 
    JOIN usuario ON Mensaje.id_usuario = usuario.id 
    JOIN viajes ON Mensaje.id_viaje = viajes.id";

    // Consultar la BD
    $resultado = mysqli_query($db, $query);

    require '../includes/funciones.php';
    incluirTemplate('headerAdmin', $inicio = true);
?>

    <main class="contenedor">
        <section class="mensajes-admin">

            <?php if(intval($resultado) === 1): ?>
                <p class="alerta exito">Mensaje eliminado correctamente.</p>
            <?php elseif (intval($resultado) === 2): ?>
                <p class="alerta exito">Error al eliminar el mensaje. Inténtalo de nuevo.</p>
            <?php endif; ?>

            <div class="admin__mensaje">
                <?php while($row = mysqli_fetch_assoc($resultado) ) : ?>
                    <div class="box">
                        <h3 class="cuadro__titulo"><?php echo $row['titulo_viaje']; ?></h3>

                        <div class="comentario">
                            <p class="usuario"><?php echo $row['nombre_usuario'] . ' ' . $row['apellido_usuario']; ?></p>
                            <p><?php echo $row['comentario']; ?></p>
                        </div>

                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input class="boton eliminar" type="submit" value="Eliminar">
                        </form>
                    </div><!-- cuadro -->
                <?php endwhile; ?>
            </div>
        </section>
    </main>

<?php 
    // Cerrar la conexion
    mysqli_close($db);

    incluirTemplate('footer');
?>