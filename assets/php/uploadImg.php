<?php
require('./../models/galeria.php');

class Imagen {
    public static function upload($files,$nameFile,$dir){
        
        try {
            $imagen = $files;
        
            $rutaImg = $dir.'/'.preg_replace('/[^a-zA-Z0-9._ ]/', '', $nameFile).'.webp';
            
            if (file_exists($rutaImg)) {
                unlink($rutaImg); // Elimina el archivo si ya existe
            }
            if (!move_uploaded_file($imagen['tmp_name'], $rutaImg)) {
                echo "Failed to move uploaded file to: " . $rutaImg;
                return false;
            } else {
                return true;
                echo "Image uploaded successfully to: " . $rutaImg;
            }
        } catch (\Throwable $th) {
            echo $files["name"]."----";
            echo "error de permisos y eliminacion de imagen: ".$th;
        }
        
        
    }


    public static function uploadGallery($files,$username,$dir,$idServicio, $hasFreePlan){
        try {

            $result = Galeria::getGaleria($idServicio);

            if ($result && $hasFreePlan) {
                while ($row = mysqli_fetch_array($result)) {
                    var_dump($row);  // Debugging
                    $rutaImg = Galeria::formulateFileNameToAbsolutePath($row, $username);
                    
                    if (file_exists($rutaImg)) {
                        array_map('unlink', glob($rutaImg));
                        unlink($rutaImg); // Elimina el archivo
                        $borrar = Galeria::borrarItemGaleria($row["id"]);
                    }
                }
            } else {
                echo "No records found.";
            }
/*
            $borrar = Galeria::borrarGaleria($idServicio);
            
            if ($borrar === false){
                echo "Failed to delete gallery images";
                return false;
            }*/
            $dir = Galeria::formulateFileNameToAbsolutePathGalleryFolder($username);
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true); // Crea el directorio si no existe, incluyendo directorios padres
            }
            for($i=0;$i<count($files["name"]);$i++){
                
                $name_img = $username.'_';
                $response = Galeria::agregarGaleria($name_img,$idServicio);
                $nameAfterSave = Galeria::getLastInserted($idServicio);
                $completeName = ["img" => $nameAfterSave];
                $rutaImg = Galeria::formulateFileNameToAbsolutePath($completeName, $username);
                if (file_exists($rutaImg)) {
                    array_map('unlink', glob($rutaImg));
                    unlink($rutaImg); // Elimina el archivo si ya existe
                }
                echo "<br>uploading".$files["name"][$i]."---->".$rutaImg;
                move_uploaded_file($files['tmp_name'][$i], $rutaImg);
                if($response === false){
                    return false;
                } 
            }
            return true;

        
            
        } catch (\Throwable $th) {
            echo $files["name"]."----";
            echo "error de permisos y eliminacion de imagen: ".$th;
        }    
    }

    public static function uploadExistingGallery($files,$username,$dir,$idServicio){
        try {
            echo "ejecutando uploadExistingGallery";

            if (!file_exists($dir)) {
                mkdir($dir, 0777, true); // Crea el directorio si no existe, incluyendo directorios padres
            }

            $response = false;

            $result = Galeria::getGaleria($idServicio);
            
            //$borrar = Galeria::borrarGaleria($idServicio);

            while ($row = mysqli_fetch_array($result)) {
                $rutaImg = Galeria::formulateFileNameToAbsolutePath($row, $username);
                $name = basename($rutaImg);
                
                if (file_exists($rutaImg) && !in_array($name, $files)) {
                    echo "<br>eliminando archivo.. ".$name."<br>";
                    array_map('unlink', glob($rutaImg));
                    unlink($rutaImg); // Elimina el archivo
                    $borrar = Galeria::borrarItemGaleria($row["id"]);
                    if ($borrar === false){
                        echo "Failed to delete gallery images";
                        return false;
                    }
                    continue;
                }
                
                /*$response = Galeria::agregarGaleria($username."_",$idServicio);
                if($response === false){
                    return false;
                }*/
            }

            

            if ($borrar === false){
                echo "Failed to delete gallery images";
                return false;
            }

            return true;
            
        } catch (\Throwable $th) {
            echo $files["name"]."----";
            echo "error de permisos y eliminacion de imagen: ".$th;
        }    
    }
}