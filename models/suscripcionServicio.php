<?php
require_once('../config/conexion.php');
class SuscripcionServicio {
    public static function crearSuscripcion ($idUsuario, $idSuscripcion){
        $suscripcion = BaseDeDatos::consulta("INSERT INTO suscripcion (FK_idUsuario, idSuscripcion, fec_alta, fec_vencimiento, estado) 
                                      VALUES ('$idUsuario', '$idSuscripcion', NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), 'activa');");
        return $suscripcion;
    }
}