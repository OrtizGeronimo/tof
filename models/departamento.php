<?php
(file_exists("./../config/conexion.php"))? require_once('./../config/conexion.php') : require_once('./config/conexion.php');
class Departamento{
    public static function getDepartamento($provincia){
        return BaseDeDatos::consulta("SELECT * FROM departamento WHERE FK_idProvincia = $provincia");
    }

    public static function getDepartamentoProvincia($provincia,$departamento){
        return BaseDeDatos::consulta("SELECT * FROM departamento WHERE FK_idProvincia = $provincia AND '$departamento' = Departamento");
    }
}