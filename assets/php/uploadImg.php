<?php

class Imagen {
    public static function upload($files,$nameFile,$dir){
        
        try {
            $imagen = $files;
            $_img = explode('.',$imagen["name"]);//Obtengo la extension de la imagen
        
            $rutaImg = $dir.'/'.preg_replace('/[^a-zA-Z0-9._ ]/', '', $nameFile).'.webp';
            
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true); // Crea el directorio si no existe, incluyendo directorios padres
            }
        
            if (file_exists($rutaImg)) {
                unlink($rutaImg); // Elimina el archivo si ya existe
            }
        
            move_uploaded_file($imagen['tmp_name'], $rutaImg);
        } catch (\Throwable $th) {
            // echo "error de permisos y eliminacion de imagen: ".$th;
        }
        
        
    }
}