<?php
    (file_exists('./../config/conexion.php'))? include_once('./../config/conexion.php') : '';
    (file_exists('./../models/servicio.php'))? include_once('./../models/servicio.php') : '';
    
    $cant = 20; 
    $pag  = (isset($_GET['p']))? $_GET['p'] : 1;
    $ini  = ($pag-1) * $cant;
    
    $filtros = null;
    
    if($_POST){
        $filtros = Array(
                         "categorias" => (isset($_POST["categorias"]))?($_POST["categorias"]):'',
                         "provincias" => (isset($_POST["provincias"]))?($_POST["provincias"]):'',
                         "tags"       => (isset($_POST["tags"]))      ? $_POST["tags"] : ''
                        );
        
    };
 
    $servicios    = Servicio::getAllServiciosPaginado($ini,$cant,$filtros);
    $servicioCant = Servicio::countServicios();
    $servicioCant = mysqli_fetch_array($servicioCant);
    
    $cantidadPag = round($servicioCant['CANTIDAD']/$cant);
?>

<div class="row row-cols-2">
    <?php while($row = mysqli_fetch_array($servicios)){ ?>
        <div class="servicio-item ">
            <a href="./userProfile.php?idServicio=<?=($row["idServicio"])?>">
                <div class="d-flex">
                    <?php $user = Servicio::getServicio($row["idServicio"]);
                        $user = mysqli_fetch_array($user);
                        $rol = $user["FK_idRol"];
                        if ($rol == 6){
                    ?>    
                        <img src="./assets/img/<?=($row["servicio_imagen"])?>" class="servicio-img flex-shrink-0" alt="">
                    <?php } else { ?>
                            <img src="./archivos/user_<?=($row["user_login"]).'/'.($row["servicio_imagen"])?>" class="servicio-img flex-shrink-0" alt="">
                        <?php } ?>
                    <div>
                        <h3><?=($row["servicio_nombre"])?></h3>
                        <h4><?=($row["user_nombre"])?></h4>
                        <!-- <div class="stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div> -->
                    </div>
                </div>
            </a>
        </div>
    <?php } ?> 
</div> 

<div id="paginacionServicio" class="pagination pt-5 ">
    <nav class="mx-auto" aria-label="...">
        <ul class="pagination pagination-md">
            <?php for($i=0;$i<$cantidadPag;$i++){?>
                <li class="page-item <?=($pag == ($i+1))?'active':''?>" aria-current="page">
                    <span class="page-link" onclick="filtrar(<?=$i+1?>)"><?=($i+1)?></span>
                </li>
            <?php }?>
        </ul>
    </nav>        
</div>