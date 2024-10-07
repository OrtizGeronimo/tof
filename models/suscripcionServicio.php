<?php
(file_exists('./config/conexion.php'))?include_once('./config/conexion.php'):include_once('./../config/conexion.php');
(file_exists("./../config/conexion.php"))? require_once('./../config/conexion.php') : require_once('./config/conexion.php');

class SuscripcionServicio {
    public static function crearSuscripcion ($idUsuario, $idSuscripcion){
        $suscripcion = BaseDeDatos::consulta("INSERT INTO suscripcion (FK_idUsuario, id_suscripcion, fec_suscripcion, fec_vencimiento, estado) 
                                      VALUES ('$idUsuario', '$idSuscripcion', NOW(), DATE_ADD(NOW(), INTERVAL 32 DAY), 'pendiente');");
        return $suscripcion;
    }

    public static function getSuscripcion($idUsuario){
        $fecha = BaseDeDatos::consulta("SELECT *
                                        FROM suscripcion
                                        WHERE FK_idUsuario = $idUsuario;");
        return $fecha;
    }


    public static function updateEstadoSuscripcion($idUsuario, $estado){
        $update = BaseDeDatos::consulta("UPDATE suscripcion SET estado = '$estado' WHERE FK_idUsuario = $idUsuario;");
        return $update;
    }

    public static function updateFechaVencimiento($idUsuario, $date){
        $update = BaseDeDatos::consulta("UPDATE suscripcion SET fec_vencimiento = '$date' WHERE FK_idUsuario = $idUsuario;");
        return $update;
    }

    public static function logicDeleteSuscripcion($idUsuario){
        $delete = BaseDeDatos::consulta("UPDATE suscripcion SET fec_baja = NOW() WHERE FK_idUsuario = $idUsuario;");
        return $delete;
    }

}