<?php
session_start();
require('./../models/servicio.php');
require('./../assets/php/uploadImg.php');
require('./../models/usuario.php');
$servicio = $_POST;



// var_dump($imagenes);

/** 
 * TODO: ALTA SERVICIO
 *          - Nombre Servicio
 *          - Descripcion Servicio
 *          - USR_ALTA
 *          - FEC_ALTA
 *          - Email Servico (opcional)
 *          - Pagina web servicio(opcional)
 *          - Imagen Servicio
 *          - Banner Servicio
 *          - ID Categoria
 *          - ID Provincia
 *          - ID Usuraio
 * 
 * TODO: SERVICIO HORARIO
 *      - Hora Desde
 *      - Hora Hasta
 *      - ID Servicio
 *      - ID Dia
 *      - USR ALTA
 *      - FEC ALTA
 * 
 * TODO: SERVICIO TIPO
 *      - Tipo
 *      - ID Servicio
 *      - USR ALTA
 *      - FEC ALTA
 * */
// Ver: telefono y redes sociales a nivel base de datos y codigo
// var_dump($_SESSION);
if(
   $servicio["nombreServicio"] != null && 
   $servicio["descripción"] != null &&
   $servicio["telefono"] != null &&
   $servicio["categoria"]!= null &&
   $servicio["provincia"] != null &&
   $servicio["departamento"] != null &&
   isset($_SESSION["s_id_usuario"]) &&
   isset($_SESSION["s_nombre"])
  )
  {
    
    $Servicio = new Servicio();

    $usr_servicio = Usuario::getUsuario($_SESSION["s_id_usuario"]);
    $usr_servicio = mysqli_fetch_array($usr_servicio);

    $nameImgServicio = preg_replace('/[^a-zA-Z0-9._ ]/', '', 'service_'.$usr_servicio["user_login"]);   
    $nameBannerServicio = preg_replace('/[^a-zA-Z0-9._ ]/', '', 'imgBanner_'.$usr_servicio["user_login"]);
    $hasFreePlan = $usr_servicio["FK_idRol"] == 6 ? true : false;
    $addServicio = $Servicio::addServicio($servicio["nombreServicio"],$servicio["descripción"],$servicio["emailContacto"],$servicio["telefono"],$servicio["sitioWeb"],$nameImgServicio.'.webp',$nameBannerServicio.'.webp',$servicio["provincia"],$servicio["departamento"],$_SESSION["s_id_usuario"],$_SESSION["s_nombre"]);

    if($addServicio){
        $lastServicio = $Servicio::getLastServicio();
        if($row = mysqli_fetch_array($lastServicio)){
            $idLastServicio = $row["idServicio"];

            /*----------------- CATEGORIA -----------------*/
            $categorias  = $servicio["categoria"];
            
            foreach($categorias as $key => $idCategoria){
                $addCategoria = $Servicio::addCategoria($idLastServicio,$idCategoria,$_SESSION["s_nombre"]);
            }
            if($hasFreePlan){
                $addCategoria = $Servicio::updateGenericImg("category_".$categorias[0].".webp", $idLastServicio);
            }
            /*----------------- FIN CATEGORIA -----------------*/

            /*------------------- REDES SOCIALES -------------------*/
            $redes = $servicio["redes"];
            $instagram = ($redes["instagram"] == "")? '--' : $redes["instagram"];
            $linkedin  = ($redes["linkedin"] == "")? '--' : $redes["linkedin"];
            $facebook  = ($redes["facebook"] == "")? '--' : $redes["facebook"];

            $addRedesSociales = $Servicio::addRedesSociales($instagram,$linkedin,$facebook,$idLastServicio,$_SESSION["s_nombre"]);
            
            /*----------------- FIN REDES SOCIALES -----------------*/

            /*----------------- HORARIOS -----------------*/
            $horarios = $servicio["horarios"];

            foreach ($horarios as $dia => $tipoHorario) {                
                if(strtoupper($tipoHorario) !== "INGRESAR HORARIOS"){
                    $addHorarios = $Servicio::addHorariosServicios($tipoHorario,"--",$idLastServicio,$dia,$_SESSION["s_nombre"]);
                } else {
                    for($i=0;$i<2;$i++){ //Se utiliza para recorrer las dos franjas horarias. 
                        if(isset($servicio["desde$i$dia"]) && isset($servicio["hasta$i$dia"])){ //$i = 0 ->primer franja horaria / $i = 1 -> segunda franja horaria
                            $addHorarios = $Servicio::addHorariosServicios($servicio["desde$i$dia"],$servicio["hasta$i$dia"],$idLastServicio,$dia,$_SESSION["s_nombre"]);
                        }
                    }
                }
            }
            /*----------------- FIN HORARIOS -----------------*/
            
            $addTipo = $Servicio::addTipoServicios($servicio["tipo"],$idLastServicio,$_SESSION["s_nombre"]);

            /* SUBIDA DE FOTOS DE PERFIL Y BANNER DE SERVICIO */
            if (!$hasFreePlan){

                $imagenes  = Array(
                    'Img' => $_FILES["imgLogo"],
                    'Banner' => $_FILES["imgBanner"]
                );

                foreach($imagenes as $tipoImg => $img){
                    $name_img = ($tipoImg === "Img")? $nameImgServicio : $nameBannerServicio;
                    $dir_img = ($img["name"] != "") 
                                ? "./../archivos/user_".$_SESSION["s_nombre_usuario"].""
                                : "--";

                    if($dir_img!="--"){
                        if(!file_exists($dir_img))
                            mkdir($dir_img,0777,true);
                        Imagen::upload($img,$name_img,$dir_img);
                    }
                }
            }
                /* SUBIDA DE FOTOS DE GALERIA */
            
            $imgsGaleria = $_FILES["imgGaleria"];

            
            $usuario = mysqli_fetch_array(Usuario::getUsuarioByServicio($idLastServicio));

            

            if (!empty($imgsGaleria['name'][0])) {
                $dir_img = "./../archivos/user_".$usuario["user_login"]."/galeria";
            } else {
                $dir_img = "--";
            }
            if($dir_img!="--"){
                if(!file_exists($dir_img)){
                    mkdir($dir_img,0777,true);
                }
                
                if (!empty($imgsGaleria['name'][0])) {
                    $updateImgGallery = Imagen::uploadGallery($imgsGaleria,$usuario["user_login"],$dir_img, $idLastServicio, $hasFreePlan);
                }
            }
            

                header("Location: ./../admin/index.php?successService");
        }

    } else{
        header("Location: ./../admin/index.php?errorService");
    }
}




/**

 * 
 * TODO: FOTO SERVICIO (Galeria de imagenes)
 *      - En un futuro cuando se implementen los pagos.
 * 
 * TODO: ARCHIVO SERVICIO
 *      - En un futuro cuando se implementen los pagos.
 * */ 