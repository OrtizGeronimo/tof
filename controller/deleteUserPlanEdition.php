<?php
require('./../models/usuario.php');

(file_exists('./config/conexion.php'))?include_once('./config/conexion.php'):include_once('./../config/conexion.php');
(file_exists("./../config/conexion.php"))? require_once('./../config/conexion.php') : require_once('./config/conexion.php');

$user = $_POST;

if ($user) {

    $idRol = Usuario::rolByName($user['planActual']);
    $idUsuario = $user['idUsuario'];

    $result = BaseDeDatos::consulta("UPDATE usuario
                                     SET FK_idRol = '$idRol'
                                     WHERE idUsuario = '$idUsuario'");   

    // Check if the query affected any rows
    if ($result && mysqli_affected_rows(BaseDeDatos::getConn()) > 0) {
        $_SESSION["s_rol"] = $user['planActual'];
        echo "User deleted successfully";
    } else {
        echo "Error deleting user or no rows affected";
    }
}
?>