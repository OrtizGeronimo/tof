<?php 
(file_exists('./config/conexion.php'))?include_once('./config/conexion.php'):include_once('./../config/conexion.php');
(file_exists("./../config/conexion.php"))? require_once('./../config/conexion.php') : require_once('./config/conexion.php');

class Galeria{
    public static function getGaleria($idServicio){
        $getGaleria = BaseDeDatos::consulta("SELECT * FROM galeria WHERE FK_idServicio = $idServicio");

        return $getGaleria;                                                  
    }

    public static function agregarGaleria($imagenRuta, $idServicio){
        $conn = BaseDeDatos::getConn();
        mysqli_begin_transaction($conn);
        
        try {
            $agregarGaleria = BaseDeDatos::consulta("INSERT INTO galeria (FK_idServicio, fec_alta) VALUES ('$idServicio',now());");
    
            $last_id = mysqli_insert_id($conn);
    
            $nameImg = $imagenRuta.$last_id.".webp";
    
            $agregarGaleria = BaseDeDatos::consulta("UPDATE galeria SET img = '$nameImg' WHERE id = $last_id");
    
            mysqli_commit($conn);
    
            return $agregarGaleria;
        } catch (Exception $e) {
            mysqli_rollback($conn);
            throw $e;
        }
    }

    public static function getLastInserted($idServicio){
        $name = BaseDeDatos::consulta("SELECT img FROM galeria WHERE FK_idServicio = $idServicio ORDER BY id DESC LIMIT 1");
        $name = mysqli_fetch_array($name);
        return $name[0];
    }

    public static function borrarGaleria($idServicio){
        return BaseDeDatos::consulta("DELETE FROM galeria WHERE FK_idServicio = $idServicio");
    }

    public static function borrarItemGaleria($id){
        return BaseDeDatos::consulta("DELETE FROM galeria WHERE id = $id");
    }

    public static function getFileName($img, $servicio){
        $dir = './archivos/user_'.($servicio["user_login"]).'/galeria/'.($img["img"]).'';
        return $dir;
    }

    public static function formulateFileName($img, $usr){
        $dir = './archivos/user_'.($usr).'/galeria/'.($img["img"]).'';
        return $dir;   
    }

    public static function formulateFileNameToAbsolutePath($img, $usr){
        $projectPath = str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__);
        $segments = explode('/', trim($projectPath, '/'));
        $projectName = $segments[0];
        $dir = $_SERVER['DOCUMENT_ROOT']."/".$projectName.'/archivos/user_'.($usr).'/galeria/'.($img["img"]).'';
        return $dir;   
    }

    public static function formulateFileNameToAbsolutePathGalleryFolder($usr){
        $projectPath = str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__);
        $segments = explode('/', trim($projectPath, '/'));
        $projectName = $segments[0];
        $dir = $_SERVER['DOCUMENT_ROOT']."/".$projectName.'/archivos/user_'.($usr).'/galeria/';
        return $dir;   
    }
}

?>