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
            <li>Preguntas Frecuentes</li>
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
                <h3>Preguntas <strong>Frecuentes</strong></h3>
                
              </div>
            </div>
  
            <div class="col-lg-8">
  
              <div class="accordion accordion-flush" id="faqlist" data-aos="fade-up" data-aos-delay="100">
  
               <div class="accordion-item">
                  <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                      <span class="num">1.</span>
                      ¿Que es Todo Oficio?
                    </button>
                  </h3>
                  <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                    <div class="accordion-body">
                      Todo Oficio es una plataforma web para conectar personas que ofrezcan un servicio/emprendimiento con aquellas que lo requieran, se pueden registrar
                      gratis y empezar a generar nuevos clientes.
                    </div>
                  </div>
                </div><!-- # Faq item-->

                <div class="accordion-item">
                  <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                      <span class="num">2.</span>
                      ¿Cómo funciona Todo Oficio?
                    </button>
                  </h3>
                  <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                    <div class="accordion-body">
                      <ol>
                        <li>
                          Busca y selecciona una de las categorías de los servicios que ofrecemos.
                        </li>
                        <li>
                          Especifica tu búsqueda de acuerdo al lugar donde necesites el servicio.
                        </li>
                        <li>
                          Nosotros te recomendaremos los perfiles que mejor se adapten a tu búsqueda.
                        </li>
                      </ol>
                    </div>
                  </div>
                </div><!-- # Faq item-->
  
                <div class="accordion-item">
                  <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                      <span class="num">3.</span>
                      ¿Necesito registrarme para ver los servicios?
                    </button>
                  </h3>
                  <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                    <div class="accordion-body">
                      En Todo Oficio te brindamos la facilidad de entrar y buscar los servicios que necesites sin necesidad de registrarse.
                    </div>
                  </div>
                </div><!-- # Faq item-->
  
                <div class="accordion-item">
                  <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-4">
                      <span class="num">4.</span>
                      ¿Como me registro como proveedor?
                    </button>
                  </h3>
                  <div id="faq-content-4" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                    <div class="accordion-body">
                      Es muy simple, haces click en la parte superior derecha de la pantalla donde dice registrarse y segui los pasos para tener tu cuenta!.
                    </div>
                  </div>
                </div><!-- # Faq item-->
  
                <div class="accordion-item">
                  <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-5">
                      <span class="num">5.</span>
                      ¿Cobran comision por venta?
                    </button>
                  </h3>
                  <div id="faq-content-5" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                    <div class="accordion-body">
                      No, no cobramos comision por venta y tampoco intervenimos en las comunicaciones proveedor-cliente. 
                    </div>
                  </div>
                </div><!-- # Faq item-->
  
                <div class="accordion-item">
                  <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-6">
                      <span class="num">6.</span>
                      ¿Como contacto con un proveedor?
                    </button>
                  </h3>
                  <div id="faq-content-6" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                    <div class="accordion-body">
                      Vaya al apartado de servicios, aplique los filtros segun sus necesidades de busqueda y haga click en el proveedor. Una vez realizado este paso se le dirigira al perfil del proveedor, haciendo click en el icono de whatsapp se abrira el chat!.
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