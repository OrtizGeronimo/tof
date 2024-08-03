<?php
  session_start();
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
      <div class="page-header d-flex align-items-center">
        <div class="container position-relative">
          <div class="row gy-5 mb-5" data-aos="fade-in">
            <div class="col-lg-12 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-center">
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
            <li>Planes</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->
    
    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing sections-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Nuestros planes</h2>
          <p>Obtene un plan para mayores beneficios!</p>
        </div>

        <div class="row g-4 py-lg-5" data-aos="zoom-out" data-aos-delay="100">

          <div class="col-lg-4">
            <div class="pricing-item">
              <h3>Gratis</h3>
              <div class="icon">
                <i class="bi bi-box"></i>
              </div>
              <h4><sup>$</sup>0<span> / mes</span></h4>
              <ul>
                <li><i class="bi bi-check"></i> 2 Imagenes en la galeria </li>
                <li><i class="bi bi-check"></i> 1 foto de perfil y galeria</li>
                <li><i class="bi bi-check"></i> NO COBRAMOS POR COMISION DE VENTA!</li>                
                <li class="na"><i class="bi bi-x"></i> <span>Destaque en los buscadores de su categoria</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Ediciones en tu negocio</span></li>
              </ul>
              <div class="text-center"><a href="./registerUser.php" class="buy-btn">Obtener</a></div>
            </div>
          </div><!-- End Pricing Item -->

          <div class="col-lg-4">
            <div class="pricing-item featured">
              <h3>Básico</h3>
              <div class="icon">
                <i class="bi bi-airplane"></i>
              </div>

              <h4><sup>$</sup>750<span> / mes</span></h4>
              <ul>
                <li><i class="bi bi-check"></i> Publicar tu negocio</li>
                <li><i class="bi bi-check"></i> 4 imagenes en la galeria</li>
                <li><i class="bi bi-check"></i> 1 foto de perfil y galeria</li>
                <li><i class="bi bi-check"></i> Ediciones en tu negocio</li>
                <li><i class="bi bi-check"></i> Destaque en los buscadores de su categoria</li>
                <li><i class="bi bi-check"></i>  NO COBRAMOS POR COMISION DE VENTA!</li>
              </ul>
              <div class="text-center"><a href="#" class="buy-btn">Disponible proximamente</a></div>
            </div>
          </div><!-- End Pricing Item -->

          <div class="col-lg-4">
            <div class="pricing-item">
              <h3>PRO</h3>
              <div class="icon">
                <i class="bi bi-send"></i>
              </div>
              <h4><sup>$</sup>1500<span> / mes</span></h4>
              <ul>
                <li><i class="bi bi-check"></i> Publicar tu negocio</li>
                <li><i class="bi bi-check"></i> 10 imagenes en la galeria</li>
                <li><i class="bi bi-check"></i> 1 foto de perfil y de portada</li>
                <li><i class="bi bi-check"></i> Destaque en el home</li>
                <li><i class="bi bi-check"></i> Destaque en los buscadores por su categoria</li>
                <li><i class="bi bi-check"></i> NO COBRAMOS POR COMISION DE VENTA!</li>
              </ul>
              <div class="text-center"><a href="#" class="buy-btn">Disponible proximamente</a></div>
            </div>
          </div><!-- End Pricing Item -->

        </div>

      </div>
    </section><!-- End Pricing Section -->
    
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

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>