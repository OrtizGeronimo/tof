<?php
  session_start();
  include('./../config/conexion.php');
  require('./../models/usuario.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require("./../assets/php/head.php");?>
</head>

<body>
  <?php 
    require("./../assets/php/header.php");
    if(isset($_SESSION["s_id_usuario"]) && (strtoupper($_SESSION["s_rol"]) === "ADMIN")){
      $usuarios = Usuario::getAllUsuarios();
    }else{
      header("Location:../index.php");
    }
  ?>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <h2>Panel de Usuarios</h2>
              <!-- <p>Encontra los mejores profesionales cerca</p> -->
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.php">Inicio</a></li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row g-5">
          
          

          <div class="col-lg-12">

            <!-- Usuarios -->
            <form id="generateReportForm" action="./../controller/generarReporte.php" method="POST">
              <div class="services-table card shadow">
                <div class="card-header">
                  <div class="row">
                    <div class="col-9">Usuarios</div>
                    <?php if(strtoupper($_SESSION["s_rol"]) == "ADMIN" || (strtoupper($_SESSION["s_rol"]) != "ADMIN" && mysqli_num_rows($usuarios) < 1) ){?>
                      <div class="col-3 text-end">
                        <!--<a href="./registerUser.php" id="" class="btn btn-success" value="Crear Usuarios">Crear Usuarios</a>-->
                        <button type="submit" id="btnReporte" class="btn btn-warning">Generar Reporte</button>
                      </div>
                    <?php } ?>
                  </div>
                </div>
                <div class="card-body">
                <table id="table_id" class="display">
                  <thead>
                      <tr>
                          <th>Seleccionar</th>
                          <th>Nombre</th>
                          <th>Email</th>
                          <th>Servicio</th>
                          <th>Telefono</th>
                          <th>Rol</th>
                          <th>Fecha Alta</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php while($row=mysqli_fetch_array($usuarios)){?>
                            <tr>
                              <td>
                                  <input type="checkbox" name="selected_users[]" value="<?=$row['idUsuario']?>">
                              </td>
                              <td><?=$row["user_nombre"]?></td>
                              <td><?= $row["user_email"] ?></td>
                              <td>
                                <?php if (isset($row["idServicio"])) {?>
                                          <a id="" href="./updateService.php?idServicio=<?=$row["idServicio"]?>" ><?=$row["servicio_nombre"]?></a>
                                <?php }else{?>
                                          <p>No tiene</p>
                                <?php } ?>
                              </td>
                              <td><?=$row["user_telefono"]?></td>
                              <td><?=$row["rol"]?></td>
                              <td><?=$row["fec_alta"]?></td>
                              <td>
                                  <a id="" href="./../editUser.php?idUsuario=<?=$row["idUsuario"]?>" class="btn btn-warning" type="button">Modificar</a>
                                  <form action="./../controller/deleteUser.php" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar el usuario <?=$row['user_nombre']?>?')">
                                    <input type="hidden" name="email" value="<?=$row['user_email']?>">
                                    <button class="btn btn-danger" type="submit">Eliminar</button>
                                  </form>
                            </td>
                            </tr>
                      <?php } ?>
                  </tbody>
              </table>    
                </div>
              </div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Blog Details Section -->

  </main><!-- End #main --> 

  <?php require("./../assets/php/footer.php")?>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

  <!-- Data table -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
  <script>
    $(document).ready( function () {
      $('#table_id').DataTable();
    });
  </script>
  <?php
    if(isset($_GET["successUser"])){
      echo "
        <script>
          alertSwal('success','Se creo el usuario con exito');
        </script>
      ";
    }else if(isset($_GET["errorUser"])){
      echo "
        <script>
          alertSwal('error','Hubo un problema al crear el usuario');
        </script>
      ";
    }else if(isset($_GET["deleteUser"])){
      echo "
        <script>
          alertSwal('success','Se elimino el usuario con exito');
        </script>
      ";
    }else if(isset($_GET["errorDeleteUser"])){
      echo "
        <script>
          alertSwal('error','No se pudo eliminar el usuario seleccionado');
        </script>
      ";
    }else if(isset($_GET["successModUser"])){
      echo "
        <script>
          alertSwal('success','Se modifico el usuario con exito');
        </script>
      ";
    }
  ?>
</body>

</html>