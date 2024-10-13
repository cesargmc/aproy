<?php
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /');
    }

    // Importar la conexion
    require '../includes/config/database.php';
    $db = conectarDB();

    // Consultar
    $query = "SELECT * FROM Viajes WHERE id = $id";
    $queryPrecios = "SELECT * FROM PreciosHabitacion WHERE id_viaje = $id";
    $queryActividades = "SELECT * FROM Actividades WHERE id_viaje = $id";

    // Obtener resultado
    $resultado = mysqli_query($db, $query);
    $resultadoPrecios = mysqli_query($db, $queryPrecios);
    $resultadoActividades = mysqli_query($db, $queryActividades);

    // Assoc 
    $viaje = mysqli_fetch_assoc($resultado);

    $precios = [];
    while ($filaPrecios = mysqli_fetch_assoc($resultadoPrecios)) {
        $precios[$filaPrecios['tipo_habitacion']] = $filaPrecios['precio'];
    }

    $actividades = [];
    while ($filaActividad = mysqli_fetch_assoc($resultadoActividades)) {
        $actividades[] = [
            'nombre' => $filaActividad['nombre_actividad'],
            'precio' => $filaActividad['precio']
        ];
    }

    // Redireccion en caso de que no exista el Id
    if(!$resultado->num_rows) {
        header('Location: public/index.php');
    }

    require '../includes/funciones.php';
    incluirTemplate('headerViajes', $inicio = true);
?>
    <main class="contenedor">
        <section clase="viaje">
            <h2><?php echo $viaje['titulo']; ?></h2>

            <div class="viaje-contenido">
                <img class="viajes__img" loading="lazy" src="../imagenes/<?php echo $viaje['imagen']; ?>" alt="Imagen viaje">

                <ul class="contenido-lista no-padding">
                    <li class="lista__informacion">
                        <div class="lista__descripcion">
                            <h3>SALIDA Y REGRESO</h3>
                            <p>Del <?php echo $viaje['salida']; ?> al <?php echo $viaje['regreso']; ?></p>
                            <p><?php echo $viaje['dias_noches']; ?></p>
                        </div>
                    </li>
                    <li class="lista__informacion">
                        <div class="lista__descripcion">
                            <h3>PRECIO POR PERSONA</h3>
                            <?php if (isset($precios['Doble'])): ?>
                                <p><?php echo $precios['Doble']; ?> p/p habitación doble</p>
                            <?php endif; ?>

                            <?php if (isset($precios['Triple'])): ?>
                                <p><?php echo $precios['Triple']; ?> p/p habitación triple</p>
                            <?php endif; ?>

                            <?php if (isset($precios['Cuadruple'])): ?>
                                <p><?php echo $precios['Cuadruple']; ?> p/p habitación cuádruple</p>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li class="lista__informacion">
                        <div class="lista__descripcion">
                            <h3>ACTIVIDADES</h3>
                            <?php foreach ($actividades as $actividad): ?>
                                <div class="actividades">
                                    <p class="actividades-p"><?php echo htmlspecialchars($actividad['nombre']); ?> - <span class="actividades=p">$<?php echo htmlspecialchars($actividad['precio']); ?></span></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </li>
                    <li class="lista__informacion">
                        <div class="lista__descripcion">
                            <h3>AVISOS</h3>
                            <p><?php echo $viaje['avisos']; ?></p>
                        </div>
                    </li>
                    <li class="lista__informacion">
                        <div class="lista__descripcion">
                            <h3>LUGAR DE SALIDA</h3>
                            <p><?php echo $viaje['lugar_salida']; ?></p>
                        </div>
                    </li>
                </ul>
            </div>

            <a class="boton btn-viaje" href="https://wa.me/8112586422?text=Hola,%20me%20gustaría%20saber%20más%20sobre%20el%20viaje.%0Ahttps://mirys.vercel.app/real14.html" target="_blank">Separa tu lugar</a>
        </section>
    </main>
    
    <?php incluirTemplate('footer'); ?>

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
    <script src="../build/js/modernizr.js"></script>
    <script src="../build/js/swiper.js"></script>
</body>
</html>

<?php
    // Cerrar la conexion
    mysqli_close($db);
?>