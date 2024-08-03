<?php
    session_start();
    (file_exists("./models/comentarioServicio.php"))? require_once('./models/comentarioServicio.php') : require_once('../models/comentarioServicio.php');
    
    include_once('./models/servicio.php');
    if(isset($_GET['idServicio'])){
      $servicio = Servicio::getServicio($_GET['idServicio']);
      $servicio = mysqli_fetch_array($servicio);
      $auxHorariosServicio = Servicio::getHorariosServicio($_GET['idServicio']);
      $comentarios = Comentario::getComentario($_GET['idServicio']);
      $horarioServicio = Array();
      $categorias = Servicio::getCategoriasServicio($_GET["idServicio"]);
      while($hora = mysqli_fetch_array($auxHorariosServicio)){
        (!array_key_exists($hora["dia"],$horarioServicio))? $horarioServicio[$hora["dia"]] = Array() : '';

        $hora_desde = $hora["hora_desde"];
        $hora_hasta = ($hora["hora_hasta"]!="--")? " - ".$hora["hora_hasta"] : '';
        $horaF = $hora_desde.$hora_hasta;
        $dia = $hora["dia"];
        array_push($horarioServicio[$dia],$horaF);
      }
    }else{
      header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require("./assets/php/head.php");?>
</head>

<body>
  
  <?php require("./assets/php/header.php");?>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: assets/img/clients/client-1.png">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-12 text-center">
              <h2>¿Qué servicio necesitas hoy?</h2>
              <p>Encontra los mejores profesionales cerca</p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="servicios.php">Servicios</a></li>
            <li>Proveedor</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->
    
    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">
          <div class="col-lg-12">
            
          <!--Perfil-->
            <div class="col-lg-12">
              <?php 
                $img_banner = "./archivos/user_".$servicio['user_login']."/".$servicio['servicio_banner'].""; 
              ?>
              <div class="post-author align-items-center text-center" style="background-image: url('<?php echo (file_exists($img_banner))? $img_banner :'./assets/img/hero-bg-abstract.jpg'?>')">
                <img src="<?=file_exists('./archivos/user_'.($servicio["user_login"]).'/'.($servicio["servicio_imagen"]).'')?'./archivos/user_'.($servicio["user_login"]).'/'.($servicio["servicio_imagen"]).'' : './assets/img/user_profile.webp'?>" class="rounded-circle flex-shrink-0" alt="IMG_PROFILE ">
              </div> 
            </div>

            <br>
          <div class="col-lg-12">
            <div class="sidebar">

            <!--Descripcion-->
            <div class="sidebar-item categories">
                <h3 class="sidebar-title"><?=($servicio["user_nombre"])?></h3>
                    <section id="redes" class="redes">
                          <ul class="mt-3">
                            <?=(isset($servicio["redSocial_LinkedIn"])  && $servicio["redSocial_LinkedIn"]!="--") ? '<a href="'.$servicio["redSocial_LinkedIn"].'" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></a>' : ''?>
                            <?=(isset($servicio["redSocial_Facebook"])  && $servicio["redSocial_Facebook"]!="--") ? '<a href="'.$servicio["redSocial_Facebook"].'" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>' : ''?>
                            <?=(isset($servicio["redSocial_Instagram"]) && $servicio["redSocial_Instagram"]!="--")? '<a href="'.$servicio["redSocial_Instagram"].'" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>' : ''?>
                            <?php 
                              if(isset($servicio["servicio_telefono"]) || $servicio["servicio_telefono"] != "--"){
                                echo '<a href="https://api.whatsapp.com/send?phone='.$servicio["servicio_telefono"].'&text= Hola te escribo por tu servicio '.$servicio["servicio_nombre"].' publicado en Todo Oficio. 
                            
                                                                                                                                                                                                       Servicio: https://www.todooficio/userProfile.php?idServicio='.$servicio["idServicio"].'" target="_blank" class="whatsapp"><i class="bi bi-whatsapp"></i></a>';
                              }else if(isset($servicio["user_telefono"])       && $servicio["user_telefono"]!="--"){
                                echo '<a href="https://api.whatsapp.com/send?phone='.$servicio["user_telefono"].'&text= Hola te escribo por tu servicio '.$servicio["servicio_nombre"].' publicado en Todo Oficio. 
                            
                                                                                                                                                                                                       Servicio: https://www.todooficio/userProfile.php?idServicio='.$servicio["idServicio"].'" target="_blank" class="whatsapp"><i class="bi bi-whatsapp"></i></a>';
                              }
                            ?>
                          </ul>
                    </section>
            </div><!-- End sidebar Descripcion-->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!--Descripcion-->
            <div class="sidebar-item categories">
                <h3 class="sidebar-title">Descripcion</h3>
                <br>
                <p><?=($servicio["servicio_descripcion"])?></p>
            </div><!-- End sidebar Descripcion-->
    
            <!-- Divider -->
            <hr class="sidebar-divider">

              <!--Categorias-->
              <div class="sidebar-item categories">
                <h3 class="sidebar-title">Categoria</h3>
                <ul class="mt-3">
                  <?php while($categoria = mysqli_fetch_array($categorias)){?>
                    <li><?=($categoria["tipo"])?></li>
                  <?php } ?>
                </ul>
              </div><!-- End sidebar categorias-->
    
              <!-- Divider -->
              <hr class="sidebar-divider">

              <!--Etiquetas
              <div class="sidebar-item tags">
                <h3 class="sidebar-title">Etiquetas</h3>
                <ul class="mt-3">
                  <li><a href="#">Acepta tarjeta debito</a></li>
                  <li><a href="#">Acepta tarjeta credito</a></li>
                  <li><a href="#">Acepta MercadoPago</a></li>
                </ul>
              </div>
              <!-- Divider 
              <hr class="sidebar-divider">
              <!-- End sidebar etiquetas-->

              

              <!--Horarios
              <div class="sidebar-item categories">
                <h3 class="sidebar-title">Horarios</h3>
                <ul class="mt-3">
                    <li class="list-group-item">Lunes</li>
                    <li class="list-group-item">Martes</li>
                    <li class="list-group-item">Miercoles</li>
                    <li class="list-group-item">Jueves</li>
                    <li class="list-group-item">Viernes</li>
                    <li class="list-group-item">Sabado</li>
                    <li class="list-group-item">Domingo</li>
                </ul>
              </div>
              End horarios-->
              <!--Horarios-->
              <section id="faq" class="faq">
                <div class="accordion accordion-flush" id="faqlist" data-aos="fade-up" data-aos-delay="100">
                
                  <div class="accordion-item">
                      <h3 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                        <h3 class="sidebar-title">Horarios</h3>
                        </button>
                      </h3>
                      <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                        <table class="table table-striped">
                          <tbody>
                            <ul class="horarios">
                              <?php while($row = current($horarioServicio)) { ?>
                                  <li>
                                    <p class="item-attr"><?=key($horarioServicio)?></p>
                                    <p class="item-property"><span><?=($row[0]!="--")?$row[0] : 'No hay horarios disponibles'?><?=(isset($row[1]) && $row[1]!="--")?' y '.$row[1]:''?></span></p>
                                  </li>
                              <?php
                                next($horarioServicio);
                                }
                              ?>
                              </ul>
                          </tbody>
                        </table>
                      </div>
                  </div>
                </div>
              </section>
              <!--End horarios-->
            </div>
            <!-- End Blog Sidebar -->
          </div>
        </div>

        <!--Comentarios-->
        <div class="comments">
          <h4 class="comments-count">Comentarios</h4>
            <input type="hidden" id="idServicio" value='<?=$_GET["idServicio"]?>'>
            <div class="contenedorComentarios">
              <?php require_once("./controller/userComentario.php");?>
              <?php while($row=mysqli_fetch_array($comentarios)){?>
                <div id="comment-1" class="comment">
                  <div class="d-flex">
                      <div class="comment-img"><img src="assets/img/logos/negroFondoAmarillo.png" alt=""></div>
                      <div>
                          <h5><a><?= $row['user_nombre'] ?></a></h5>
                          <time datetime="2022-01-01"><?= $row['fec_alta'] ?></time>
                          <p><?= $row['comentario'] ?></p>
                      </div>
                  </div>
                </div>
              <?php }?>
            </div>          
              <div class="reply-form">
                <h4>Deja tu comentario</h4>
                <p>Tu email no sera publicado.</p>
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <input id="name" name="name" type="text" class="form-control" maxlength="30" pattern="[A-Za-z]{5,30}" title="Un nombre válido consiste en una cadena con 5 a 30 caracteres. No se aceptan número, símbolos o metacaracteres." placeholder="Nombre y Apellido *">
                    </div>
                    <div class="col-md-6 form-group">
                      <input id="email" name="email" type="email" class="form-control" placeholder="Email *">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                      <textarea id="comment" name="comment" class="form-control" placeholder="Comentario *"></textarea>
                    </div>
                  </div>
                  <button type="button" id="btnAñadirComentario" class="btn btn-secondary w-100">Publicar comentario</button>
              </div>
          </div>
      </div>
    </section><!-- End Blog Details Section -->
    
    <section id="faq" class="faq">
        <div class="container" data-aos="fade-up">

        
        </div>
    </section>
      

  </main><!-- End #main -->

  <?php require("./assets/php/footer.php")?>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/comentario.js"></script>

</body>

</html>