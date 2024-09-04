<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  session_start();
  require('./models/servicio.php');
  require('./models/categoria.php');
  require('./models/provincia.php');
  $servicioBasicos = Servicio::getServiciosBasicos();
  $servicioPro = Servicio::getServiciosPro();
  $categorias = Categoria::getCategoria();
  $provincias = Provincia::getProvincia();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require("./assets/php/head.php"); ?>
</head>

<body>

  <?php require("./assets/php/header.php"); ?>
  <!-- End Header -->
  
  <section id="hero" class="hero">
    <div class="container position-relative">
      <div class="row gy-5 mb-5" data-aos="fade-in">
        <div class="col-lg-12 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-center">
          <h2>¿Qué servicio necesitas hoy?</h2>
          <p>Encontra los mejores profesionales cerca</p>
          
            
            <div class="row dropdown-search">
              

              

              <div class="col-lg-12 col-sm-12 my-3">
                <a href="servicios.php">
                  <button id="btn_buscarServicio"type="button" class="btn btn-warning w-100" autocomplete="off">
                    Buscar Servicios
                  </button>
                </a>
                
              </div>

            </div>
          

          <div class="dropdown-search-instructions">
            <!-- <p> Al presionar en los campos de búsqueda escribí lo que necesitas o selecciona la opción que se ajuste a tus necesidades.</p>
            <p> En el campo de ubicación presiona primero la provincia elegida, espere un momento y vuelva a presionar el campo para seleccionar la localidad correcta.</p> -->
            <p> Presiona en el botón “BUSCAR SERVICIOS” </p>
            <p> Seleccionar la categoría que se ajuste a tus necesidades y contáctate con el proveedor que buscabas!</p>
            <p> Usa los filtros disponibles para tener mayor éxito en tu búsqueda.</p>
          </div>
          
        </div>
      </div>
    </div>
  </section>
  <!-- End Hero Section -->

  <main id="main">
  
    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Servicios mas solicitados</h2>
          <p>Estos son alguno de nuestros servicios mas solicitados, hace click en el que necesites para saber mas.</p>
        </div>

        <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
            <?php while($row=mysqli_fetch_array($servicioPro)){?>
                    <div class="swiper-slide">
                    <a href="./userProfile.php?idServicio=<?=($row["idServicio"])?>">
                      <div class="testimonial-wrap">
                        <div class="testimonial-item">
                          <div class="d-flex align-items-center">
                            <img src="<?=(($row["servicio_imagen"])!=null)?'./archivos/user_'.($row["user_login"]).'/'.($row["servicio_imagen"]):''?>" class="testimonial-img flex-shrink-0" alt="">
                            <div>
                              <h3><?=($row["servicio_nombre"])?></h3>
                              <h4><?=($row["user_nombre"])?></h4>
                              <!-- <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                              </div> -->
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                    </div><!-- End testimonial item -->   
            <?php } ?>
            

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->



    <!-- ======= Our Team Section ======= -->
    <section id="team" class="testimonials">
      <div class="container" data-aos="fade-up">
        
        <div class="section-header">
          <h2>Servicios Basico</h2>
          <p>Encontra el servicio que buscas</p>
        </div>

        <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
            <?php while($row = mysqli_fetch_array($servicioBasicos)) {?>
                      <div class="swiper-slide">  
                      <a href="./userProfile.php?idServicio=<?=($row["idServicio"])?>">
                      <div class="testimonial-wrap">
                        <div class="testimonial-item">
                          <div class="d-flex align-items-center">
                            <img src="./archivos/user_<?=($row["user_login"]).'/'.($row["servicio_imagen"])?>" class="testimonial-img flex-shrink-0" alt="">
                            <div>
                              <h3><?=($row["servicio_nombre"])?></h3>
                              <h4><?=($row["user_nombre"])?></h4>
                              <!-- <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                              </div> -->
                            </div>
                          </div>
                        </div>
                      </div>
                      </a>
                    </div><!-- End testimonial item -->     
            <?php } ?>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section><!-- End Our Team Section -->

    


  </main><!-- End #main -->

  <!--Footer-->
  <?php require("./assets/php/footer.php")?>
  <!--Fin footer-->

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
  <script src="assets/js/index.js"></script>
  <?php
  if(empty($_SESSION["s_id_usuario"])){?>

    <script>
      Swal.fire({
        title: '¿Quieres ofrecer tu servicio?',
        position: 'bottom-end',
        showCloseButton: true,
        focusConfirm: false,
        confirmButtonColor: '#ffd11a',
        confirmButtonText:
          '<a style="color:white" href="./registerUser.php">Registrate</a>',
      })
    </script>
  <?php } ?>
</body>

</html>