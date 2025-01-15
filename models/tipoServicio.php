<?php
require_once('../config/conexion.php');
class TipoServicio{
    public static function getTipoServicio(){
        $getTipoServicio = BaseDeDatos::consulta("SELECT * FROM servicio_tipo");

        return $getTipoServicio;                                                  
    }

    public static function agregarTipoServicio($tipo,$idServicio){
        $agregarTipoServicio = BaseDeDatos::consulta("INSERT INTO servicio_tipo (tipo,FK_idServicio,usr_alta,fec_alta) VALUES ('$tipo',$idServicio,'DESARROLLO',now());");

        return $agregarTipoServicio;                                                  
    }
}
