<?php
  session_start();
  require('models/categoria.php');
  require('models/provincia.php');
  require('models/usuario.php');
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
    $userA = "";
    $user = "";
    if(!isset($_SESSION["s_id_usuario"])){
      echo "<script> window.location.replace('index.php') </script>";
    }else{
      $userA = Usuario::getUsuario($_SESSION["s_id_usuario"]);
      $user = mysqli_fetch_array($userA);
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

                <form id="registerUser" class="row g-3 needs-validation" validate action="./controller/editUser.php" method="post" enctype="multipart/form-data">
                    
                    <h4 class="card-title">General</h4>
                              
                    <?php
                      $nombreCompleto = explode(" ",$user["user_nombre"]) ;
                      $nombre = $nombreCompleto[0];
                      $apellido = isset($nombreCompleto[1])?$nombreCompleto[1]:'';
                    ?>
                    <input type="hidden" name="idUsuario" value="<?= $_SESSION["s_id_usuario"] ?>">
                    <div class="row mb-3" id="nombrePersona" >
                      <label for="nombre" class="col-md-4 col-lg-3 col-form-label">Nombre <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nombre" type="text" class="form-control" id="nombre" maxlength="20" pattern="[A-Za-z]{3,20}" title="Un nombre válido consiste en una cadena con 3 a 20 caracteres. No se aceptan número, símbolos o metacaracteres." value="<?=$nombre?>">
                      </div>
                    </div>

                    <div class="row mb-3" id="apellidoPersona" >
                      <label for="apellido" class="col-md-4 col-lg-3 col-form-label">Apellido <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="apellido" type="text" class="form-control" id="apellido" maxlength="20" pattern="[A-Za-z]{3,20}" title="Un apellido válido consiste en una cadena con 3 a 20 caracteres. No se aceptan número, símbolos o metacaracteres." value="<?=$apellido?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">Email <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="email" value="<?=$user["user_email"]?>" disabled required>
                      </div>
                    </div>
                    <input name="email" type="hidden" value="<?=$user["user_email"]?>"required>
                    <input name="nombreUsuario" type="hidden" value="<?=$user["user_login"]?>"  required>
                    <div class="row mb-3">
                      <label for="nombreUsuario" class="col-md-4 col-lg-3 col-form-label">Nombre de usuario <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nombreUsuario" type="text" class="form-control" id="nombreUsuario" maxlength="20" pattern="[A-Za-z0-9]{3,20}" title="Un nombre válido consiste en una cadena con 3 a 20 caracteres. No se aceptan símbolos o metacaracteres." value="<?=$user["user_login"]?>"  disabled required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nueva contraseña</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword" maxlength="30" pattern="[!-~]{8,30}" title="Una contraseña válida consiste en una cadena con 8 a 30 caracteres." value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirmar contraseña</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword" maxlength="30" pattern="[!-~]{8,30}" value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="telefono" class="col-md-4 col-lg-3 col-form-label">Teléfono <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <div class="input-group">
                          <span class="input-group-text" id="basic-addon1">+54</span>
                          <input name="telefono" id="telefono" type="tel" class="form-control" size="10" maxlength="10" placeholder="2611234567" pattern="[0-6]{3}[0-9]{3}[0-9]{4}" value="<?=$user["user_telefono"]?>" aria-label="Username"
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
                      <button class="btn btn-secondary w-100" type="submit">Editar Perfil</button>
                    </div>
                  </form>
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
    if(document.querySelector("#newPassword").value == "" && document.querySelector("#renewPassword").value == ""){
      const form = document.querySelector("#registerUser");
      form.addEventListener("submit",()=>{
        if(!passwordValid()){
          document.querySelector("#newPassword").style.backgroundColor = "pink";
          document.querySelector("#renewPassword").style.backgroundColor = "pink";
          alertSwal('error','Las contraseñas ingresadas no son iguales');
        }
      })
    }
  </script>

<?php
    if(isset($_GET["success"])){
      echo "
        <script>
          alertSwal('success','Se actualizo el perfil correctamente');
        </script>
      ";
    }else if(isset($_GET["error"])){
      echo "
        <script>
          alertSwal('error','Hubo un problema al actualizar el perfil');
        </script>
      ";
    }
?>
</body>

</html>
