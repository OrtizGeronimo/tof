<?php
(file_exists('./config/conexion.php'))?include_once('./config/conexion.php'):include_once('./../config/conexion.php');
(file_exists("./../config/conexion.php"))? require_once('./../config/conexion.php') : require_once('./config/conexion.php');

$email = $_POST['email'];

if ($email) {
    
    $result = BaseDeDatos::consulta("DELETE FROM usuario WHERE user_email = '$email'");
    

    // Check if the query affected any rows
    if ($result && mysqli_affected_rows(BaseDeDatos::getConn()) > 0) {
        echo "User deleted successfully";
    } else {
        echo "Error deleting user or no rows affected";
    }
}
?>