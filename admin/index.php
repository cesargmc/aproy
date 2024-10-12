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
        header("Location: ../index.php");
        exit();
    }

    // Importar la conexion
    require '../includes/config/database.php';
    $db = conectarDB();

    // Escribir el Query
    $query = "SELECT * FROM Viajes";

    // Consultar la BD
    $resultadoConsulta = mysqli_query($db, $query);

    // Muostrar mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {
            // Eliminar imagen
            $query = "SELECT imagen FROM Viajes WHERE id = $id";

            $resultado = mysqli_query($db, $query);
            $viaje = mysqli_fetch_assoc($resultado);

            unlink('../imagenes/' . $viaje['imagen']);

            $query = "DELETE FROM Viajes WHERE id = $id";
            $resultado = mysqli_query($db, $query);

            if($resultado) {
                header('Location: /admin?resultado=3');
            }
        }
    }

    require '../includes/funciones.php';
    $adminPagina = true;
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Miry's</h1>

        <?php if(intval($resultado) === 1): ?>
            <p class="alerta exito">Viaje agregado correctamente</p>
        <?php elseif (intval($resultado) === 2): ?>
            <p class="alerta exito">Viaje actualizado correctamente</p>
        <?php elseif (intval($resultado) === 3): ?>
            <p class="alerta exito">Viaje eliminado correctamente</p>
        <?php endif; ?>

        <a href="/admin/viajes/crear.php" class="boton boton-verde">Nuevo Viaje</a>

        <table class="viajes">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Salida</th>
                    <th>Regreso</th>
                    <th></th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los Resultados -->
                <?php while( $viaje = mysqli_fetch_assoc($resultadoConsulta) ): ?>
                <tr>
                    <td><?php echo $viaje['id']; ?></td>
                    <td><?php echo $viaje['titulo']; ?></td>
                    <td> <img class="imagen-tabla" src="/imagenes/<?php echo $viaje['imagen']; ?>" alt=""> </td>
                    <td><?php echo $viaje['salida']; ?></td>
                    <td><?php echo $viaje['regreso']; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $viaje['id']; ?>">
                            <input type="submit" class="boton boton-gris-block" value="Eliminar">
                        </form>
                        <a class="boton boton-naranja-block" href="/admin/viajes/actualizar.php?id=<?php echo $viaje['id'] ?>">Actualizar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

<?php 
    // Cerrar la conexion
    mysqli_close($db);

    incluirTemplate('footer');
?>