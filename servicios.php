<?php
  session_start();
  include_once('./config/conexion.php');
  include_once('./models/servicio.php');
  require('./models/categoria.php');
  require('./models/provincia.php');
  require('./models/tag.php');
  
  $categorias = Categoria :: getCategoria();
  $provincia  = Provincia :: getProvincia();
  $tags       = Tag       :: getTags();
  
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
      <div class="page-header d-flex align-items-center" style="background-image: url('');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <h2>Servicios</h2>
              <p>Encontra los mejores profesionales cerca</p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.php">Inicio</a></li>
            <li>Servicios</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row g-5">
          
          <div class="col-lg-3">

            <div class="sidebar">

              <!--<div class="sidebar-item search-form">
                <h3 class="sidebar-title">Buscador</h3>
                <form action="" class="mt-3">
                  <input type="text">
                  <button type="submit"><i class="bi bi-search"></i></button>
                </form>
              </div> End sidebar search formn-->

              <div class="sidebar-item categories">
                <h3 class="sidebar-title">Categorias</h3>
                <ul id="categorias-servicios" class="mt-3">
                  <?php while($row=mysqli_fetch_array($categorias)){?>
                          <a href="#filtros-servicios"><li class="categoria-item"><?=$row['tipo']?></li></a>
                  <?php } ?>
                </ul>
              </div><!-- End sidebar categories-->

              <div class="sidebar-item categories">
                <h3 class="sidebar-title">Provincias</h3>
                <ul id="provincias-servicios" class="mt-3">
                  <?php while($row=mysqli_fetch_array($provincia)){?>
                        <li class="provincia-item">
                          <?=$row['provincia_name'].' ('.$row['cantidad_servicios'].')'?> 
                        </li>
                  <?php } ?>                        
                </ul>
              </div><!-- End sidebar categories-->


              

              <div class="sidebar-item sidebar-item categories">
                <h3 class="sidebar-title">Filtros</h3>
                <ul id="filtros-servicios" class="mt-3">
                    <li class="filtro-item">No hay filtros</li>
                </ul>
              </div><!-- End sidebar categories-->

            </div><!-- End Blog Sidebar -->

          </div>

          <div class="col-lg-9">

            <!-- Servicios -->
            <section id="servicios" class="servicios">
              <?php include_once('./controller/serviciosPaginados.php') ?> 
            </section><!--End Servicios -->

            
            
          </div>

        </div>

      </div>
    </section><!-- End Blog Details Section -->

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

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/servicios.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

</body>

</html>