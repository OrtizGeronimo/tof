<?php
(file_exists("./../config/conexion.php"))? require_once('./../config/conexion.php') : require_once('./config/conexion.php');
class Provincia{
    /**
     * Trae la provincia con la cantidad de servicio por provincia
     */
    public static function getProvincia(){
        return BaseDeDatos::consulta('SELECT p.provincia_name, 
                                             COUNT(p.provincia_name) AS cantidad_servicios
                                        FROM Provincia p,
                                             Servicio s
                                        WHERE p.idProvincia = s.FK_idProvincia
                                        AND s.fec_baja IS NULL
                                        GROUP BY p.provincia_name'
                                    );
    }

    public static function buscarProvincia($provincia){
        return BaseDeDatos::consulta("SELECT * FROM provincia WHERE '$provincia' = provincia_name;");
    }

    public static function traerProvincia(){
        return BaseDeDatos::consulta("SELECT * FROM provincia");
    }
}
