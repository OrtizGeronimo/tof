<?php
    session_start();
    require('./models/usuario.php');
    require('./models/suscripcionServicio.php');
    require("./controller/validarSuscripcion.php");
    //recepcion ajax
    
    $user = (isset($_POST['user'])) ? $_POST['user'] : '';
    $pass = (isset($_POST['pass'])) ? $_POST['pass'] : '';
    //encr pass
    $passEnc = sha1($pass);
 
    $consulta = Usuario::getUsuarioContraseña($user,$passEnc);
    
    $numRows = mysqli_num_rows($consulta);
    $data = null;

    if($numRows>=1){
        while($row=mysqli_fetch_array($consulta)) {
            $idUsuario = $row['idUsuario'];
            $usuario    = $row['user_login'];
            $pw         = $row['user_pass'];
            $nombre    = $row['user_nombre'];
            $rol        = $row['rol'];
            $img_perfil = $row['user_img_perfil'];
        }
        if ($user == $usuario && $passEnc == $pw) {
            $_SESSION["s_id_usuario"] = $idUsuario;
            $_SESSION["s_nombre"] = $nombre;
            $_SESSION["s_nombre_usuario"] = $usuario;
            $_SESSION["s_rol"] = $rol;
            $_SESSION["s_img_perfil"] = 'archivos/user_'.$usuario.'/user_profile.webp';

            $response = "no entra a validar suscripcion porque es gratuito, rol: ".$rol;

            if($rol !== "gratis" && $rol !== "admin"){
                $querySuscripcion = SuscripcionServicio::getSuscripcion($idUsuario);

                $suscripcion = mysqli_fetch_array($querySuscripcion);

                $fechaVto = $suscripcion["fec_vencimiento"];

                $estadoSuscripcion = $suscripcion["estado"];

                $fechaVtoDate = substr($fechaVto, 0, 10);

                $response = "no entra ni en fecha ni en suscripcion pendiente, fecha vto: ".$fechaVtoDate. " estado suscripcion: ".$estadoSuscripcion;
                if (date('Y-m-d') >= $fechaVtoDate) {
                    //se debe consultar a mp si la suscripcion sigue activa
                    $response = ValidarSuscripcion::validarEstadoSuscripcion($idUsuario, true);
                    $response = "entra a validar suscripcion porque fecha vencida".$response;
                } else if ($estadoSuscripcion === "pendiente") {
                    //se debe consultar a mp si la suscripcion sigue activa
                    $response = ValidarSuscripcion::validarEstadoSuscripcion($idUsuario, false);
                    $response = "entra a validar suscripcion porque status pendiente".$response;
                }
            }

            echo json_encode(['success' => true, 'response' => $response]);
        }else{
            echo json_encode(['success' => false]);
        }
        
    }
    else{
        $_SESSION["s_nombre"] = null;
        echo json_encode(['success' => false]);
    }
?>
