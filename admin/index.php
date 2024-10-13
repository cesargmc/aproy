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
    incluirTemplate('headerAdmin', $inicio = true);
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

        <section class="viajes">
            <table>
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
                        <td class="tabla-crud">
                            <form method="POST">
                                <input type="hidden" name="id" value="<?php echo $viaje['id']; ?>">
                                <button type="submit" class="boton eliminar">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="25px" height="25px" fill="rgba(12,59,46,1)"><path d="M7 4V2H17V4H22V6H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V6H2V4H7ZM6 6V20H18V6H6ZM9 9H11V17H9V9ZM13 9H15V17H13V9Z"></path></svg>
                                </button>
                            </form>
                            <a class="boton actualizar" href="/admin/viajes/actualizar.php?id=<?php echo $viaje['id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="25px" height="25px" fill="rgba(12,59,46,1)"><path d="M5 18.89H6.41421L15.7279 9.57627L14.3137 8.16206L5 17.4758V18.89ZM21 20.89H3V16.6473L16.435 3.21231C16.8256 2.82179 17.4587 2.82179 17.8492 3.21231L20.6777 6.04074C21.0682 6.43126 21.0682 7.06443 20.6777 7.45495L9.24264 18.89H21V20.89ZM15.7279 6.74785L17.1421 8.16206L18.5563 6.74785L17.1421 5.33363L15.7279 6.74785Z"></path></svg>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </main>

<?php 
    // Cerrar la conexion
    mysqli_close($db);

    incluirTemplate('footer');
?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            menu();
        })
        
        function toggleMenu() {
            document.body.classList.toggle('open');
        }

        function closeMenu() {
            document.body.classList.remove('open');
        }

        function menu() {
            const menuButton = document.querySelector('.menu');
            const overlay = document.querySelector('.overlay');

            menuButton.addEventListener('click', toggleMenu);

            overlay.addEventListener('click', closeMenu);
        }
    </script>