<?php 
(file_exists('./config/conexion.php'))?include_once('./config/conexion.php'):include_once('./../config/conexion.php');
(file_exists("./../config/conexion.php"))? require_once('./../config/conexion.php') : require_once('./config/conexion.php');

class Galeria{
    public static function getGaleria($idServicio){
        $getGaleria = BaseDeDatos::consulta("SELECT * FROM galeria WHERE FK_idServicio = $idServicio");

        return $getGaleria;                                                  
    }

    public static function agregarGaleria($imagenRuta, $idServicio){
        $agregarGaleria = BaseDeDatos::consulta("INSERT INTO galeria (img, FK_idServicio, fec_alta) VALUES ('$imagenRuta','$idServicio',now());");

        return $agregarGaleria;                                                  
    }

    public static function getFileName($img, $servicio){
        return file_exists('./archivos/user_'.($servicio["user_login"]).'/galeria/'.($img["img"]).'')?'./archivos/user_'.($servicio["user_login"]).'/galeria/'.($img["img"]).'' : './assets/img/user_profile.webp';
    }
}

?>