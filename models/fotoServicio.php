<?php
require_once('../config/conexion.php');
class FotoServicio{
    public static function getFotoServicio(){
        $getFotoServicio = BaseDeDatos::consulta("SELECT * FROM foto_servicio");

        return $getFotoServicio;                                                  
    }

    public static function agregarFotoServicio($ImgRuta,$idServicio){
        $agregarFotoServicio = BaseDeDatos::consulta("INSERT INTO Foto_servicio (foto,FK_idServicio,usr_alta,fec_alta) VALUES ('$ImgRuta',$idServicio,'DESARROLLO',now());");

        return $agregarFotoServicio;                                                  
    }
}
