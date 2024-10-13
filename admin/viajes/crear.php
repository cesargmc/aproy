<?php
    // Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    // Arreglo errores
    $errores = [];

    $titulo = '';
    $salida = '';
    $regreso = '';
    $dias_noches = '';
    $descripcion = '';
    $precio_doble = '';
    $precio_triple = '';
    $precio_cuadruple = '';
    $actividad_nombre = [];
    $actividad_precio = [];
    $avisos = '';
    $lugar_salida = '';

    // Ejecutar el codigo despues de que el usuario envia el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['titulo'];
        $salida = $_POST['salida'];
        $regreso = $_POST['regreso'];
        $dias_noches = $_POST['dias_noches'];
        $descripcion = $_POST['descripcion'];
        $precio_doble = $_POST['precio_doble'];
        $precio_triple = $_POST['precio_triple'];
        $precio_cuadruple = $_POST['precio_cuadruple'];
        $actividad_nombre = $_POST['actividad_nombre'];
        $actividad_precio = $_POST['actividad_precio'];
        $avisos = $_POST['avisos'];
        $lugar_salida = $_POST['lugar_salida'];

        // Asignar files hacia una variable
        $imagen = $_FILES['imagen'];

        // Validaciones
        if(!$titulo) {
            $errores[] = "Debes añadir un título";
        }
        if(!$salida) {
            $errores[] = "Debes añadir una fecha de salida";
        }
        if(!$regreso) {
            $errores[] = "Debes añadir una fecha de regreso";
        }
        if(!$dias_noches) {
            $errores[] = "Debes añadir cuantos días y noches será el viaje";
        }
        if(!$imagen['name']) {
            $errores[] = "Debes añadir una imagen";
        }
        if(!$descripcion) {
            $errores[] = "La descripción es obligatoria";
        }
        if(!$precio_doble) {
            $errores[] = "El p/p doble es obligatorio";
        }
        if(!$precio_triple) {
            $errores[] = "El p/p triple es obligatorio";
        }
        if(!$precio_cuadruple) {
            $errores[] = "El p/p cuádruple es obligatorio";
        }
        if(!$avisos) {
            $errores[] = "Los avisos son obligatorios";
        }
        if(!$lugar_salida) {
            $errores[] = "El lugar de salida es obligatorio";
        }

        // Validación de actividades
        foreach ($actividad_nombre as $index => $nombre) {
            if (!$nombre || !$actividad_precio[$index]) {
                $errores[] = "El nombre y precio de todas las actividades son obligatorios";
            }
        }

        // Revisar que el arreglo de errores este vacio
        if(empty($errores)) {
            // Crear carpeta de Iamgenes
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            // Generar un numbre unico
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

            // Subir imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

            // Insertar en la base de datos
            $query = "INSERT INTO Viajes (titulo, salida, regreso, dias_noches, imagen, descripcion, avisos, lugar_salida) 
            VALUES ('$titulo', '$salida', '$regreso', '$dias_noches', '$nombreImagen', '$descripcion', '$avisos', '$lugar_salida')";

            $resultado = mysqli_query($db, $query);

            // Obtener el ID del viaje
            $id_viaje = mysqli_insert_id($db);

            // Insertar precios de habitaciones
            $queryDoble = "INSERT INTO PreciosHabitacion (id_viaje, tipo_habitacion, precio) VALUES ('$id_viaje', 'Doble', '$precio_doble')";
            $queryTriple = "INSERT INTO PreciosHabitacion (id_viaje, tipo_habitacion, precio) VALUES ('$id_viaje', 'Triple', '$precio_triple')";
            $queryCuadruple = "INSERT INTO PreciosHabitacion (id_viaje, tipo_habitacion, precio) VALUES ('$id_viaje', 'Cuádruple', '$precio_cuadruple')";

            mysqli_query($db, $queryDoble);
            mysqli_query($db, $queryTriple);
            mysqli_query($db, $queryCuadruple);

            // Insertar actividades
            foreach ($actividad_nombre as $index => $nombre) {
                $precio = floatval($actividad_precio[$index]);
                $queryActividad = "INSERT INTO Actividades (id_viaje, nombre_actividad, precio) VALUES ('$id_viaje', '$nombre', '$precio')";
                mysqli_query($db, $queryActividad);
            }

            header('Location: /admin?resultado=1');
        }
    }

    require '../../includes/funciones.php';
    incluirTemplate('headerAdmin');
   
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <div class="alertas">
            <?php foreach($errores as $error): ?>
                <div class="alerta error">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endforeach; ?>
        </div>

        <form class="formulario crud" method="POST" action="/admin/viajes/crear.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título del Viaje" value="<?php echo htmlspecialchars($titulo); ?>">

                <label for="salida">Fecha de Salida:</label>
                <input type="date" id="salida" name="salida" value="<?php echo htmlspecialchars($salida); ?>">

                <label for="regreso">Fecha de Regreso:</label>
                <input type="date" id="regreso" name="regreso" value="<?php echo htmlspecialchars($regreso); ?>">

                <label for="dias_noches">Duración (días y noches):</label>
                <input type="text" id="dias_noches" name="dias_noches" placeholder="2 días y 1 noche" value="<?php echo htmlspecialchars($dias_noches); ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" placeholder="Descripción del viaje"><?php echo htmlspecialchars($descripcion); ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Precios</legend>

                <label for="doble">Precio Habitación Doble:</label>
                <input type="number" id="doble" name="precio_doble" placeholder="Precio p/p habitación doble" min="1" value="<?php echo htmlspecialchars($precio_doble); ?>">

                <label for="triple">Precio Habitación Triple:</label>
                <input type="number" id="triple" name="precio_triple" placeholder="Precio p/p habitación triple" min="1" value="<?php echo htmlspecialchars($precio_triple); ?>">

                <label for="cuadruple">Precio Habitación Cuádruple:</label>
                <input type="number" id="cuadruple" name="precio_cuadruple" placeholder="Precio p/p habitación cuádruple" min="1" value="<?php echo htmlspecialchars($precio_cuadruple); ?>">
            </fieldset>

            <fieldset>
                <legend>Actividades</legend>
                
                <div id="actividades-container">
                <?php if(!empty($actividad_nombre) && !empty($actividad_precio)): ?>
                    <?php for($i = 0; $i < count($actividad_nombre); $i++): ?>
                        <div class="actividad-item">
                            <label for="actividad_nombre">Título:</label>
                            <input type="text" name="actividad_nombre[]" placeholder="Ej: Paseo en Willys" value="<?php echo htmlspecialchars($actividad_nombre[$i]); ?>">
                            <label for="actividad_precio">Precio:</label>
                            <input type="number" name="actividad_precio[]" placeholder="Precio" value="<?php echo htmlspecialchars($actividad_precio[$i]); ?>">
                        </div>
                    <?php endfor; ?>
                <?php else: ?>
                    <div class="actividad-item">
                        <label for="actividad_nombre">Título:</label>
                        <input type="text" name="actividad_nombre[]" placeholder="Ej: Paseo en Willys">
                        <label for="actividad_precio">Precio:</label>
                        <input type="number" name="actividad_precio[]" placeholder="Precio">
                    </div>
                <?php endif; ?>
                </div>

                <button type="button" class="boton" onclick="agregarActividad()">Agregar otra actividad</button>
            </fieldset>

            <fieldset>
                <legend>Información Importante</legend>

                <label for="avisos">Avisos:</label>
                <textarea id="avisos" name="avisos" placeholder="Escribe los avisos aquí..."><?php echo htmlspecialchars($avisos); ?></textarea>

                <label for="lugar_salida">Lugar de Salida</label>
                <textarea id="lugar_salida" name="lugar_salida" placeholder="Ej: Av. Los Pinos y Rio Ramos Villas de Ote."><?php echo htmlspecialchars($lugar_salida); ?></textarea>
            </fieldset>

            <input type="submit" value="Crear Viaje" class="boton boton-verde">
        </form>
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