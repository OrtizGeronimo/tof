<?php
    // Incluir el archivo de logging
    include 'logger.php';

    session_start();
    require('./../models/usuario.php');
    require('./../assets/php/uploadImg.php');
    $newUser = $_POST;
    $newUserImg = $_FILES["imgLogo"];
    
    if($newUser["nombre"] != null && $newUser["apellido"] != null && $newUser["email"] != null && $newUser["nombreUsuario"] != null){
        var_dump($newUser);
        
        $name_img = "user_profile";
        $dir_img = ($newUserImg["name"] != "") 
                        ? "./../archivos/user_".$newUser["nombreUsuario"].""
                        : "--";
        if($dir_img!="--"){
            if(!file_exists($dir_img)){
                mkdir($dir_img,7777,true);
            }
            Imagen::upload($newUserImg,$name_img,$dir_img);
            $clean_name_img = preg_replace('/[^a-zA-Z0-9._ ]/', '', $name_img);
            $img_url = "$dir_img/$clean_name_img.webp";
        } else {
            $img_url = "";
        }

        try {
            $user = Usuario::updateUsuario($newUser["nombreUsuario"],
                                            $newUser["newpassword"],
                                            $newUser["email"],
                                            $img_url,
                                            $newUser["telefono"],
                                            $newUser["nombre"].' '.$newUser["apellido"],
                                            $_SESSION["s_nombre_usuario"],
                                            $newUser["idUsuario"]);
            if($user){
                $lastUser = Usuario::getLastUsuario();
                $lastUser = mysqli_fetch_array($lastUser);
                $_SESSION["s_id_usuario"] = $lastUser["idUsuario"];
                $_SESSION["s_nombre"]     = $newUser["nombre"];
                $_SESSION["s_nombre_usuario"] = $newUser["nombreUsuario"];
                $_SESSION["s_rol"]        = 'basico';
                $_SESSION["s_img_perfil"] =  'archivos/user_'.$newUser["nombreUsuario"].'/user_profile.webp';
            }                                          

            header('Location: ./../editUser.php?success');
        } catch (\Throwable $th) {
            header('Location: ./../editUser.php?error');
        }
        
    }else{
        header('Location: ./../editUser.php?error');
    }