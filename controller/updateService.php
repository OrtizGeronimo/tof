<?php
session_start();
require('./../models/servicio.php');
require('./../assets/php/uploadImg.php');
$servicio = $_POST;

$imagenes  = Array(
    'Img' => $_FILES["imgLogo"],
    'Banner' => $_FILES["imgBanner"]
);


if($servicio["nombreServicio"] != null && $servicio["telefono"]!= null && $servicio["descripción"] != null && $servicio["categoria"]!= null && $servicio["provincia"] != null && $servicio["departamento"] != null && isset($_SESSION["s_id_usuario"]) && isset($_SESSION["s_nombre"])){
    $modelServicio = new Servicio();
    
    $nameImgServicio = preg_replace('/[^a-zA-Z0-9._ ]/', '', 'img_'.$servicio["nombreServicio"]);   
    $nameBannerServicio = preg_replace('/[^a-zA-Z0-9._ ]/', '', 'imgBanner_'.$servicio["nombreServicio"]);
    
    $updateServicio = $modelServicio::updateServicio($servicio["idServicio"],$servicio["nombreServicio"],$servicio["descripción"],$servicio["emailContacto"],$servicio["telefono"],$servicio["sitioWeb"],$nameImgServicio.'.webp',$nameBannerServicio.'.webp',$servicio["provincia"],$servicio["departamento"],$_SESSION["s_id_usuario"],$_SESSION["s_nombre"]);

    Servicio::deleteCategoriaServicio($servicio["idServicio"],$_SESSION["s_nombre"]);
    foreach ($servicio["categoria"] as $key => $idCategoria) {
        $updateCategoriaServicio = $modelServicio::updateCategoriaServicio($servicio["idServicio"],$idCategoria,$_SESSION["s_nombre"]);
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

    $usr_servicio = $modelServicio::getServicio($servicio["idServicio"]);
    $usr_servicio = mysqli_fetch_array($usr_servicio);
    $updateImageService = false;
    foreach($imagenes as $tipoImg => $img){
        if($img["name"] !== ""){
            $name_img = ($tipoImg === "Img")? $nameImgServicio : $nameBannerServicio;
            $dir_img = ($img["name"] != "") 
                        ? "./../archivos/user_".$usr_servicio["user_login"].""
                        : "--";
                if($dir_img!="--"){
                if(!file_exists($dir_img))
                    mkdir($dir_img,7777,true);
                $updateImageService = Imagen::upload($img,$name_img,$dir_img);
            }
        }
    }

    
    if($updateServicio && $updateCategoriaServicio && $updateRedSocial && $updateTipoServicio && (!isset($updateHoraServicio) || $updateHoraServicio) && (isset($updateImageService) || $updateImageService)){
        header("Location: ./../admin/index.php?successModService");
    }else{
        header("Location: ./../admin/index.php?errorModService");
        // echo '<p>updateServicio'.$updateServicio.'</p>';
        // echo '<p>updateCategoriaServicio'.$updateCategoriaServicio.'</p>';
        // echo '<p>updateRedSocial'.$updateRedSocial.'</p>';
        // echo '<p>updateTipoServicio'.$updateTipoServicio.'</p>';
        // echo '<p>updateHoraServicio'.$updateHoraServicio.'</p>';
        // echo '<p>updateHoraServicio'.$updateHoraServicio.'</p>';
        // echo '<p>updateImagenService'.$updateImageService.'</p>';
        // echo '<p>updateImagenService'.$updateImageService.'</p>';
    }
}