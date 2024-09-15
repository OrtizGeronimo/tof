<!DOCTYPE html>
<html lang="en">

<head>
  <?php require("./assets/php/head.php");?>
  <link href="assets/css/styleForms.css" rel="stylesheet">
</head>

<body>
  <?php require("./assets/php/header.php");?>
  <!-- End Header -->

  <main id="main">

  <!-- ======= Breadcrumbs ======= -->
   <div class="breadcrumbs">
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.php">Inicio</a></li>
            <li>Recuperar contraseña</li>
          </ol>
        </div>
      </nav>
    </div> <!-- End Breadcrumbs -->

    <div class="container-form">
      <section class="section register d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10 col-md-10 d-flex flex-column align-items-center justify-content-center">
              <div class="card mb-3">
                <div class="card-body">
                  
                  <!--<form class="row g-3" id="formLogin" action="validacionLogin.php" method="post">-->
                  
                    <div class="form-group mt-3 col-12 text-center">
                       <h5>Problemas al iniciar sesión</h5>
                    </div>
                    
                    <div class="col">
                        <p>Ingresa tu correo electrónico y te enviaremos <br> un enlace para que recuperes el acceso a tu cuenta.</p>
                    </div>
                    <div class="form-group col-12">
                      <!-- <label for="email" class="label">Email</label> -->
                      <input type="email" id="email" name="email" class="input" placeholder="Escriba su email." required>
                    </div>

                    <div class="form-group mt-3 col-12">
                      <button class="btn btn-secondary w-100" type="submit" id="buttonForm" onClick="return usuarioExiste()">Recuperar Contraseña</button>
                    </div>
                    
                  <!--</form> -->

                  <div class="form-group col-12">
                    <p class="small mb-0">¿No tienes cuenta? <a href="registerUser.php">Crea una cuenta</a></p> 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

  </main><!-- End #main -->
  
  <?php require("./assets/php/footer.php")?>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>
  <!--Validaciones-->
  <script src="./assets/js/validation1.js"></script>
  <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <!--<script src="assets/vendor/php-email-form/validate.js"></script>-->

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <!--JQuery-->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
</body>

</html>