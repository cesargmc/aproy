<?PHP
require 'php/config.php';
require 'php/conexion.php';
require 'php/funciones.php';
$db = new Database();
$con = $db->conectar();

$errors = [];
if(!empty($_POST)){
    $nombres = trim($_POST['nombres']);
    $apellidos = trim($_POST['apellidos']);
    $email = trim($_POST['email']);
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);

    if(esNulo([$nombres, $apellidos, $email, $usuario, $password, $repassword])){
        $errors[] = "Se debe de llenar todos los campos";
    }

    if(!esEmail($email)){
        $errors[] = "La dirección de correo no es valida";
    }

    if(!validaPassword($password, $repassword)){
        $errors[] = "Las contraseñas no coinciden";
    }

    if(usuarioExiste($usuario, $con)){
        $errors[] = "El nombre de usuario $usuario ya existe";
    }

    if(emailExiste($email, $con)){
        $errors[] = "El correo ya esta registrado";
    }

    if(count($errors) == 0){
        $id = registrarCliente([$nombres, $apellidos, $email], $con);

        if($id > 0){

            require 'php/mailer.php';
            $token = generarToken();
            $mailer = new Mailer();
            
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);

            $idUsuario = registrarUsuario([$usuario, $pass_hash, $token, $id], $con);

            if ($idUsuario > 0){

                $url = SITE_URL . '/activa_cliente.php?id='.$idUsuario.'&token='.$token;
                $asunto = "Activar cuenta Mirys Viajes";
                $cuerpo = "Bienvenido $usuario <br> Para activar tu cuenta, porfavor ingresa al siguiente enlace <a href='$url'>Activar Cuenta</a>";


                if($mailer->enviarEmail($email, $asunto, $cuerpo)){
                    echo "Para terminar con el proceso active su cuenta con el correo que se envio a $email";
                    exit;
                }
            } else{
                $errors[] = "Error al registrar el cliente";
            }
        } else {
            $errors[] = "Error al registrar el cliente";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crear Cuenta de Miry's Viajes</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="build/css/cCuenta.css">
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

        <div class="contenedorRegistrar">
            <h1>Registrate</h1>

            <?PHP mostrarMensajes($errors); ?>

            <form action="crearC.php" method="post">
                <div class="formulario">

                    <div class="datosIngresados">
                        <label for="email">* Nombres</label>
                        <div class="entradaFormulario">
                            <input type="text" placeholder="Nombres" name="nombres" required>
                        </div>
                    </div>

                    <div class="datosIngresados">
                        <label for="email">* Apellidos</label>
                        <div class="entradaFormulario">
                            <input type="text" placeholder="Apellidos" name="apellidos" required>
                        </div>
                    </div>

                    <div class="datosIngresados">
                        <label for="email">* Correo Electrónico</label>
                        <div class="entradaFormulario">
                            <input type="email" placeholder="Correo Electronico" id="email" name="email" required>
                        </div>
                        <span class="eExist" id="validaEmail"></span>
                    </div>

                    <div class="datosIngresados">
                        <label for="usuario">* Usuario</label>
                        <div class="entradaFormulario">
                            <input type="text" placeholder="Ingrese su usuario" id="usuario" name="usuario" required>
                        </div>
                        <span class="eExist" id="validaUsuario"></span>
                    </div> 

                    <div class="datosIngresados">
                        <label for="password">* Contraseña</label>
                        <div class="entradaFormulario">
                            <input type="password" placeholder="Contraseña" id="password" name="password" required>
                            <div class="mostrarContraseña" id="showPassword1">
                                <img src="build/img/simboloMostrar.png" alt="Mostrar contraseña" class="mostrarSimbolo" id="showIcon1">
                            </div>
                        </div>
                    </div>

                    <div class="datosIngresados">
                        <label for="repassword">* Confirmar Contraseña</label>
                        <div class="entradaFormulario">
                            <input type="password" placeholder="Contraseña" id="repassword" name="repassword" required>
                            <div class="mostrarContraseña" id="showPassword2">
                                <img src="build/img/simboloMostrar.png" alt="Mostrar contraseña" class="mostrarSimbolo" id="showIcon2">
                            </div>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn">Registrarse</button>
            </form>

            <p>¿Ya tienes cuenta? <a href="inicioS.php">Inicia Sesión</a></p>

        </div>

        <script>
            const password = document.getElementById('password');
            const showIcon1 = document.getElementById('showIcon1');
            showIcon1.addEventListener('click', function () {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                showIcon1.src = type === 'password' ? 'build/img/simboloMostrar.png' : 'build/img/simboloEsconder.png';
            });
            const repassword = document.getElementById('repassword');
            const showIcon2 = document.getElementById('showIcon2');
            showIcon2.addEventListener('click', function () {
                const type = repassword.getAttribute('type') === 'password' ? 'text' : 'password';
                repassword.setAttribute('type', type);
                showIcon2.src = type === 'password' ? 'build/img/simboloMostrar.png' : 'build/img/simboloEsconder.png';
            });
        </script>

        <script>
            let txtUsuario = document.getElementById('usuario')
            txtUsuario.addEventListener("blur", function(){
                existeUsuario(txtUsuario.value)
            }, false)

            let txtEmail = document.getElementById('email')
            txtEmail.addEventListener("blur", function(){
                existeEmail(txtEmail.value)
            }, false)

            function existeEmail(email) {
                let url = "php/ajax.php"
                let formData = new FormData()
                formData.append("action", "existeEmail")
                formData.append("email", email)

                fetch(url, {
                    method: 'POST', 
                    body: formData
                }).then(response => response.json())
                .then(data => {
                    if(data.ok){
                        document.getElementById('email').value = ''
                        document.getElementById('validaEmail').innerHTML = 'Email no disponible'
                    } else{
                        document.getElementById('validaEmail').innerHTML = ''
                    }
                })
            }
            
            function existeUsuario(usuario){
                let url = "php/ajax.php"
                let formData = new FormData()
                formData.append("action", "existeUsuario")
                formData.append("usuario", usuario)

                fetch(url, {
                    method: 'POST', 
                    body: formData
                }).then(response => response.json())
                .then(data => {
                    if(data.ok){
                        document.getElementById('usuario').value = ''
                        document.getElementById('validaUsuario').innerHTML = 'Usuario no disponible'
                    } else{
                        document.getElementById('validaUsuario').innerHTML = ''
                    }
                })
            }

        </script>

    </body>
</html>