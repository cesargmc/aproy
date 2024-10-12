<?php 
    // Importar la conexion
    require __DIR__ . '/../config/database.php';
    $db = conectarDB();

    // Consultar
    $query = "SELECT * FROM Viajes";

    // Obtener resultado
    $resultado = mysqli_query($db, $query);
?>

<div class="seccion">
    <?php while($viaje = mysqli_fetch_assoc($resultado)): ?>
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

            <p class="descripcion">
                <?php echo $viaje['descripcion']; ?>
            </p>

            <div class="botones">
                <a class="boton btn-viaje" href="https://wa.me/8112586422?text=Hola,%20me%20gustaría%20saber%20más%20sobre%20el%20viaje.%0Ahttps://mirys.vercel.app/real14.html" target="_blank">Reserva <?php echo $viaje['titulo']; ?></a>

                <a href="viaje.php?id=<?php echo $viaje['id']; ?>" class="boton contacto">Ver más</a>
            </div>
        </div>
        <img class="seccion__img" loading="lazy" src="/imagenes/<?php echo $viaje['imagen'] ?>" alt="Imagen viaje">
    </div>
    <?php endwhile; ?>
</div><!-- SECCION VIAJES-->

<?php
    // Cerrar la conexion
    mysqli_close($db);
?>