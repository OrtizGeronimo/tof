<?php
    session_start();
    require('./../models/usuario.php');
    require('./../assets/php/uploadImg.php');
    $newUser = $_POST;
    $newUserImg = $_FILES["imgLogo"];
    $dateUserNull = true;
    $existUser = Usuario::getUsuarios($newUser["nombreUsuario"]);
    $existMail = Usuario::getUsuariosEmail($newUser["email"]);
    
    if(mysqli_num_rows($existUser) > 0)
    {
        echo 'Este nombre de usuario ya esta utilizado. Por favor use otro';
        exit();
    }
    else if(mysqli_num_rows($existMail) > 0)
    {
        echo 'Este mail ya esta siendo utilizado. Por favor use otro';
        exit();
    }
    
    if($newUser["nombre"] != null && $newUser["apellido"] != null && $newUser["email"] != null && $newUser["nombreUsuario"] != null && $newUser["newpassword"] != null && $newUser["renewpassword"] != null)
    {
        $name_img = "user_profile";
        $dir_img = ($newUserImg["name"] != "") 
                        ? "./../archivos/user_".$newUser["nombreUsuario"].""
                        : "--";
        
        try {
            if($dir_img!="--"){
                if(!file_exists($dir_img))
                    mkdir($dir_img,7777,true);
                Imagen::upload($newUserImg,$name_img,$dir_img);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        

        try {
            $user = Usuario::agregarUsuarios($newUser["nombreUsuario"],
                                            $newUser["newpassword"],
                                            $newUser["email"],
                                            "$dir_img".($dir_img!="--")? "/$name_img.webp" : "",
                                            "--",
                                            $newUser["telefono"],
                                            $newUser["nombre"].' '.$newUser["apellido"]);  
            if($user){
                $lastUser = Usuario::getLastUsuario();
                $lastUser = mysqli_fetch_array($lastUser);
                $_SESSION["s_id_usuario"] = $lastUser["idUsuario"];
                $_SESSION["s_nombre"]     = $newUser["nombre"];
                $_SESSION["s_nombre_usuario"] = $newUser["nombreUsuario"];
                $_SESSION["s_rol"]        = 'basico';
                $_SESSION["s_img_perfil"] = ($dir_img!="--")? 'archivos/user_'.$newUser["nombreUsuario"].'/user_profile.webp' : "";
                
                echo '1';
                // header("Location: ./../admin/newService.php");
                
            }else{
                echo 'No se pudo crear el usuario';
                exit();
            }
        } catch (\Throwable $th) {
            echo '<p>Hubo un problema con la registracion del usuario<p>';
            // header("Location: ./../registerUser.php");
        }   
    }