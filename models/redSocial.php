<?php
require_once('../config/conexion.php');
class RedSocial{
    public static function getRedSocial(){
        $getRedSocial = BaseDeDatos::consulta("SELECT * FROM red_social");

        return $getUsuarios;                                                  
    }

    public static function agregarRedSocial($instagram,$linkedin,$facebook,$idUsuario){
        $agregarRedSocial = BaseDeDatos::consulta("INSERT INTO red_social (redSocial_Instagram,redSocial_LinkedIn,redSocial_Facebook,usr_alta,fec_alta,FK_idUsuario) VALUES ('$instagram','$linkedin','$facebook','DESARROLLO',now(),$idUsuario);");

        return $agregarRedSocial;                                                  
    }
}
