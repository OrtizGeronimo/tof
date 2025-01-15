<?php
require_once('../config/conexion.php');
class HorarioServicio{
    public static function getHorarioServicio(){
        $getHorarioServicio = BaseDeDatos::consulta("SELECT * FROM servicio_horario");

        return $getHorarioServicio;                                                  
    }

    public static function agregarHorarioServicio($horaDesde,$horaHasta,$idServicio,$idDias){
        $agregarHorarioServicio = BaseDeDatos::consulta("INSERT INTO servicio_horario (servicio_tipo_hora_desde,servicio_tipo_hora_hasta,FK_idServicio,FK_idDias,usr_alta,fec_alta) VALUES ('$horaDesde','$horaHasta',$idServicio,$idDias,'DESARROLLO',now());");

        return $agregarHorarioServicio;                                                  
    }
}
