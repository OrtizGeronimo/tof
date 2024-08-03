<?php
require_once('../config/conexion.php');
class TagsServicio{
    public static function getTagsServicio(){
        $getTagsServicio = BaseDeDatos::consulta("SELECT * FROM servicio_tags");

        return $getTagsServicio;                                                  
    }

    public static function agregarTagsServicio($tags,$idServicio){
        $agregarTagsServicio = BaseDeDatos::consulta("INSERT INTO servicio_tags (tags,FK_idServicio,usr_alta,fec_alta) VALUES ('$tags',$idServicio,'DESARROLLO',now());");

        return $agregarTagsServicio;                                                  
    }
}
