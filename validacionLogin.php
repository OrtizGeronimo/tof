<?php
    session_start();
    require('./models/usuario.php');
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
            $_SESSION["s_img_perfil"] = 'archivos/user_'.$usuario.'/'.$img_perfil;
            //asdasds
            $data = json_encode($consulta);
        }else{
            $data = null;
        }
        
    }
    else{
        $_SESSION["s_nombre"] = null;
        $data = null;
    }
    print json_encode($data);
?>
