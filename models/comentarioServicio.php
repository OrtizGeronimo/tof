<?php
(file_exists("../config/conexion.php"))? require_once('../config/conexion.php') : require_once('./config/conexion.php');

class Comentario{
    public static function getComentario($servicio){

        $getComentario = BaseDeDatos::consulta("SELECT * FROM comentario_servicio WHERE $servicio = FK_idServicio");
        return $getComentario;
    }

    public static function agregarComentario($comment,$servicio,$nombre,$email, $puntaje){
        
        $agregarComentario = BaseDeDatos::consulta("INSERT INTO comentario_servicio (comentario,puntaje,FK_idServicio,user_nombre,user_email,usr_alta,fec_alta) VALUES ('$comment','$puntaje',$servicio,'$nombre','$email','DESARROLLO',now());");

        return $agregarComentario;                                                  
    }

    
}