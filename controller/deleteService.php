<?php
session_start();
require('./../models/servicio.php');
// var_dump($_SESSION);
if(isset($_SESSION["s_id_usuario"])){
    if($_GET["idServicio"]){
        try {
            // echo 'idServicio: '.$_GET["idServicio"];
            Servicio::deleteServicio($_GET["idServicio"],$_SESSION["s_nombre"]);
            Servicio::deleteServicioHorarios($_GET["idServicio"],$_SESSION["s_nombre"]);
            Servicio::deleteServicioTipo($_GET["idServicio"],$_SESSION["s_nombre"]);
            Servicio::deleteCategoriaServicio($_GET["idServicio"],$_SESSION["s_nombre"]);
            header('Location:./../admin/index.php?deleteService');
        } catch (\Throwable $th) {
            header('Location:./../admin/index.php?errorDeleteService');
        }
        header('Location:./../admin/index.php?deleteService');
    }else{
        header('Location:./../admin/index.php');
    }
}else{
    header('Location:./../index.php');    
}