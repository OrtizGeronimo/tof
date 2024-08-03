<?php
include_once('./config/conexion.php');
class Tag {
    public static function getTags(){
        return BaseDeDatos::consulta("SELECT DISTINCT tags 
                                      FROM servicio_tags"
                                    );
    }
}