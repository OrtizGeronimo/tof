<?php

class BaseDeDatos{
    
    public static function consulta($query){
        $HOST            = "127.0.0.1";
        $USER_DATABASE   = "root";
        $PASS_DATABASE   = "root";
        $SCHEMA_DATABASE = "todoofi_bd";
        
        $conn = mysqli_connect($HOST,$USER_DATABASE,$PASS_DATABASE,$SCHEMA_DATABASE);
        mysqli_set_charset($conn, "utf8");

        if(!$conn){
            die("No se pudo conectar a la base de datos");
        }
        
        $resultado = mysqli_query($conn,$query);
        mysqli_close($conn);
        return $resultado;
    }
}