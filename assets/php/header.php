<header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="<?=(file_exists('./admin/index.php'))?'./index.php':'./../index.php'?>" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="<?=(file_exists("assets/img/logos/logoAmarilloSinFondo.png")?'assets/img/logos/logoAmarilloSinFondo.png' : '../assets/img/logos/logoAmarilloSinFondo.png')?>" alt="">
      </a>
        
      <div class="col">
        <nav id="navbar" class="navbar">
          <ul>
            <?php
              $url= strtoupper($_SERVER["REQUEST_URI"]);
              if ($url != '/TODOOFICIO/INDEX.PHP') {

                ?><li><a href="<?= ($url == '/TODOOFICIO/ADMIN/INDEX.PHP')?'../index.php' : 'index.php'?>">Inicio</a></li><?php
              }
            ?>
            <?php              
              if ($url != '/TODOOFICIO/SERVICIOS.PHP') {
                ?><li><a href="<?=(file_exists('../servicios.php'))?'../servicios.php' : 'servicios.php'?>">Servicios</a></li><?php
              }
            ?>
            <?php              
              if ($url != '/TODOOFICIO/PREGUNTASFRECUENTES.PHP') {
                ?><li><a href="<?= (file_exists( '../preguntasfrecuentes.php'))? '../preguntasfrecuentes.php' : 'preguntasfrecuentes.php'?>">Preguntas frecuentes</a></li><?php
              }
            ?>
            <?php              
              if ($url != '/TODOOFICIO/PLANES.PHP') {
                ?><li><a href="<?=(file_exists('../planes.php'))?'../planes.php' : 'planes.php'?>">Planes</a></li><?php
              }
            ?>
            <?php              
              if ($url != '/TODOOFICIO/PRENSA.PHP') {
                ?><li><a href="<?=(file_exists('../prensa.php'))?'../prensa.php' : 'prensa.php'?>">Prensa</a></li><?php
              }
            ?>
            <li><a href="#footer">Contacto</a></li>
          </ul>
        </nav><!-- .navbar -->
      </div>
      
      <?php if(isset($_SESSION['s_nombre'])){ ?>
          <div class="col-2 justify-content-end navLinkPerfil">
            <li class="nav-item dropdown pe-3">
              <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <img src="<?php
                  if(file_exists($_SESSION['s_img_perfil'])){
                    echo $_SESSION['s_img_perfil'];
                  }else if(file_exists("../".$_SESSION['s_img_perfil'])){
                    echo '../'.$_SESSION['s_img_perfil'];
                  }else if(file_exists("../../".$_SESSION['s_img_perfil'])){
                    echo '../../'.$_SESSION['s_img_perfil'];
                  }else{
                    echo (file_exists('./assets/img/user_profile.webp')?'./assets/img/user_profile.webp':'./../assets/img/user_profile.webp');
                  }?>" alt="Profile" class="rounded-circle">
                
                <?php echo '<span class="d-none d-md-block dropdown-toggle ps-2">'.$_SESSION['s_nombre'].'</span>'?>
              </a><!-- End Profile Iamge Icon -->

              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                  <?php echo '<h6>'.$_SESSION['s_nombre'].'</h6>'?>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="<?= file_exists('preguntasFrecuentes.php')?'preguntasFrecuentes.php' : '../preguntasFrecuentes.php'?>">
                    <i class="bi bi-question-circle"></i>
                    <span> Necesita ayuda?</span>
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>

                <li>
                  <a class="dropdown-item d-flex align-items-center" href="<?=file_exists('./admin/index.php')?'./admin/index.php':'./index.php'?>">
                    <i class="bi bi-bag"></i>
                    <span>Mi servicio</span>
                  </a>
                </li>

                <li>
                  <hr class="dropdown-divider">
                </li>

                <li>
                  <a class="dropdown-item d-flex align-items-center" href="<?=file_exists('editUser.php')?'editUser.php':'../editUser.php'?>">
                    <i class="bi bi-key"></i>
                    <span>Editar Plan</span>
                  </a>
                </li>

                <li>
                  <hr class="dropdown-divider">
                </li>

                <li>
                  <a class="dropdown-item d-flex align-items-center" href="<?=file_exists('editUser.php')?'editUser.php':'../editUser.php'?>">
                    <i class="bi bi-pencil"></i>
                    <span>Editar Perfil</span>
                  </a>
                </li>

                <li>
                  <hr class="dropdown-divider">
                </li>
                
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="<?=file_exists('logout.php')?'logout.php':'../logout.php'?>">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Cerrar sesión</span>
                  </a>
                </li>

              </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
          </div>
      <?php } else { ?>
        <div class="justify-content-end navLinkPerfil">
            <nav class="row sesion">
              <div class="col">
              <ul>
              <?php
                if ($url != '/TODOOFICIO/LOGIN.PHP') {
                  ?><li><a href="<?=file_exists('login.php')?'login.php':'../login.php'?>">Iniciar Sesión</a></li><?php
                }
              ?>
              </ul>  
              </div>
              <div class="col">
              <ul>
              <?php
                if ($url != '/TODOOFICIO/REGISTERUSER.PHP') {
                  ?><li><a href="<?=file_exists('registerUser.php')?'registerUser.php' : '../registerUser.php'?>">Registrarse</a></li><?php
                }
              ?>
              </ul>  
              </div>
            </nav>
        </div>              
      <?php } ?>

    </div>

    <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
    <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
  </header>