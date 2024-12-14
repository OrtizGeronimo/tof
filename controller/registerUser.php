<?php
    session_start();
    require('./../models/usuario.php');
    require('./../assets/php/uploadImg.php');
    $newUser = $_POST;
    $newUserImg = $_FILES["imgLogo"];
    $dateUserNull = true;
    $existUser = Usuario::getUsuarios($newUser["nombreUsuario"]);
    $existMail = Usuario::getUsuariosEmail($newUser["email"]);
    
    /*if(mysqli_num_rows($existUser) > 0)
    {
        $data = [
            "status" => "error",
            "message" => "Este nombre de usuario ya esta siendo utilizado. Por favor use otro",
            "user" => $newUser
        ];
        
        
        echo json_encode($data);
        exit();
    }
    else if(mysqli_num_rows($existMail) > 0)
    {
        $data = [
            "status" => "error",
            "message" => "Este mail ya esta siendo utilizado. Por favor use otro",
            "user" => $newUser
        ];
        
        
        echo json_encode($data);
        exit();
    }*/
    
    if($newUser["nombre"] != null && $newUser["apellido"] != null && $newUser["email"] != null && $newUser["nombreUsuario"] != null && $newUser["newpassword"] != null && $newUser["renewpassword"] != null)
    {
        $name_img = "user_profile";
        $dir_img = ($newUserImg["name"] != "") 
                        ? "./../archivos/user_".$newUser["nombreUsuario"].""
                        : "--";
        
        try {
            if($dir_img!="--"){
                if(!file_exists($dir_img))
                    mkdir($dir_img,0777,true);
                Imagen::upload($newUserImg,$name_img,$dir_img);
            }
        } catch (\Throwable $th) {
            $data = [
                "status" => "error",
                "message" => "Exception: Hubo un error registrando al usuario",
                "user" => $th
            ];

            echo json_encode($data);
        }
        

        try {
            $user = Usuario::agregarUsuarios($newUser["nombreUsuario"],
                                            $newUser["newpassword"],
                                            $newUser["email"],
                                            "$dir_img".($dir_img!="--")? "/$name_img.webp" : "",
                                            "--",
                                            $newUser["telefono"],
                                            $newUser["nombre"].' '.$newUser["apellido"],
                                            $newUser["plan"]);  
            if($user){
                $lastUser = Usuario::getLastUsuario();
                $lastUser = mysqli_fetch_array($lastUser);
                $_SESSION["s_id_usuario"] = $lastUser["idUsuario"];
                $_SESSION["s_nombre"]     = $newUser["nombre"];
                $_SESSION["s_nombre_usuario"] = $newUser["nombreUsuario"];
                $_SESSION["s_rol"]     = $newUser["plan"];
                $_SESSION["s_img_perfil"] = ($dir_img!="--")? 'archivos/user_'.$newUser["nombreUsuario"].'/user_profile.webp' : "";
                
                header("Content-Type: application/json");
                

                $newUserAccurate = mysqli_fetch_array(Usuario::getLastUsuarioAccurate($newUser["email"])); 
                $data = [
                    "status" => "success",
                    "message" => "El usuario se creó correctamente",
                    "idUsuario" => $newUserAccurate["idUsuario"]
                ];
                
                
                echo json_encode($data);

                //echo '1';
                // header("Location: ./../admin/newService.php");
                
            }else{
                $data = [
                    "status" => "error",
                    "message" => "Hubo un error registrando al usuario",
                    "user" => $user
                ];
                
                
                echo json_encode($data);
                
            }
        } catch (\Throwable $th) {
            $data = [
                "status" => "error",
                "message" => "Exception: Hubo un error registrando al usuario",
                "user" => $th
            ];
            
            echo json_encode($data);
            // header("Location: ./../registerUser.php");
        }   
    }