<?php
session_start();
require('./../models/servicio.php');
require('./../assets/php/uploadImg.php');
$servicio = $_POST;




if($servicio["nombreServicio"] != null && $servicio["telefono"]!= null && $servicio["descripción"] != null && $servicio["categoria"]!= null && $servicio["provincia"] != null && $servicio["departamento"] != null && isset($_SESSION["s_id_usuario"]) && isset($_SESSION["s_nombre"])){
    $modelServicio = new Servicio();
    
    $usr_servicio = $modelServicio::getServicio($servicio["idServicio"]);
    $usr_servicio = mysqli_fetch_array($usr_servicio);

    $nameImgServicio = preg_replace('/[^a-zA-Z0-9._ ]/', '', 'service_'.$usr_servicio["user_login"]);   
    $nameBannerServicio = preg_replace('/[^a-zA-Z0-9._ ]/', '', 'imgBanner_'.$usr_servicio["user_login"]);
    $hasFreePlan = $usr_servicio["FK_idRol"] == 6 ? true : false;
    $updateServicio = $modelServicio::updateServicio($servicio["idServicio"],$servicio["nombreServicio"],$servicio["descripción"],$servicio["emailContacto"],$servicio["telefono"],$servicio["sitioWeb"],$nameImgServicio.'.webp',$nameBannerServicio.'.webp',$servicio["provincia"],$servicio["departamento"],$_SESSION["s_id_usuario"],$_SESSION["s_nombre"]);

    Servicio::deleteCategoriaServicio($servicio["idServicio"],$_SESSION["s_nombre"]);
    foreach ($servicio["categoria"] as $key => $idCategoria) {
        $updateCategoriaServicio = $modelServicio::updateCategoriaServicio($servicio["idServicio"],$idCategoria,$_SESSION["s_nombre"]);
    }
    if($hasFreePlan){
        $updateCategoriaServicio = $modelServicio::updateGenericImg("category_".$servicio["categoria"][0].".webp", $servicio["idServicio"]);
    }

    $redes = $servicio["redes"];
    $instagram = ($redes["instagram"] == "")? 'null' : $redes["instagram"];
    $linkedin  = ($redes["linkedin"] == "")? 'null' : $redes["linkedin"];
    $facebook  = ($redes["facebook"] == "")? 'null' : $redes["facebook"];

    if($servicio["idRedSocial"] !== ""){
        $updateRedSocial = $modelServicio::updateRedSocial($instagram,$linkedin,$facebook,$servicio["idRedSocial"],$_SESSION["s_nombre"]);
    }else{
        $updateRedSocial = $modelServicio::addRedesSociales($instagram,$linkedin,$facebook,$servicio["idServicio"],$_SESSION["s_nombre"]);
    }

    $updateTipoServicio = $modelServicio::updateTipoServicio($servicio["tipo"],$servicio["idTipoServicio"],$_SESSION["s_nombre"]);

    $horarios = $servicio["horarios"];

    $horarios = $servicio["horarios"];
    foreach($horarios as $dia => $tipoHorario){
        if(strtoupper($tipoHorario) !== "INGRESAR HORARIOS"){
            if(isset($servicio["idHorario$dia"])){  
                $updateHoraServicio = $modelServicio::updateHoraServicio($tipoHorario,"--",$servicio["idHorario$dia"],$dia,$_SESSION["s_nombre"]);
            }else{
                $updateHoraServicio = $modelServicio::addHorariosServicios($tipoHorario,"--",$servicio["idServicio"],$dia,$_SESSION["s_nombre"]);
            }
        }else{
            for($i=0;$i<2;$i++){ //Se utiliza para recorrer las dos franjas horarias. 
                if(isset($servicio["idHorario$i$dia"]) && isset($servicio["desde$i$dia"]) && isset($servicio["hasta$i$dia"])){//$i = 0 ->primer franja horaria / $i = 1 -> segunda franja horaria
                    $updateHoraServicio = $modelServicio::updateHoraServicio($servicio["desde$i$dia"],$servicio["hasta$i$dia"],$servicio["idHorario$i$dia"],$dia,$_SESSION["s_nombre"]);
                }else if(isset($servicio["desde$i$dia"]) && isset($servicio["hasta$i$dia"])){ //$i = 0 ->primer franja horaria / $i = 1 -> segunda franja horaria                        
                    $updateHoraServicio = $modelServicio::addHorariosServicios($servicio["desde$i$dia"],$servicio["hasta$i$dia"],$servicio["idServicio"],$dia,$_SESSION["s_nombre"]);
                }
            }
        }
    }

    
    $updateImageService = false;

    $imagenes  = Array(
        'Img' => $_FILES["imgLogo"],
        'Banner' => $_FILES["imgBanner"]
    );
    if (!$hasFreePlan) {
        foreach($imagenes as $tipoImg => $img){
            if($img["name"] !== ""){
                $name_img = ($tipoImg === "Img")? $nameImgServicio : $nameBannerServicio;
                $dir_img = ($img["name"] != "") 
                            ? "./../archivos/user_".$usr_servicio["user_login"].""
                            : "--";
                
                    if($dir_img!="--"){
                        if(!file_exists($dir_img)){
                            echo "Creating directory: " . $dir_img;
                            if (!mkdir($dir_img, 0777, true)) {
                                echo "Failed to create directory: " . $dir_img;
                                continue;
                            }
                        }
                    $updateImageService = Imagen::upload($img,$name_img,$dir_img);
                        
                }
            }
        }
    }

   

    $imgsGaleria = $_FILES["imgGaleria"];
    $updateImgGallery = false;

    if (isset($_POST['existingImgGaleria']) || !empty($imgsGaleria['name'][0])) {
        $dir_img = "./../archivos/user_".$usr_servicio["user_login"]."/galeria";
    } else {
        $dir_img = "--";
    }
    if($dir_img!="--"){
        if(!file_exists($dir_img)){
            mkdir($dir_img,0777,true);
        }
        if (isset($_POST['existingImgGaleria'])) {
            $updateImgGallery = Imagen::uploadExistingGallery($_POST['existingImgGaleria'],$usr_servicio["user_login"],$dir_img, $servicio["idServicio"]);
        } 
        
        if (!empty($imgsGaleria['name'][0])) {
            echo "ejecutando uploadGallery";
            $updateImgGallery = Imagen::uploadGallery($imgsGaleria,$usr_servicio["user_login"],$dir_img, $servicio["idServicio"], $hasFreePlan);
        }
    }
    
        
    
    if($updateServicio && $updateCategoriaServicio && $updateRedSocial && $updateTipoServicio && (!isset($updateHoraServicio) || $updateHoraServicio) && (isset($updateImageService) || $updateImageService) && (isset($updateImgGallery) || $updateImgGallery)){
        //echo "dir_img: " . $dir_img;
        //header("Location: ./../admin/index.php?successModService");
    }else{
        //header("Location: ./../admin/index.php?errorModService");
         echo '<p>updateServicio'.var_dump($updateServicio).'</p>';
         echo '<p>updateCategoriaServicio'.var_dump($updateCategoriaServicio).'</p>';
         echo '<p>updateRedSocial'.var_dump($updateRedSocial).'</p>';
         echo '<p>updateTipoServicio'.var_dump($updateTipoServicio).'</p>';
         echo '<p>updateHoraServicio'.var_dump($updateHoraServicio).'</p>';
         echo '<p>updateImagenService'.var_dump($updateImageService).'</p>';
         echo '<p>updateImgGallery'.var_dump($updateImgGallery).'</p>';
    }
}