<?php
require('./../models/usuario.php');
// var_dump($_POST);
$password = $_POST['newPassword'];
$forgotPassword = $_POST['forgotPassword'];

$cantUser = Usuario::getUsuarioWithForgotPassword($forgotPassword);

if(mysqli_num_rows($cantUser) == 1){
    $user = mysqli_fetch_row($cantUser);

    if(Usuario::setPassword($password,$user[1],$forgotPassword)){
        echo "Se reestablecio la contraseña correctamente";
    }else{
        echo "Hubo un problema al reestablecer la contraseña";
    }
}else{
    echo "Hubo un problema al reestablecer la contraseña";
}