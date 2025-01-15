<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require('./../vendor/autoload.php');

require('./../models/usuario.php');
require('./../assets/php/generatePassword.php');

if(isset($_POST["email"])){
    $email = $_POST["email"];
    $user = Usuario::getUsuariosEmail($email);

    if(mysqli_num_rows($user) == 1){
        $pass = new passwordGenerator(20,20);
        $forgotPassword = $pass->generate();
        $user = mysqli_fetch_array($user);
        //var_dump($user);
        //echo $forgotPassword;

        $setForgotPassword = Usuario::setForgotPasswordUser($email,$forgotPassword);
        $forgotPasswordMd5 = md5($forgotPassword);
        if($setForgotPassword){
            $mail = new PHPMailer(true);
            try{
                // Configure PHPMailer
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                // Configure SMTP Server
                $mail->Host     = 'smtp.gmail.com';
                $mail->Username = 'todooficio.com@gmail.com';
                $mail->Password = 'jcviunimnwkuyted';

                // Configure Email
                $mail->setFrom('administracion@todooficio.com', 'Todo Oficio');
                $mail->addAddress($user["user_email"]);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'Restablecer contraseña TodoOficio';
                $mail->isHTML(true);
                $mail->Body = "<html>
                                <head>
                                <title>Todo Oficio</title>
                                </head>
                                <body>
                                <p>Hola ".$user["user_nombre"]."! <br><br>
                                    Recibimos una solicitud de recupero de contrase&ntilde;a. <br><br>
                                    Hace click aca para <b><a href='https://www.todooficio.com/reestablecerContrasenia.php?d=$forgotPasswordMd5'> Recuperar Contrase&ntilde;a </a></b> <br><br> 
                                    O pega este link en el navegador <a href='https://www.todooficio.com/reestablecerContrasenia.php?d=$forgotPasswordMd5'>www.todooficio.com/reestablecerContrasenia.php?d=$forgotPasswordMd5</a> <br><br>                                    
                                </p>
                                <img src='https://todooficio.com/assets/img/logos/logoAmarilloSinFondo.png'  style='width:250px'alt=''>
                                </body>
                                </html>";
                //$mail->SMTPDebug = 2; // 2 para ver información detallada de la conexión SMTP
                //$mail->Debugoutput = 'html'; // O 'echo' si prefieres verlo en el navegador
                $mail->Debugoutput = 'echo';
                $mail->send();
                echo "Se envio un correo para recuperar la contraseña. Por favor revise su casilla de mensajes.";
            }catch (Exception $e){
                echo "No se pudo enviar el mail. Por favor intente mas tarde o contactese con el Administrador de Todo Oficio";
            }
        }else{
            echo "Hubo un problema al tratar de reestablecer la nueva contraseña. Intente mas tarde o contactese con el Administrador de la pagina";
        }
        
    }else{
        echo "El mail ingresado no existe";
    }
}

