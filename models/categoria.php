<?php
(file_exists("../config/conexion.php"))? require_once('../config/conexion.php') : require_once('./config/conexion.php');

class Categoria{

    public static function getCategoria(){
        $categoria = BaseDeDatos::consulta(" SELECT c.tipo,count(*) AS cantidad_servicios
                                                FROM categoria_servicio cs,categoria c
                                                WHERE c.idCategoria = cs.FK_idCategoria
                                                AND cs.fec_baja IS NULL
                                                GROUP BY c.tipo;");
        return $categoria;

    }

    public static function buscarCategoria($categoria){
        $getCategoriaTipo = BaseDeDatos::consulta(" SELECT * FROM categoria WHERE '$categoria' = tipo;");
        return $getCategoriaTipo;
    }

    public static function traerCategoria(){
        $traerCategoria = BaseDeDatos::consulta(" SELECT * FROM categoria");
        return $traerCategoria;
    }
}