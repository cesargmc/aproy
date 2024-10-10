<?PHP
require 'php/config.php';
require 'php/conexion.php';
require 'php/funciones.php';
$db = new Database();
$con = $db->conectar();

$errors = [];
if(!empty($_POST)){
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);

    if(esNulo([$usuario, $password])){
        $errors[] = "Se debe de llenar todos los campos";
    }
    if(count($errors) == 0){
        $errors[] = login($usuario, $password, $con);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicio de Sesión Miry's Viajes</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="build/css/iSesion.css">
        <link rel="stylesheet" href="build/css/app.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>

    <header class="header">
            <div class="barra contenedor">
                <div class="logo">
                    <a href="index.php"><h1 class="logo__texto">Miry's Viajes</h1></a>
                </div>

                <div class="overlay"></div>
                <button class="menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#0c3b2e" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M4 6l16 0" />
                        <path d="M4 12l16 0" />
                        <path d="M4 18l16 0" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#0c3b2e" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M18 6l-12 12" />
                        <path d="M6 6l12 12" />
                    </svg>
                </button>
                <aside>
                    <a href="index.php#incio" class="navegacion__enlace">Inicio</a>
                    <a href="index.php#servicios" class="navegacion__enlace">Servicos</a>
                    <a href="index.php#viajes" class="navegacion__enlace">Viajes</a>
                    <a href="index.php#reseñas" class="navegacion__enlace">Reseñas</a>
                </aside>


                <nav class="navegacion-viaje">
                    <a href="index.php#inicio" class="navegacion__enlace">Inicio</a>
                    <a href="index.php#servicios" class="navegacion__enlace">Servicos</a>
                    <a href="index.php#viajes" class="navegacion__enlace">Viajes</a>
                    <a href="index.php#reseñas" class="navegacion__enlace">Reseñas</a>
                </nav>
            </div>
        </header><!-- HEADER -->

        <div class="contenedorIniciarSesion">

        <h1>Iniciar Sesión</h1>

        <?PHP mostrarMensajes($errors) ?>

            <!--Inicio Sesión-->
            <form action="login.php" method="POST">

                <div class="formulario">
                    <div class="datosIngresados">
                        <label for="usuario">Usuario:</label>
                        <div class="entradaFormulario">
                            <input type="text" id="usuario" name="usuario" placeholder="Ingresa tu usuario" required>
                        </div>
                    </div>
    
                    <div class="datosIngresados">
                        <label for="password">Contraseña:</label>
                        <div class="entradaFormulario">
                            <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                            <div class="mostrarContraseña" id="showPassword">
                                <img src="build/img/simboloMostrar.png" alt="Mostrar contraseña" class="mostrarSimbolo" id="showIcon">
                            </div>
                        </div>
                    </div>
                    <p><a href="recuperarC.php">¿Olvidaste tu contraseña?</a></p>
                </div>

                <button type="submit" class="btn">Iniciar Sesión</button>

            </form>

            <p>¿No tienes cuenta? <a href="crearC.php">Crear cuenta</a></p>

        </div>


        <script>
            const password = document.getElementById('password');
            const showIcon = document.getElementById('showIcon');
            
            showIcon.addEventListener('click', function () {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                showIcon.src = type === 'password' ? 'build/img/simboloMostrar.png' : 'build/img/simboloEsconder.png';
            });
        </script>
        
    </body>
</html>