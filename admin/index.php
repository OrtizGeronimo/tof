<?php
  session_start();
  include('./../config/conexion.php');
  require('./../models/usuario.php');
  require('./../models/servicio.php');
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
      $servicio = Servicio::getAllServicios();
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
              <h2>Panel de servicios</h2>
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

            <!-- Servicios -->
            <div class="services-table card shadow">
              <div class="card-header">
                <div class="row">
                  <div class="col-9">Servicios</div>
                  <?php if(strtoupper($_SESSION["s_rol"]) == "ADMIN" || (strtoupper($_SESSION["s_rol"]) != "ADMIN" && mysqli_num_rows($servicio) < 1) ){?>
                    <div class="col-3">
                      <a href="./newService.php" id="" class="btn btn-success" value="Crear Servicios">Crear Servicios</a>
                    </div>
                  <?php } ?>
                </div>
              </div>
              <div class="card-body">
              <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Descripcion</th>
                        <th>Provincia</th>
                        <th>Departamento</th>
                        <th>Usuario</th>
                        <th>Fecha Alta</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row=mysqli_fetch_array($servicio)){?>
                          <tr>
                            <td><?=$row["servicio_nombre"]?></td>
                            <td><?= $row["servicio_descripcion"] ?></td>
                            <td><?=$row["provincia_name"]?></td>
                            <td><?=$row["departamento"]?></td>
                            <td><?=$row["user_nombre"]?></td>
                            <td><?=$row["fec_alta"]?></td>
                            <td>
                              <?php if (strtoupper($_SESSION["s_rol"]) == "ADMIN") {?>
                                      <a id="" href="./updateService.php?idServicio=<?=$row["idServicio"]?>" class="btn btn-warning" type="button">Modificar</a>
                                      <input name="" id="" class="btn btn-danger" type="button" value="Eliminar" onclick="deleteSwal('Estas seguro que desea eliminar el servicio <?=$row['servicio_nombre']?> ?','./../controller/deleteService.php?idServicio=<?=$row['idServicio']?>')">
                            <?php }else{?>
                                      <a id="" href="./updateService.php" class="btn btn-warning" type="button">Modificar</a>
                            <?php } ?>
                          </td>
                          </tr>
                    <?php } ?>
                </tbody>
            </table>    
              </div>
            </div>
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
  <script src="../assets/js/servicios.js"></script>
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
    if(isset($_GET["successService"])){
      echo "
        <script>
          alertSwal('success','Se creo el servicio con exito');
        </script>
      ";
    }else if(isset($_GET["errorService"])){
      echo "
        <script>
          alertSwal('error','Hubo un problema al crear el servicio');
        </script>
      ";
    }else if(isset($_GET["deleteService"])){
      echo "
        <script>
          alertSwal('success','Se elimino el servicio con exito');
        </script>
      ";
    }else if(isset($_GET["errorDeleteService"])){
      echo "
        <script>
          alertSwal('error','No se pudo eliminar el servicio seleccionado');
        </script>
      ";
    }else if(isset($_GET["successModService"])){
      echo "
        <script>
          alertSwal('success','Se modifico el servicio con exito');
        </script>
      ";
    }
  ?>
</body>

</html>