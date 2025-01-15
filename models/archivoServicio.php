<?php
require_once('../config/conexion.php');
class ArchivoServicio{
    public static function getArchivoServicio(){
        $getArchivoServicio = BaseDeDatos::consulta("SELECT * FROM archivo_servicio");

        return $getArchivoServicio;                                                  
    }

    public static function agregarArchivoServicio($pdfRuta,$idServicio){
        $agregarArchivoServicio = BaseDeDatos::consulta("INSERT INTO archivo_servicio (archivo,FK_idServicio,usr_alta,fec_alta) VALUES ('$pdfRuta',$idServicio,'DESARROLLO',now());");

        return $agregarArchivoServicio;                                                  
    }
}
