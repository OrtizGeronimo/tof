<?php
require_once('../config/conexion.php');
class SuscripcionServicio {
    public static function crearSuscripcion ($idUsuario, $idSuscripcion, $estado_mp){
        $suscripcion = BaseDeDatos::consulta("INSERT INTO suscripcion (FK_idUsuario, id_suscripcion, fec_suscripcion, fec_vencimiento, estado, estado_mp) 
                                      VALUES ('$idUsuario', '$idSuscripcion', NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), 'activa', '$estado_mp');");
        return $suscripcion;
    }
}