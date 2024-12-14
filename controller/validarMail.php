<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require('./../vendor/autoload.php');
require('./../models/usuario.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['nombreUsuario'])) {
    $email = trim($_POST['email']);
    $nombreUsuario = trim($_POST['nombreUsuario']);

    $existUser = Usuario::getUsuarios($nombreUsuario);
    $existMail = Usuario::getUsuariosEmail($email);

    if(mysqli_num_rows($existUser) > 0)
    {
        /*$data = [
            "status" => "error",
            "message" => "Este nombre de usuario ya esta siendo utilizado. Por favor use otro",
            "user" => $newUser
        ];*/
        echo json_encode(['success' => false, 'message' => 'Este nombre de usuario ya esta siendo utilizado. Por favor use otro.', 'nombreUsuario' => $nombreUsuario, 'email' => $email]);
        exit();
    }
    else if(mysqli_num_rows($existMail) > 0)
    {
        /*$data = [
            "status" => "error",
            "message" => "Este mail ya esta siendo utilizado. Por favor use otro",
            "user" => $newUser
        ];*/
        echo json_encode(['success' => false, 'message' => 'Este mail ya esta siendo utilizado. Por favor use otro.']);
        exit();
    }
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Generar un código aleatorio
        $codigo = rand(100000, 999999);  // Un código de 6 dígitos

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
            $mail->addAddress($email);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Código de verificación';
            $mail->isHTML(true);
            $mail->Body = "<html>
                            <head>
                            <title>Todo Oficio</title>
                            </head>
                            <body>
                            <p>Bienvenido a Todo Oficio! <br><br>
                                Te enviamos un código de confirmación para validar la direccion de correo electrónico ingresada. <br><br>
                                El código de verificacion es: " . $codigo . "</b> <br><br> 
                                Ingresalo en la pantalla emergente para continuar con el proceso de registro. <br><br>                                    
                            </p>
                            <img src='https://todooficio.com/assets/img/logos/logoAmarilloSinFondo.png'  style='width:250px'alt=''>
                            </body>
                            </html>";
            //$mail->SMTPDebug = 2; // 2 para ver información detallada de la conexión SMTP
            //$mail->Debugoutput = 'html'; // O 'echo' si prefieres verlo en el navegador
            //$mail->Debugoutput = 'echo';
            $mail->send();

            // Responder al frontend con el código generado
            echo json_encode(['success' => true, 'codigo' => $codigo, 'nombreUsuario' => $nombreUsuario, 'email' => $email, 'existUser' => mysqli_num_rows($existUser), 'existMail' => mysqli_num_rows($existMail)]); // Aquí devolvemos el código

        } catch (Exception $e) {
            // Si hay un error, devolvemos un mensaje
            echo json_encode(['success' => false, 'message' => 'No se pudo enviar el mail. Por favor intente más tarde o contacte al administrador.']);
        }
    }   
} else {
    // Si el email no es válido
    echo json_encode(['success' => false, 'message' => 'El correo electrónico no es válido.']);
}
?>