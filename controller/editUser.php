<?php
    header("Content-Type: application/json");
    session_start();
    require('./../models/usuario.php');
    require('./../models/categoria.php');
    require('./../models/servicio.php');
    require('./../models/suscripcionServicio.php');
    require_once('./../models/galeria.php');
    require('./../assets/php/uploadImg.php');
    require_once './../vendor/autoload.php';

    use MercadoPago\Exceptions\MPApiException;
    use MercadoPago\Client\PreApproval\PreApprovalClient;
    use MercadoPago\MercadoPagoConfig;

    $dotenv = Dotenv\Dotenv::createImmutable("./../config/");
    $dotenv->load();
    $access_token = $_ENV['ACCESS_TOKEN'] ?? null;

    MercadoPagoConfig::setAccessToken($access_token);

    $newUser = $_POST;
    $newUserImg = $_FILES["imgLogo"];

    if($newUser["nombre"] != null && $newUser["apellido"] != null && $newUser["email"] != null && $newUser["nombreUsuario"] != null){
        //var_dump($newUser);

        $name_img = "user_profile";
        $dir_img = ($newUserImg["name"] != "") 
                        ? "./../archivos/user_".$newUser["nombreUsuario"].""
                        : "--";
        if($dir_img!="--"){
            if(!file_exists($dir_img))
                mkdir($dir_img,0777,true);
            Imagen::upload($newUserImg,$name_img,$dir_img);
            $clean_name_img = preg_replace('/[^a-zA-Z0-9._ ]/', '', $name_img);
            $img_url = "$dir_img/$clean_name_img.webp";
        } else {
            $img_url = "";
        }
        try {

            if($newUser["plan"] === "gratis" && $newUser["plan"] !== $newUser["planActual"]){
                $idUsuario = $newUser["idUsuario"];
                $suscripcion = SuscripcionServicio::getSuscripcion($idUsuario);
                if(mysqli_num_rows($suscripcion) > 0){

                    $idSuscripcion = mysqli_fetch_array($suscripcion)["id_suscripcion"];
                    $Servicio = Servicio::getServicioByUsuarioId($idUsuario);                
                    if(mysqli_num_rows($Servicio) > 0){
                        $idServicio = mysqli_fetch_array($Servicio)["idServicio"];
                    }else{
                        $idServicio = null;
                    }
                    $preapproval_plan = new PreApprovalClient();    
                    //se llama a mp
                    //$preapproval = $preapproval_plan->get($idSuscripcion);

                    //cancelar suscripcion
                    $preapproval_plan->update($idSuscripcion, [
                        "status" => "cancelled"
                    ]);
                    //si pasa de plan pago a gratuito solo se cancela la suscripcion y se limitan beneficios
                    
                    
                    if($idServicio !== null){
                        //le damos fecha de baja a todas las categorias al plan gratuito (dejamos solo 1)
                        Categoria::updateCategoriasToFree($idServicio);
                        //le modificamos la foto del servicio por la generica de su categoria y la de banner
                        Servicio::downgradeToFree($idUsuario, $idServicio);
                        //le damos fecha de baja a todas las fotos de la galeria al plan gratuito (dejamos solo 1)
                        Galeria::downgradeToFreePlan($idUsuario);
                    }                
                    
                    //damos de baja la suscripcion (baja logica para no perder el dato)
                    SuscripcionServicio::logicDeleteSuscripcion($idUsuario);
                }
            }

            $user = Usuario::updateUsuario($newUser["nombreUsuario"],
                                            $newUser["newpassword"],
                                            $newUser["email"],
                                            $img_url,
                                            $newUser["telefono"],
                                            $newUser["nombre"].' '.$newUser["apellido"],
                                            $_SESSION["s_nombre_usuario"],
                                            $newUser["idUsuario"],
                                            $newUser["plan"]);
                                            
            if($user){

                if($newUser["plan"] !== $newUser["planActual"] && $newUser["plan"] != "gratis" && strtoupper($_SESSION["s_rol"]) == "ADMIN"){
                    Usuario::actualizarFechaPlan($lastUser["idUsuario"]);
                }

                $lastUser = Usuario::getUsuariosEmail($newUser["email"]);
                $lastUser = mysqli_fetch_array($lastUser);

                if(strtoupper($_SESSION["s_rol"]) != "ADMIN"){
                    $_SESSION["s_id_usuario"] = $lastUser["idUsuario"];
                    $_SESSION["s_nombre"]     = $newUser["nombre"];
                    $_SESSION["s_nombre_usuario"] = $newUser["nombreUsuario"];
                    $_SESSION["s_img_perfil"] =  'archivos/user_'.$newUser["nombreUsuario"].'/user_profile.webp';
                    $_SESSION["s_rol"]     = $newUser["plan"];
                }                

                $id_usuario = $lastUser["idUsuario"];

                header("Content-Type: application/json");
                
                $data = [
                    "status" => "success",
                    "message" => "El usuario se modifico correctamente",
                    "idUsuario" => $id_usuario
                ];            
            
                echo json_encode($data);
            }else{
                $data = [
                    "status" => "error",
                    "message" => "Hubo un error modificando al usuario",
                    "user" => $user
                ];                
                
                echo json_encode($data);                
            }

            //header('Location: ./../editUser.php?success');
        }catch (MPApiException $e) {
            echo json_encode($e->getApiResponse()->getContent());
        } catch (\Throwable $th) {
            $data = [
                "status" => "error",
                "message" => "Exception: Hubo un error modificando al usuario",
                "user" => $th
            ];
            
            echo json_encode($data);
        } 
        
    //}else{
      //  header('Location: ./../editUser.php?error');
    }