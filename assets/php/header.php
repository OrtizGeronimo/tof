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
              
$menu_items = [
    '/TODOOFICIO/ADMIN/INDEX.PHP' => 'Inicio',
    '/TODOOFICIO/SERVICIOS.PHP' => 'Servicios',
    '/TODOOFICIO/PREGUNTASFRECUENTES.PHP' => 'Preguntas frecuentes',
    '/TODOOFICIO/PLANES.PHP' => 'Planes',
    '/TODOOFICIO/PRENSA.PHP' => 'Prensa',
];

foreach ($menu_items as $item_url => $item_name) {
    if ($url != $item_url) {
        $link = (strpos($url, '/ADMIN/') !== false) ? '../' : '';
        $link .= strtolower(str_replace(['/TODOOFICIO/', '.PHP'], '', $item_url)) . '.php';
        echo "<li><a href=\"$link\">$item_name</a></li>";
    }
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
                
                <?php if (strtoupper($_SESSION["s_rol"]) != "ADMIN") {?>
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
                  <a class="dropdown-item d-flex align-items-center" 
                    href="<?php 
                    if (isset($_SESSION['s_id_servicio'])) {
                        echo file_exists('./admin/updateService.php') ? './admin/updateService.php' : './updateService.php';
                    } else {
                        echo file_exists('./admin/newService.php') ? './admin/newService.php' : './newService.php';
                    }
                    ?>">
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
                                 
                <?php } else {?>
                  <li>
                      <a class="dropdown-item d-flex align-items-center" href="<?=file_exists('./admin/index.php')?'./admin/index.php':'./index.php'?>">
                        <i class="bi bi-bag"></i>
                        <span>Administrar Servicios</span>
                      </a>
                  </li>

                  <li>
                    <hr class="dropdown-divider">
                  </li>

                  <li>
                    <a class="dropdown-item d-flex align-items-center" href="<?=file_exists('./admin/users.php')?'./admin/users.php':'./users.php'?>">
                      <i class="bi bi-person"></i>
                      <span>Administrar Usuarios</span>
                    </a>
                  </li>

                <?php }?>

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