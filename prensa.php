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
      <div class="page-header d-flex align-items-center" style="background-image: url('');">
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
            <li>Prensa</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    
    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq">
        <div class="container" data-aos="fade-up">
  
          <div class="row gy-4">
  
            <div class="col-lg-4">
              <div class="content px-xl-5">
                <h3>Prensa</h3>
                
              </div>
            </div>
  
            <div class="col-lg-8">
  
              <div class="accordion accordion-flush" id="faqlist" data-aos="fade-up" data-aos-delay="100">
  
               <div class="accordion-item">
                  <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                      <span class="num">1.</span>
                      La innovadora plataforma creada por un mendocino para vincular proveedores y clientes en el rubro de los oficios
                    </button>
                  </h3>
                  <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                    <div class="accordion-body">
                      A través del sitio Todooficio.com, los interesados pueden encontrar trabajadores validados, comparar precios y conocer experiencias anteriores. Hay más de 50 categorías distintas y unos 250 proveedores activos.
                      <a href="https://www.diariouno.com.ar/economia/la-innovadora-plataforma-creada-un-mendocino-vincular-proveedores-y-clientes-el-rubro-los-oficios-n1039129">Ver nota</a>
                    </div>
                  </div>
                </div><!-- # Faq item-->

                <div class="accordion-item">
                  <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                      <span class="num">2.</span>
                      Ulpiano Suarez nos recibió
                    </button>
                  </h3>
                  <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                    <div class="accordion-body">
                      El intendente mantuvo un encuentro con Esteban Castellazzo y Kevin Llobell, fundadores del sitio web que une a personas que ofrecen servicios con quienes desean contratarlos.
                      <a href="https://ciudaddemendoza.gob.ar/2022/09/13/ulpiano-suarez-recibio-a-los-creadores-de-la-aplicacion-todo-oficio/">Ver nota</a>
                    </div>
                  </div>
                </div><!-- # Faq item-->
  
                <div class="accordion-item">
                  <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                      <span class="num">3.</span>
                      Distinguen a la guía virtual “Todo Oficio”
                    </button>
                  </h3>
                  <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                    <div class="accordion-body">
                      Se desarrolló en el Salón Azul, por iniciativa de Cecilia Rodríguez (UCR), un acto de reconocimiento y entrega de diplomas distintivos a integrantes de la organización “Todo Oficio” por la labor desarrollada “en la vinculación de quienes necesitan de un oficio y aquellos/as que pueden brindarlo, generando así trabajo”. La Cámara Baja aprobó bajo la Resolución n°674 la iniciativa de la legisladora.
                      <a href="https://www.hcdmza.gob.ar/site/noticias/68-noticia/7591-distinguen-a-la-guia-virtual-todo-oficio?fbclid=PAAaa5duFH6LAUgpe3vZERSt2t7LFsS3bR4HPpLMI-pEqfWbb6229lN53-u7w">Ver nota</a>
                    </div>
                  </div>
                </div><!-- # Faq item-->
  
              </div>
  
            </div>
          </div>
  
        </div>
      </section><!-- End Frequently Asked Questions Section -->

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