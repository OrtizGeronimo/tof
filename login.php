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
      <!-- <div class="page-header d-flex align-items-center" style="background-image: url('');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-12 text-center">
              <h2>Ingrese a su cuenta</h2>
              <p>Ingrese su nombre de usuario y contraseña para iniciar sesión</p>
            </div>
          </div>
        </div>
      </div>-->
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.php">Inicio</a></li>
            <li>Iniciar sesión</li>
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
                  
                    <div class="form-group col-12">
                      <h4>Bienvenido</h4>
                    </div>

                    <div class="form-group col-12">
                      <label for="username" class="label">Usuario</label>
                        <input type="text" id="username" name="username" class="input" placeholder="Escriba su usuario." required>
                    </div>

                    <div class="form-group col-12">
                      <label for="password" class="label">Contraseña</label>
                      <input type="password" id="password" name="password" class="input" placeholder="Escriba su contraseña." required>
                        <p class="small mb-0">¿Olvidaste tu contraseña? <a href="recuperarContrasenia.php">Recuperar contraseña</a></p>
                    </div>
                    
                    <div class="form-group col-12">
                      <button class="btn btn-secondary w-100" type="submit" id="buttonForm" onClick="return validacionInicioSesionYusuario()">Iniciar sesión</button>
                      <!--<input type="submit" name="submit" class="btn btn-secondary w-100" value="Iniciar sesión">-->
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
  <script src="assets/js/validacionInicioSesionYusuario.js"></script>
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