<?php
    // Importar la conexion
    require '../includes/config/database.php';
    $db = conectarDB();

    session_start();

    // Consultar
    $query = "SELECT * FROM Viajes";

    // Obtener resultado
    $resultado = mysqli_query($db, $query);

    $queryMensaje = "
    SELECT 
        Mensaje.*, 
        usuario.nombre AS nombre_usuario, 
        usuario.apellido AS apellido_usuario, 
        viajes.titulo AS titulo_viaje 
    FROM Mensaje 
    JOIN usuario ON Mensaje.id_usuario = usuario.id 
    JOIN viajes ON Mensaje.id_viaje = viajes.id";

    // Consultar la BD
    $resultadoMensaje = mysqli_query($db, $queryMensaje);

    // Verifica si la consulta fue exitosa
    if (!$resultado) {
        die("Error en la consulta: " . mysqli_error($db));
    }

    // Almacena los viajes en un array
    $viajes = [];
    while ($viaje = mysqli_fetch_assoc($resultado)) {
        $viajes[] = $viaje;
    }

    // Arreglo errores
    $errores = [];

    $comentario = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Verificar si el usuario está logueado
        if (isset($_SESSION['usuario'])) {
            $id_usuario = $_SESSION['usuario']['id'];
            $id_viaje = $_POST['id_viaje'];
            $comentario = $_POST['comentario'];

            if(!$comentario) {
                $errores[] = "El comentario es obligatoria";
            }
    
            // Validar el límite de caracteres
            if (strlen($comentario) > 250) {
                header('Location: /public/index.php?resultado=4'); // Aquí puedes redirigir a un resultado de error específico
                exit;
            }
    
            // Insertar la reseña en la base de datos
            $query = "INSERT INTO mensaje (id_viaje, id_usuario, comentario) VALUES (?, ?, ?)";
            $stmt = $db->prepare($query);
            if (!$stmt) {
                die("Error en la preparación de la consulta: " . mysqli_error($db));
            }
            
            $stmt->bind_param('iis', $id_viaje, $id_usuario, $comentario);
            
            if ($stmt->execute()) {
                header('Location: /public/index.php?resultado=3');
            } else {
                header('Location: /public/index.php?resultado=2');
            }
            
            $stmt->close();
        } else {
            header('Location: /public/index.php?resultado=1');
        }
    }    

    require '../includes/funciones.php';
    incluirTemplate('header', $inicio = true);
?>

    <main class="contenedor">
        <section id="servicios" class="servicio texto-centrado">
            <h2>Mis Servicios</h2>

            <p class="servicios__texto">
                Ofrecemos servicio de transporte de ida y vuelta, con una coordinadora que se encargará de los paseos y traslados durante todo el viaje. Disfruta de snacks mientras te desplazas, y al final del recorrido, participa en una rifa especial para nuestros viajeros.
            </p>

            <div class="servicios">
                <div class="servicios__contenido">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bed" width="60" height="60" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6d9773" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M3 7v11m0 -4h18m0 4v-8a2 2 0 0 0 -2 -2h-8v6" />
                        <path d="M7 10m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                    </svg>
    
                    <h3>Hospedaje</h3>
                    <p>Disfruta de una estancia sin preocupaciones en nuestros hoteles seleccionados. Todo lo que necesitas hacer es llegar, y nosotros nos encargaremos del resto.</p>
                </div><!-- servicios__contenido -->

                <div class="border"></div>

                <div class="servicios__contenido">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bus" width="60" height="60" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6d9773" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M6 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M18 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M4 17h-2v-11a1 1 0 0 1 1 -1h14a5 7 0 0 1 5 7v5h-2m-4 0h-8" />
                        <path d="M16 5l1.5 7l4.5 0" />
                        <path d="M2 10l15 0" />
                        <path d="M7 5l0 5" />
                        <path d="M12 5l0 5" />
                    </svg>
    
                    <h3>Transporte</h3>
                    <p>Viaja cómodamente en nuestros autobuses climatizados, que ofrecen un recorrido redondo con todas las comodidades baños a bordo y paradas programadas para estirar las piernas y disfrutar de un refrigerio.</p>
                </div><!-- servicios__contenido -->

                <div class="border"></div>

                <div class="servicios__contenido">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shield-lock" width="60" height="60" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6d9773" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3" />
                        <path d="M12 11m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        <path d="M12 12l0 2.5" />
                    </svg>
    
                    <h3>Seguro de Viaje</h3>
                    <p>Tu seguridad es nuestra prioridad. Por eso, todos nuestros viajeros cuentan con un seguro de viaje mientras están a bordo de nuestras unidades, para que disfrutes del viaje con total tranquilidad.</p>
                </div><!-- servicios__contenido -->
            </div>
        </section><!-- SERVICIO -->

        <section id="viajes" class="catalogo">
            <h2 class="texto-centrado">Próximos Viajes</h2>

            <div class="seccion">
            <?php foreach($viajes as $viaje): ?>
                <div class="seccion__contenido">
                    <div class="seccion-info">
                        <h3><?php echo $viaje['titulo']; ?></h3>
                        <div class="fechas">
                            <div class="salida">
                                <p class="label-fecha">Salida <span class="fecha"><?php echo $viaje['salida']; ?></span></p>
                            </div>
                            <div class="regreso">
                                <p class="label-fecha">Regreso <span class="fecha"><?php echo $viaje['regreso']; ?></span></p>
                            </div>
                        </div>
                        <p class="descripcion"><?php echo $viaje['descripcion']; ?></p>
                        <div class="botones">
                            <a class="boton btn-viaje" href="https://wa.me/8112586422?text=Hola,%20me%20gustaría%20saber%20más%20sobre%20el%20viaje.%0Ahttps://mirys.vercel.app/real14.html" target="_blank">Reserva <?php echo $viaje['titulo']; ?></a>
                            <a href="viaje.php?id=<?php echo $viaje['id']; ?>" class="boton contacto">Ver más</a>
                        </div>
                    </div>
                    <img class="seccion__img" loading="lazy" src="/imagenes/<?php echo $viaje['imagen'] ?>" alt="Imagen viaje">
                </div>
            <?php endforeach; ?>
            </div>
        </section><!-- VIAJES -->

        <section id="reseñas" class="resenas">
            <h2 class="texto-centrado">Reseñas</h2>

            <div class="contenedor-resena">
                <div class="resena mySwiper">
                    <div class="resena-contenido swiper-wrapper">
                        <?php while($row = mysqli_fetch_assoc($resultadoMensaje) ) : ?>
                            <div class="slide swiper-slide">
                                <div class="informacion">
                                    <div class="informacion-contenido">
                                        <div class="contenido-usuario">
                                            <span class="nombre"><?php echo $row['nombre_usuario'] . ' ' . $row['apellido_usuario']; ?></span>
                                            <span class="experiencia"><?php echo $row['titulo_viaje']; ?></span>
                                        </div>

                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30" fill="rgba(109,151,115,1)">
                                            <path d="M4.58341 17.3211C3.55316 16.2274 3 15 3 13.0103C3 9.51086 5.45651 6.37366 9.03059 4.82318L9.92328 6.20079C6.58804 8.00539 5.93618 10.346 5.67564 11.822C6.21263 11.5443 6.91558 11.4466 7.60471 11.5105C9.40908 11.6778 10.8312 13.159 10.8312 15C10.8312 16.933 9.26416 18.5 7.33116 18.5C6.2581 18.5 5.23196 18.0095 4.58341 17.3211ZM14.5834 17.3211C13.5532 16.2274 13 15 13 13.0103C13 9.51086 15.4565 6.37366 19.0306 4.82318L19.9233 6.20079C16.588 8.00539 15.9362 10.346 15.6756 11.822C16.2126 11.5443 16.9156 11.4466 17.6047 11.5105C19.4091 11.6778 20.8312 13.159 20.8312 15C20.8312 16.933 19.2642 18.5 17.3312 18.5C16.2581 18.5 15.232 18.0095 14.5834 17.3211Z"></path>
                                        </svg>
                                    </div>

                                    <p><?php echo $row['comentario']; ?></p>
                                </div>
                            </div><!-- .swiper-slide -->
                        <?php endwhile; ?>
                    </div><!-- .swiper-wrapper -->

                    <div class="swiper-button-next nav-btn"></div>
                    <div class="swiper-button-prev nav-btn"></div>
                    <div class="swiper-pagination swp"></div>
                </div><!-- .resena -->
            </div><!-- .contenedor-resena -->
        </section><!-- RESEÑAS -->

        <section id="mensaje" class="mensaje">
            <h2 class="texto-centrado">Mensaje</h2>

            <?php 
                // Verificar si el parámetro 'resultado' está en la URL
                $resultado = isset($_GET['resultado']) ? intval($_GET['resultado']) : null;
            ?>

            <div class="login">
                <?php if(intval($resultado) === 1): ?>
                    <p class="alerta error">Debes iniciar sesión para dejar una reseña.</p>
                <?php elseif (intval($resultado) === 2): ?>
                    <p class="alerta error">Error al guardar la reseña: </p>
                <?php elseif (intval($resultado) === 3): ?>
                    <p class="alerta exito">Reseña guardada exitosamente.</p>
                <?php elseif (intval($resultado) === 4): ?>
                    <p class="alerta error">El comentario no puede exceder los 300 caracteres.</p>
                <?php endif; ?>


                <form class="formulario acciones" method="POST" action="/public/index.php">
                <label for="comentario">Comentario:</label>
                <textarea id="comentario" name="comentario" placeholder="Escribe tu reseña aquí..." required maxlength="250"></textarea>

                    <label for="viaje">Viaje:</label>
                    <select name="id_viaje" required>
                        <option disabled selected value="">-- Seleccione un Viaje --</option>
                        <?php foreach($viajes as $row) : ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['titulo']; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <input type="submit" value="Enviar Reseña" class="boton boton-verde">
                </form>
            </div>
        </section>
    </main>

    <?php incluirTemplate('footer'); ?>

    <script src="/build/js/app.js"></script>
    <script src="/build/js/modernizr.js"></script>
    <script src="/build/js/swiper.js"></script>
</body>
</html>