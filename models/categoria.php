<?php
//(file_exists("../config/conexion.php"))? require_once('../config/conexion.php') : require_once('./config/conexion.php');
(file_exists("./../config/conexion.php"))? require_once('./../config/conexion.php') : ((file_exists('./config/conexion.php')) ? require_once('./config/conexion.php') : require_once('../../config/conexion.php'));

class Categoria{

    public static function getCategoria(){
        $categoria = BaseDeDatos::consulta(" SELECT c.tipo,count(*) AS cantidad_servicios
                                                FROM categoria_servicio cs,categoria c
                                                WHERE c.idCategoria = cs.FK_idCategoria
                                                AND cs.fec_baja IS NULL
                                                GROUP BY c.tipo;");
        return $categoria;

    }

    public static function getAllCategorias(){
        $categoria = BaseDeDatos::consulta(" SELECT * FROM categoria ORDER BY tipo;");
        return $categoria;
    }

    public static function getCategoriaServicio(){
        $categoria = BaseDeDatos::consulta(" SELECT * FROM categoria_servicio WHERE fec_baja IS NULL;");
        return $categoria;
    }

    public static function buscarCategoria($categoria){
        $getCategoriaTipo = BaseDeDatos::consulta(" SELECT * FROM categoria WHERE '$categoria' = tipo;");
        return $getCategoriaTipo;
    }

    public static function traerCategoria(){
        $traerCategoria = BaseDeDatos::consulta(" SELECT * FROM categoria ORDER BY tipo;");
        return $traerCategoria;
    }

    public static function getCategoriasByUser($idServicio){
        $categorias = BaseDeDatos::consulta("SELECT *
                                            FROM categoria_servicio 
                                            WHERE FK_idServicio = $idServicio
                                            AND fec_baja IS NULL;");
        return $categorias;
    }

    public static function updateCategoriasToFree($idServicio){
        $firstCategory = BaseDeDatos::consulta("SELECT * from categoria_servicio WHERE FK_idServicio = $idServicio LIMIT 1;");
        if (mysqli_num_rows($firstCategory) > 0) {
            $idCategoria = mysqli_fetch_array($firstCategory)["FK_idCategoria"];

            $updateCategorias = BaseDeDatos::consulta("UPDATE categoria_servicio SET fec_baja = NOW() WHERE FK_idServicio = $idServicio AND FK_idCategoria != $idCategoria;");

            return $updateCategorias;
        }else{
            return true;
        }
    }

    public static function downgradeCategoriasToBasic($idServicio){
        $firstThreeCategories = BaseDeDatos::consulta("SELECT * from categoria_servicio WHERE FK_idServicio = $idServicio LIMIT 2;");
        if (mysqli_num_rows($firstThreeCategories) > 0) {
            $idsCategoria = [];
            while ($row = mysqli_fetch_array($firstThreeCategories)) {
                $idsCategoria[] = $row["FK_idCategoria"];
            }

            if (count($idsCategoria) > 0) {
                $idsCategoriaStr = implode(',', $idsCategoria);
                $updateCategorias = BaseDeDatos::consulta("UPDATE categoria_servicio SET fec_baja = NOW() WHERE FK_idServicio = $idServicio AND FK_idCategoria NOT IN ($idsCategoriaStr);");
            } else {
                $updateCategorias = false;
            }

            return $updateCategorias;
        }else{
            return true;
        }
    }
}