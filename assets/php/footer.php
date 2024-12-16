<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
  <div class="container">
    <div class="row gy-4">
      
      <!-- Columna del logo -->
      <div class="col-lg-4 col-md-12 footer-info d-flex justify-content-center justify-content-md-start">
        <a href="./index.php" class="logo d-flex align-items-center">
          <img src="<?=(file_exists("assets/img/logos/negroSinFondo1.png")?'assets/img/logos/negroSinFondo1.png' : '../assets/img/logos/negroSinFondo1.png')?>" alt="logo" class="img-fluid" style="max-width: 150px;">
        </a>
      </div>

      <!-- Secciones del footer -->
      <div class="col-lg-2 col-12 footer-links d-flex flex-column ">
        <h4>Secciones</h4>
        <ul class="list-unstyled text-center text-md-start">
          <li><a href="./index.php">Inicio</a></li>
          <li>
            <?php if(!empty($_SESSION["s_id_usuario"])){ ?>
              <a href="./editUser.php">Editar Perfil</a>
            <?php }else{ ?>
              <a href="./registerUser.php">Registrarse</a>
            <?php }; ?>
          </li>
          <li><a href="./planes.php">Planes de Suscripción</a></li>
        </ul>
      </div>

      <!-- Contacto -->
      <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
        <h4>Contacto</h4>
        <p>
          <strong>Teléfono:</strong> +54261 775 6836<br>
          <strong>Email:</strong> administracion@todooficio.com<br>
        </p>
      </div>

      <!-- Redes sociales -->
      <div class="col-lg-2 col-12 footer-social d-flex flex-column align-items-center ">
        <h4 class="text-center w-100">Redes</h4> <!-- Título centrado -->
        <div class="social-links d-flex justify-content-center mt-2">
          <a href="https://www.facebook.com/profile.php?id=100082962235556" target="blank" class="facebook mx-2"><i class="bi bi-facebook"></i></a>
          <a href="https://www.instagram.com/todooficio/?hl=es-la" target="blank" class="instagram mx-2"><i class="bi bi-instagram"></i></a>
          <a href="https://api.whatsapp.com/send?phone=542617756836" target="blank" class="whatsapp mx-2"><i class="bi bi-whatsapp"></i></a>
        </div>
      </div>

    </div>
  </div>

  <!-- Sección de derechos de autor -->
  <div class="container mt-4">
    <div class="copyright text-center">
      &copy; <a href="avisoLegal.php" style="color: black"> <strong><span><?= date("Y"); ?> TODOOFICIO.COM</span></strong> </a>. Todos los derechos reservados
    </div>
  </div>

</footer><!-- End Footer -->
<!-- End Footer -->
