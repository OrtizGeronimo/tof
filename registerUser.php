<?php
  session_start();
  require('models/categoria.php');
  require('models/provincia.php');
  $categorias = Categoria::traerCategoria();
  $provincias = Provincia::traerProvincia();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require("./assets/php/head.php");?>
  <link href="assets/css/styleForms.css" rel="stylesheet">
</head>

<body>
  <?php 
    require("./assets/php/header.php");
    if(isset($_SESSION["s_id_usuario"])){
      echo "<script> window.location.replace('index.php') </script>";
    }
  ?>
  <!-- End Header -->

  <main id="main">

  <!-- ======= Breadcrumbs ======= -->
   <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-12 text-center">
              <h2>Crea una cuenta</h2>
              <p>Ingrese sus datos personales para crear una cuenta</p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.php">Inicio</a></li>
            <li>Registrarme como proveedor</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container-register">
          <div class="row justify-content-center">
            <div class="col-lg-10 col-md-10 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                <form id="registerUser" onsubmit="return passwordValid()" class="row g-3 needs-validation" validate action="" method="post" enctype="multipart/form-data">
                    
                    <h4 class="card-title">General</h4>
                              
                    <div class="row mb-3">

                    </div>

                    <div class="row mb-3" id="nombrePersona" >
                      <label for="nombre" class="col-md-4 col-lg-3 col-form-label">Nombre <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nombre" type="text" class="form-control" id="nombre" maxlength="20" pattern="[A-Za-z]{3,20}" title="Un nombre válido consiste en una cadena con 3 a 20 caracteres. No se aceptan número, símbolos o metacaracteres." value="">
                      </div>
                    </div>

                    <div class="row mb-3" id="apellidoPersona" >
                      <label for="apellido" class="col-md-4 col-lg-3 col-form-label">Apellido <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="apellido" type="text" class="form-control" id="apellido" maxlength="20" pattern="[A-Za-z]{3,20}" title="Un apellido válido consiste en una cadena con 3 a 20 caracteres. No se aceptan número, símbolos o metacaracteres." value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">Email <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="email" value="" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="nombreUsuario" class="col-md-4 col-lg-3 col-form-label">Nombre de usuario <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nombreUsuario" type="text" class="form-control" id="nombreUsuario" maxlength="20" pattern="[A-Za-z0-9]{3,20}" title="Un nombre válido consiste en una cadena con 3 a 20 caracteres. No se aceptan símbolos o metacaracteres." value="" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Contraseña <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword" maxlength="30" pattern="[!-~]{8,30}" title="Una contraseña válida consiste en una cadena con 8 a 30 caracteres." value="" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirmar contraseña <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword" maxlength="30" pattern="[!-~]{8,30}" value="" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="telefono" class="col-md-4 col-lg-3 col-form-label">Teléfono <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <div class="input-group">
                          <span class="input-group-text" id="basic-addon1">+54</span>
                          <input name="telefono" id="telefono" type="tel" class="form-control" size="10" maxlength="10" placeholder="2611234567" pattern="[1-6]{3}[0-9]{3}[0-9]{4}" value="" aria-label="Username"
                          aria-describedby="basic-addon1" required>
                        </div>
                      </div>
                    </div>
                    
                    <!-- <h4 class="card-title">Imágenes y archivos</h4> -->
                    <div class="row mb-3">
                      <label for="imgLogo" class="col-md-4 col-lg-3 col-form-label">Imagen de perfil <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9 imgFotoPerfil">
                          <img id="imgLogo" src="assets/img/profile-img.jpg" alt="Profile">
                          <input name="imgLogo" class="form-control" type="file" id="btnSubirImgLogo" accept="image/png, .jpeg, .jpg">
                        </div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="terms" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">Estoy de acuerdo y acepto los 
                          <a href="avisoLegal.php" target="blank">Términos y condiciones</a></label>
                        <div class="invalid-feedback">Debe estar de acuerdo antes de enviar.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <p id="btn_crearCuenta" class="btn btn-secondary w-100">Crear una cuenta</p>
                    </div>
                  </form>

                  <div class="col-12">
                    <p class="small mb-0">¿Ya tienes una cuenta? <a href="login.php">Iniciar sesión</a></p>
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
  <!-- <script src="assets/js/validacionCheckRadio.js"></script> -->
  <!-- <script src="assets/js/departamento.js"></script> -->
  <script src="assets/js/galeriaImg.js"></script>
  <!-- <script src="assets/js/horarios.js"></script> -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/validation.js"></script>
  <script>
    const form = document.querySelector("#registerUser");
    form.addEventListener("submit",()=>{
      if(!passwordValid()){
        document.querySelector("#newPassword").style.backgroundColor = "pink";
        document.querySelector("#renewPassword").style.backgroundColor = "pink";
        alertSwal('error','Las contraseñas ingresadas no son iguales');
      }
    })

    document.querySelector("#btn_crearCuenta").addEventListener('click',() => {

      let isCamposLlenos = true;

      for (let i = 0; i < form.elements.length; i++) {
        let element = form.elements[i];
        if (element.value === '') {
          isCamposLlenos = false;
          break;
        }
      }
      if(!isCamposLlenos){
        alertSwal('error',"Complete los campos del formulario");
      }else if(!passwordValid()){
        document.querySelector("#newPassword").style.backgroundColor = "pink";
        document.querySelector("#renewPassword").style.backgroundColor = "pink";
        alertSwal('error','Las contraseñas ingresadas no son iguales');
      }else{
        let dataForm = new FormData(form);
  
        $.ajax({
          type: "POST",
          url: "./controller/registerUser.php",
          data: dataForm,
          processData: false,
          contentType: false,
          success: function(result) {
            if(result === '1'){
              alertSwal('success',result);
              location.replace('./admin/newService.php');
            }else{
              alertSwal('error',result);
            }
          },
          error: function(xhr, status, error) {
            alertSwal('error',`${status} : ${error}`);
            // Realiza acciones adicionales en caso de error
          }
        });
      }
    });
  </script>
  <?php
  if(isset($_GET["errorService"])){
    echo "
      <script>
        alertSwal('error','Hubo un problema al crear el usuario');
      </script>
    ";
  }
  ?>
</body>

</html>
