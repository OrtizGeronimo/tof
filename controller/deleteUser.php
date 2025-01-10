<?php
session_start();
require('./../models/usuario.php');
require('./../models/servicio.php');

$email = $_POST['email'];

if(isset($email)){
    try {
        $user = mysqli_fetch_array(Usuario::getUsuariosEmail($email));
        $servicioResult = Usuario::getAllServicios($user["idUsuario"]);  
        
        if(mysqli_num_rows($servicioResult) > 0){
            $servicio = mysqli_fetch_array($servicioResult);
            Servicio::deleteCategoriaServicio($servicio["idServicio"],$_SESSION["s_nombre"]);
            Servicio::deleteServicioHorarios($servicio["idServicio"],$_SESSION["s_nombre"]);
            Servicio::deleteServicioTipo($servicio["idServicio"],$_SESSION["s_nombre"]);
            Servicio::deleteServicio($servicio["idServicio"],$_SESSION["s_nombre"]);            
        }
        Usuario::deleteUsuario($email);
        header('Location:./../admin/users.php?deleteUser');
    } catch (\Throwable $th) {
        header('Location:./../admin/users.php?errorDeleteUser');
    }
}else{
    header('Location:./../admin/users.php');
}
?>