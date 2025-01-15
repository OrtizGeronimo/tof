<?php
session_start();
require('./../models/usuario.php');
require('./../models/servicio.php');

$email = $_POST['email'];

if(isset($email)){
    try {
        $user = mysqli_fetch_array(Usuario::getUsuariosEmail($email));
        $servicioResult = Usuario::getServicios($user["idUsuario"]);  
        
        if(mysqli_num_rows($servicioResult) > 0){
            $servicio = mysqli_fetch_array($servicioResult);
            Servicio::bajaFisicaComentario($servicio["idServicio"]); 
            Servicio::bajaFisicaTags($servicio["idServicio"]);
            Servicio::bajaFisicaRedSocial($servicio["idServicio"]);            
            Servicio::bajaFisicaHorarios($servicio["idServicio"]);
            Servicio::bajaFisicaTipo($servicio["idServicio"]);
            Servicio::bajaFisicaCategoriaServicio($servicio["idServicio"]);
            Servicio::bajaFisicaServicio($servicio["idServicio"]);            
        }
        Usuario::deleteUsuario($email);
        if(strtoupper($_SESSION["s_rol"]) == "ADMIN"){
            header('Location:./../admin/users.php?deleteUser');
        }
    } catch (\Throwable $th) {
        if(strtoupper($_SESSION["s_rol"]) == "ADMIN"){
            header('Location:./../admin/users.php?errorDeleteUser&message='. urlencode($th));
        }
    }
}else{
    if(strtoupper($_SESSION["s_rol"]) == "ADMIN"){
        header('Location:./../admin/users.php');
    }
}
?>