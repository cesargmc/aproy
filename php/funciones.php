<?php

    function esNulo(array $parametros){
        foreach($parametros as $parametros){
            if(strlen(trim($parametros)) < 1){
                return true;
            }
        } return false;
    }

    function esEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL )){
            return true;
        } return false;
    }

    function validaPassword($password, $repassword){
        if(strcmp($password, $repassword) === 0){ //Comparación binaria
            return true;
        } return false;
    }

    function generarToken(){
        return md5(uniqid(mt_rand(), false));
    }

    function registrarCliente(array $datos, $con){
        $sql = $con->prepare("INSERT INTO clientes (nombres, apellidos, email, estatus, fecha_alta) VALUES(?,?,?,1,now())");
        if($sql->execute($datos)){
            return $con->lastInsertId();
        }
        return 0;
    }

    function registrarUsuario(array $datos, $con){
        $sql = $con->prepare("INSERT INTO usuarios (usuario, password, token, id_cliente) VALUES(?,?,?,?)");
        if($sql->execute($datos)){
            return $con->lastInsertId();
        }
        return 0;
    }

    function usuarioExiste($usuario, $con){
        $sql = $con->prepare("SELECT id FROM usuarios WHERE usuario LIKE ? LIMIT 1");
        $sql->execute([$usuario]);
        if($sql->fetchColumn() > 0){
            return true;
        } return false;
    }

    function emailExiste($email, $con){
        $sql = $con->prepare("SELECT id FROM clientes WHERE email LIKE ? LIMIT 1");
        $sql->execute([$email]);
        if($sql->fetchColumn() > 0){
            return true;
        } return false;
    }

    function mostrarMensajes(array $errors) {
        if (count($errors) > 0) {
            echo '<div class="error_mensaje"> <ul>';
            foreach ($errors as $error) {
                echo '<li class="error_item">' . htmlspecialchars($error) . '</li>';
            }
            echo '</ul></div>';
        }
    }

    function validaToken($id, $token, $con){
        //$msg = "";
        $sql = $con->prepare("SELECT id FROM usuarios WHERE id = ? AND token LIKE ? LIMIT 1");
        $sql->execute([$id, $token]);
        if($sql->fetchColumn() > 0){
            if(activarUsuario($id, $con)){
                $msg = "Cuenta activada";
            } else{
                $msg = "Error al activar cuenta";
            }
        } else {
            $msg = "No existe el registro que se esta solicitando";
        } 
        return $msg;
    }

    function activarUsuario($id, $con){
        $sql = $con->prepare("UPDATE usuarios SET activacion = 1, token = '' WHERE id = ?");
        return $sql->execute([$id]);
    }

    function login($usuario, $password, $con){
        $sql = $con->prepare("SELECT id, usuario, password, rol FROM usuarios WHERE usuario LIKE ? LIMIT 1");
        $sql->execute([$usuario]);
        
        if($row = $sql->fetch(PDO::FETCH_ASSOC)){
            if(esActivo($usuario, $con)){
                if(password_verify($password, $row['password'])){
                    // Guardar datos de sesión
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_name'] = $row['usuario'];
                    $_SESSION['user_role'] = $row['rol'];
                    if($row['rol'] == 1) {
                        header("Location: admin.php"); 
                    } else {
                        header("Location: index.php"); 
                    }
                    exit;
                }
            } else {
                return 'El usuario no ha sido activado';
            }
        }
        return 'El usuario o contraseña es incorrecto';
    }

    function esActivo($usuario, $con){
        $sql = $con->prepare("SELECT activacion FROM usuarios WHERE usuario LIKE ? LIMIT 1");
        $sql->execute([$usuario]);
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        if($row['activacion'] == 1){
            return true;
        } return false;
    }

?>