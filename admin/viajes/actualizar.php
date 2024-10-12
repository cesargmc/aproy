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
        header("Location: ../../public/index.php");
        exit();
    }
    // Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    // Obtener los datos del viaje
    $consulta = "SELECT * FROM viajes WHERE id = $id";
    $resultado = mysqli_query($db, $consulta);
    $viaje = mysqli_fetch_assoc($resultado);

    // Arreglo errores
    $errores = [];

    $titulo = $viaje['titulo'];
    $salida = $viaje['salida'];
    $regreso = $viaje['regreso'];
    $dias_noches = $viaje['dias_noches'];
    $descripcion = $viaje['descripcion'];
    $imagen = $viaje['imagen'];

    $consultaPrecios = "SELECT * FROM PreciosHabitacion WHERE id_viaje = $id";
    $resultadoPrecios = mysqli_query($db, $consultaPrecios);

    $precio_doble = '';
    $precio_triple = '';
    $precio_cuadruple = '';

    while($precio = mysqli_fetch_assoc($resultadoPrecios)) {
        if($precio['tipo_habitacion'] === 'Doble') {
            $precio_doble = $precio['precio'];
        } elseif($precio['tipo_habitacion'] === 'Triple') {
            $precio_triple = $precio['precio'];
        } elseif($precio['tipo_habitacion'] === 'Cuadruple') {
            $precio_cuadruple = $precio['precio'];
        }
    }

    $consultaActividades = "SELECT * FROM Actividades WHERE id_viaje = $id";
    $resultadoActividades = mysqli_query($db, $consultaActividades);

    $actividad_nombre = [];
    $actividad_precio = [];

    while($actividad = mysqli_fetch_assoc($resultadoActividades)) {
        $actividad_nombre[] = $actividad['nombre_actividad'];
        $actividad_precio[] = $actividad['precio'];
    }

    $avisos = $viaje['avisos'];
    $lugar_salida = $viaje['lugar_salida'];

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
        if(!$dias_noches) {
            $errores[] = "Debes añadir cuantos días y noches será el viaje";
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

            $nombreImagen = '';

            // Eliminar imagen antigua
            if($imagen['name']) {
                unlink($carpetaImagenes . $viaje['imagen']);

                // Generar un numbre unico
                $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

                // Subir imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            } else {
                $nombreImagen = $viaje['imagen'];
            }

            // Insertar en la base de datos
            $query = "UPDATE Viajes SET titulo = '$titulo', salida = '$salida', regreso = '$regreso', dias_noches = '$dias_noches', imagen = '$nombreImagen', descripcion = '$descripcion', avisos = '$avisos', lugar_salida = '$lugar_salida' WHERE id = $id";

            $resultado = mysqli_query($db, $query);

            // Obtener el ID del viaje
            $id_viaje = mysqli_insert_id($db);

            // Insertar precios de habitaciones
            $queryDoble = "UPDATE PreciosHabitacion SET precio = '$precio_doble' WHERE id_viaje = $id AND tipo_habitacion = 'Doble'";
            $queryTriple = "UPDATE PreciosHabitacion SET precio = '$precio_triple' WHERE id_viaje = $id AND tipo_habitacion = 'Triple'";
            $queryCuadruple = "UPDATE PreciosHabitacion SET precio = '$precio_cuadruple' WHERE id_viaje = $id AND tipo_habitacion = 'Cuádruple'";

            mysqli_query($db, $queryDoble);
            mysqli_query($db, $queryTriple);
            mysqli_query($db, $queryCuadruple);

            // Actualizar actividades
            foreach ($actividad_nombre as $index => $nombre) {
                $precio = floatval($actividad_precio[$index]);
                $queryActividad = "UPDATE Actividades SET precio = '$precio' WHERE id_viaje = $id AND nombre_actividad = '$nombre'";
                
                mysqli_query($db, $queryActividad);
            }

            header('Location: /admin?resultado=2');
        }
    }

    require '../../includes/funciones.php';
    incluirTemplate('header');
?>

<main class="contenedor seccion">
        <h1>Actualizar</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <div class="alertas">
            <?php foreach($errores as $error): ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <form class="formulario crud" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título del Viaje" value="<?php echo $titulo; ?>">

                <label for="salida">Fecha de Salida:</label>
                <input type="date" id="salida" name="salida" value="<?php echo htmlspecialchars($salida); ?>">

                <label for="regreso">Fecha de Regreso:</label>
                <input type="date" id="regreso" name="regreso" value="<?php echo htmlspecialchars($regreso); ?>">

                <label for="dias_noches">Duración (días y noches):</label>
                <input type="text" id="dias_noches" name="dias_noches" placeholder="2 días y 1 noche" value="<?php echo $dias_noches; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

                <img src="/imagenes/<?php echo $imagen ?>" class="imagen-sm">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" placeholder="Descripción del viaje"><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Precios</legend>

                <label for="doble">Precio Habitación Doble:</label>
                <input type="number" id="doble" name="precio_doble" placeholder="Precio p/p habitación doble" min="1" value="<?php echo $precio_doble; ?>">

                <label for="triple">Precio Habitación Triple:</label>
                <input type="number" id="triple" name="precio_triple" placeholder="Precio p/p habitación triple" min="1" value="<?php echo $precio_triple; ?>">

                <label for="cuadruple">Precio Habitación Cuádruple:</label>
                <input type="number" id="cuadruple" name="precio_cuadruple" placeholder="Precio p/p habitación cuádruple" min="1" value="<?php echo $precio_cuadruple; ?>">
            </fieldset>

            <fieldset>
                <legend>Actividades</legend>
                
                <div id="actividades-container">
                    <div class="actividad-item">
                        <?php foreach ($actividad_nombre as $index => $nombre): ?>
                            <label for="titulo">Título:</label>
                            <input type="text" name="actividad_nombre[]" placeholder="Ej: Paseo en Willys" value="<?php echo htmlspecialchars($nombre); ?>">
                            <label for="precio">Precio:</label>
                            <input type="number" name="actividad_precio[]" placeholder="Precio" value="<?php echo htmlspecialchars($actividad_precio[$index]); ?>">
                        <?php endforeach; ?>
                    </div>
                </div>

                <button type="button" class="boton" onclick="agregarActividad()">Agregar otra actividad</button>
            </fieldset>

            <fieldset>
                <legend>Información Importante</legend>

                <label for="avisos">Avisos:</label>
                <textarea id="avisos" name="avisos" placeholder="Escribe los avisos aquí..."><?php echo $avisos; ?></textarea>

                <label for="lugar_salida">Lugar de Salida</label>
                <textarea id="lugar_salida" name="lugar_salida" placeholder="Ej: Av. Los Pinos y Rio Ramos Villas de Ote."><?php echo $lugar_salida; ?></textarea>
            </fieldset>

            <input type="submit" value="Actualizar Viaje" class="boton boton-verde">
        </form>
    </main>

<?php incluirTemplate('footer'); ?>