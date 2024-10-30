<?php
  session_start();
  require('../models/categoria.php');
  require('../models/provincia.php');
  require('../models/usuario.php');
  $categorias = Categoria::traerCategoria();
  $provincias = Provincia::traerProvincia();

  

  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php 
    require("./../assets/php/head.php");
  ?>
  <link href="../assets/css/styleForms.css" rel="stylesheet">
</head>

<body>
  <?php 
    require("./../assets/php/header.php");

    if(!isset($_SESSION["s_id_usuario"])){
      header("Location:../index.php");
    }

    $idUsuario = $_SESSION["s_id_usuario"];
    $usuario = mysqli_fetch_array(Usuario::getUsuario($idUsuario));

    $limiteCategorias = 0;

      switch ($usuario["rol"]) {
          case 'gratis':
              $limiteCategorias = 1;
              break;
          case 'basico':
              $limiteCategorias = 2;
              break;
          default:
              $limiteCategorias = PHP_INT_MAX;
              break;          
      }
  ?>
  <!-- End Header -->
  <script>
        // Pasar la variable PHP al archivo JS externo
        const limiteCategorias = <?= $limiteCategorias ?>;
  </script>
  <main id="main">

  <!-- ======= Breadcrumbs ======= -->
   <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-12 text-center">
              <h2>Crea un Servicio</h2>
              <p>Ingrese sus datos para crear una servicio</p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.php">Inicio</a></li> 
            <li>Registrar Servicio</li>
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

                <form class="row g-3 needs-validation" validate action="../controller/newService.php" method="post" enctype="multipart/form-data">
                    
                    <h4 class="card-title">Servicio</h4>
                              
                    <!-- <div class="row mb-3">
                      <label for="nombre" class="col-md-4 col-lg-3 col-form-label">Seleccione una opción</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                          <div class="col radioSO">
                            <div class="form-check" onclick="mostrarPersona()">
                              <input class="form-check-input impHorarios" type="radio" name="gridRadios1"
                                id="persona" value="option1Lunes" checked>
                              <label class="form-check-label lblHorarios" id="lblPersona" for="persona">
                                Persona
                              </label>
                            </div>
                          </div>
                          <div class="col radioSO">
                            <div class="form-check" onclick="mostrarEmpresa()">
                              <input class="form-check-input impHorarios" type="radio" name="gridRadios2"
                                id="empresa" value="option2Lunes">
                              <label class="form-check-label lblHorarios" id="lblEmpresa" for="empresa">
                                Empresa
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> -->

                    <!-- <div class="row mb-3" id="nombrePersona" >
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

                    <div class="row mb-3" id="nombreEmpresa" >
                      <label for="nombreEmpresa" class="col-md-4 col-lg-3 col-form-label">Nombre de la empresa <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nombreEmpresa" type="text" class="form-control" id="nombreEmpresa" maxlength="35" pattern="[A-Za-z]{3,35}" title="Un nombre de una empresa válido consiste en una cadena con 3 a 35 caracteres. No se aceptan número, símbolos o metacaracteres." value="">
                      </div>
                    </div> -->

                    <div class="row mb-3" id="nombreServicio" >
                      <label for="nombreServicio" class="col-md-4 col-lg-3 col-form-label">Nombre del servicio <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nombreServicio" type="text" class="form-control" id="nombreServicio" value="" require>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="descripción" class="col-md-4 col-lg-3 col-form-label">Descripción <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="descripción" class="form-control" id="descripción"
                          style="height: 100px" value="" required></textarea>
                      </div>
                    </div>

                    <!-- <div class="row mb-3">
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
                        <input name="newpassword" type="password" class="form-control" id="newPassword" maxlength="30" pattern="[!-~]{8,30}" title="Una contraseña válida consiste en una cadena con 8 a 30 caracteres." required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirmar contraseña <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword" maxlength="30" pattern="[!-~]{8,30}" required>
                      </div>
                    </div> -->
                    <?php
                      if($usuario["FK_idRol"] == 4 || $usuario["FK_idRol"] == 5 || $usuario["FK_idRol"] == 7){
                    ?>
                    <h4 class="card-title">Imágenes y archivos</h4>

                    <div class="row mb-3">
                      <label for="imgLogo" class="col-md-4 col-lg-3 col-form-label">Imagen de servicio <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                          <!-- <img id="imgLogo" src="" alt="Profile"> -->
                          <input name="imgLogo" class="form-control" type="file" id="btnSubirImgLogo" accept="image/png, .jpeg, .jpg" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                      <label for="imgBanner" class="col-md-4 col-lg-3 col-form-label">Imagen de banner</label>
                      <div class="col-md-8 col-lg-9">
                        <!-- <img class="imgBanner" id="imgBanner" src="" alt="Profile"> -->
                        <input name="imgBanner" class="form-control" type="file" id="btnSubirImgBanner" accept="image/png, .jpeg, .jpg">
                      </div>
                    </div>    
                    <?php
                      }
                    ?>
                    <div class="row mb-3">
                      <label for="imgGaleria[]" class="col-md-4 col-lg-3 col-form-label">Imágenes de Galería</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="imgGaleria[]" class="form-control" type="file" id="btnSubirImgGaleria" accept="image/png, .jpeg, .jpg" multiple>
                          <div id="imgPreviewContainer" class="img-preview-container">
                             
                          </div>
                        </div>
                    </div>
                    
                    <!-- <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Galeria de imagen</label>
                      <div class="col-md-8 col-lg-9">
                        <div id="containerInputImgGaleria">
                        </div>
                        <p id="pGaleria" class="pGaleria">Solo se permiten hasta dos imágenes en la galería. En caso de que desee agregar más consulte los planes para obtener mayores beneficios.</p>
                        <div class="row row-cols-2 row-cols-sm-2 row-cols-md-4" id="containerImg">
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="pdf" class="col-md-4 col-lg-3 col-form-label">PDF</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="pdf" class="form-control" type="file" accept="application/pdf" id="pdf">
                      </div>
                    </div> -->

                    <h4 class="card-title">Información de contacto</h4>

                    <div class="row mb-3">
                      <label for="emailContacto" class="col-md-4 col-lg-3 col-form-label">Email de contacto</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="emailContacto" type="email" class="form-control" id="emailContacto" value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="telefono" class="col-md-4 col-lg-3 col-form-label">Teléfono <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <div class="input-group">
                          <span class="input-group-text" id="basic-addon1">+54</span>
                          <input name="telefono" id="telefono" type="tel" class="form-control" size="10" maxlength="10" placeholder="" pattern="[0-6]{3}[0-9]{3}[0-9]{4}" aria-label="Username"
                            aria-describedby="basic-addon1" value="" required>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="sitioWeb" class="col-md-4 col-lg-3 col-form-label">Sitio web</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="sitioWeb" type="url" class="form-control" id="sitioWeb" placeholder="https://www.SitioWeb.com" value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="facebook" class="col-md-4 col-lg-3 col-form-label">Perfil Facebook</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="redes[facebook]" type="url" class="form-control" id="facebook"
                        placeholder="https://facebook.com/#" value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="instagram" class="col-md-4 col-lg-3 col-form-label">Perfil Instagram</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="redes[instagram]" type="url" class="form-control" id="instagram"
                        placeholder="https://instagram.com/#" value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="linkedin" class="col-md-4 col-lg-3 col-form-label">Perfil Linkedin</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="redes[linkedin]" type="url" class="form-control" id="linkedin"
                        placeholder="https://linkedin.com/#" value="">
                      </div>
                    </div>

                    <h4 class="card-title">Detalles</h4>

                    <div class="row mb-3">
                      <label for="categoria" class="col-md-4 col-lg-3 col-form-label">Categoría <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <p class="col-12 mt-3"><span class="camposObligatorios">Para seleccionar varias categorias mantenga la tecla CTRL o COMMAND apretada</span></p>
                        <select name="categoria[]" id="categoria" class="form-select" aria-label="Default select example" required multiple>
                          <option value = "">Seleccione una o mas categorias</option>
                          <?php  

                            $contador = 1;
                            while($row=mysqli_fetch_array($categorias)) {            
                              ?> <option id="categoria_option_<?php echo $row['idCategoria'] ?>" value="<?php echo $row['idCategoria'] ?>" > <?php echo $row['tipo'] ?> </option> <?php
                              $contador++;
                            }
                          
                          ?>
                        </select>
                      </div>
                      <p id="categorias-seleccionadas" class="col-12 mt-3">Categorias Seleccionadas:</p>
                    </div>

                    <div class="row mb-3">
                      <label for="tags" class="col-md-4 col-lg-3 col-form-label">Tags</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input name="tags[]" class="form-check-input" type="checkbox" id="gridCheck1">
                          <label class="form-check-label lblFC" for="gridCheck1">
                            Acepta Mercado Pago
                          </label>
                        </div>

                        <div class="form-check">
                          <input name="tags[]" class="form-check-input" type="checkbox" id="gridCheck2">
                          <label class="form-check-label lblFC" for="gridCheck2">
                            Acepta Tarjetas de Crédito
                          </label>
                        </div>

                        <div class="form-check">
                          <input name="tags[]" class="form-check-input" type="checkbox" id="gridCheck3">
                          <label class="form-check-label lblFC" for="gridCheck3">
                            Acepta Tarjetas de Débito
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="tipo" class="col-md-4 col-lg-3 col-form-label">Tipo</label>
                      <div class="col-md-8 col-lg-9">
                        <select name="tipo" id="tipo" class="form-select" aria-label="Default select example" required>
                          <option value ="">Abre este menú de selección</option>
                          <option value="Cama adentro">Cama adentro</option>
                          <option value="Freelance">Freelance</option>
                          <option value="Full-time">Full-time</option>
                          <option value="Part-time">Part-time</option>
                        </select>
                      </div>
                    </div>

                    <h4 class="card-title">Ubicación</h4>

                    <div class="row mb-3">
                      <label for="provincia" class="col-md-4 col-lg-3 col-form-label">Provincia <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <select name="provincia" id="provincia" class="form-select" aria-label="Default select example" required>
                          <option value = "">Abre este menú de selección</option>
                          <?php  

                            $contador = 1;
                            while($row=mysqli_fetch_array($provincias)) {
              
                              ?> <option id="optionProvincia" value="<?php echo $row['idProvincia'] ?>"> <?php echo $row['provincia_name'] ?> </option> <?php
                              $contador++;
                            }
                          
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="departamento" class="col-md-4 col-lg-3 col-form-label">Departamento <span class="camposObligatorios">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <select name="departamento" id="departamento" class="form-select departamento" aria-label="Default select example" required>
                          <?php require_once("./../controller/optionDepartamento.php"); ?>                          
                        </select>
                      </div>
                    </div>

                    <h4 class="card-title">Otros</h4>

                    <div class="row mb-3">
                      <label for="horarios" class="col-md-4 col-lg-3 col-form-label">Horarios</label>
                      <div class="col-md-8 col-lg-9">
                        <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                          <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 active" id="lunes-tab" data-bs-toggle="tab"
                              data-bs-target="#bordered-justified-lunes" type="button" role="tab" aria-controls="lunes"
                              aria-selected="true">Lunes</button>
                          </li>
                          <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="martes-tab" data-bs-toggle="tab"
                              data-bs-target="#bordered-justified-martes" type="button" role="tab"
                              aria-controls="martes" aria-selected="false">Martes</button>
                          </li>
                          <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="miércoles-tab" data-bs-toggle="tab"
                              data-bs-target="#bordered-justified-miércoles" type="button" role="tab"
                              aria-controls="miércoles" aria-selected="false">Miércoles</button>
                          </li>
                          <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="jueves-tab" data-bs-toggle="tab"
                              data-bs-target="#bordered-justified-jueves" type="button" role="tab"
                              aria-controls="jueves" aria-selected="false">Jueves</button>
                          </li>
                          <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="viernes-tab" data-bs-toggle="tab"
                              data-bs-target="#bordered-justified-viernes" type="button" role="tab"
                              aria-controls="viernes" aria-selected="false">Viernes</button>
                          </li>
                          <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="sábado-tab" data-bs-toggle="tab"
                              data-bs-target="#bordered-justified-sábado" type="button" role="tab"
                              aria-controls="sábado" aria-selected="false">Sábado</button>
                          </li>
                          <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="domingo-tab" data-bs-toggle="tab"
                              data-bs-target="#bordered-justified-domingo" type="button" role="tab"
                              aria-controls="domingo" aria-selected="false">Domingo</button>
                          </li>
                        </ul>
                        <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                          <div class="tab-pane fade show active" id="bordered-justified-lunes" role="tabpanel"
                            aria-labelledby="lunes-tab">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                              <div class="col">
                                <div class="form-check" onclick="mostrarLunes()">
                                  <input class="form-check-input impHorarios" type="radio" name='horarios[Lunes]'
                                    id="gridRadios1Lunes" value="Ingresar Horarios" checked>
                                  <label class="form-check-label lblHorarios" id="lblHorarios1" for="gridRadios1Lunes">
                                    Ingresar horarios
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check" onclick="ocultarLunes('gridRadios2Lunes')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Lunes]"
                                    id="gridRadios2Lunes" value="Abierto Todo el Día">
                                  <label class="form-check-label lblHorarios" id="lblHorarios2" for="gridRadios2Lunes">
                                    Abierto todo el día
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check" onclick="ocultarLunes('gridRadios3Lunes')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Lunes]"
                                    id="gridRadios3Lunes" value="Cerrado Todo el Día">
                                  <label class="form-check-label lblHorarios" id="lblHorarios3" for="gridRadios3Lunes">
                                    Cerrado todo el día
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check" onclick="ocultarLunes('gridRadios4Lunes')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Lunes]"
                                    id="gridRadios4Lunes" value="Solo con Turnos">
                                  <label class="form-check-label lblHorarios" id="lblHorarios4" for="gridRadios4Lunes">
                                    Solo con turnos
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div id="containerLunes">
                            </div>
                            <div class="row">
                              <div class="col">
                                <button type="button" id="btnAñadirHorariosLunes"
                                  class="btn btn-secondary btnAñadirHorarios">Añadir horarios</button>
                              </div>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="bordered-justified-martes" role="tabpanel"
                            aria-labelledby="martes-tab">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                              <div class="col">
                                <div class="form-check" onclick="mostrarMartes()">
                                  <input class="form-check-input impHorarios" type="radio" name='horarios[Martes]'
                                    id="gridRadios1Martes" value="Ingresar Horarios" checked>
                                  <label class="form-check-label lblHorarios" id="lblHorarios1" for="gridRadios1Martes">
                                    Ingresar horarios
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check" onclick="ocultarMartes('gridRadios2Martes')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Martes]"
                                    id="gridRadios2Martes" value="Abierto Todo el Día">
                                  <label class="form-check-label lblHorarios" id="lblHorarios2" for="gridRadios2Martes">
                                    Abierto todo el día
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check" onclick="ocultarMartes('gridRadios3Martes')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Martes]"
                                    id="gridRadios3Martes" value="Cerrado Todo el Día">
                                  <label class="form-check-label lblHorarios" id="lblHorarios3" for="gridRadios3Martes">
                                    Cerrado todo el día
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check" onclick="ocultarMartes('gridRadios4Martes')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Martes]"
                                    id="gridRadios4Martes" value="Solo con Turnos">
                                  <label class="form-check-label lblHorarios" id="lblHorarios4" for="gridRadios4Martes">
                                    Solo con turnos
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div id="containerMartes">
                            </div>
                            <div class="row">
                              <div class="col">
                                <button type="button" id="btnAñadirHorariosMartes"
                                  class="btn btn-secondary btnAñadirHorarios">Añadir horarios</button>
                              </div>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="bordered-justified-miércoles" role="tabpanel"
                            aria-labelledby="miércoles-tab">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                              <div class="col">
                                <div class="form-check" onclick="mostrarMiercoles()">
                                  <input class="form-check-input impHorarios" type="radio" name='horarios[Miercoles]'
                                    id="gridRadios1Miercoles" value="Ingresar Horarios" checked>
                                  <label class="form-check-label lblHorarios" id="lblHorarios1"
                                    for="gridRadios1Miercoles">
                                    Ingresar horarios
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check" onclick="ocultarMiercoles('gridRadios2Miercoles')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Miercoles]"
                                    id="gridRadios2Miercoles" value="Abierto Todo el Día">
                                  <label class="form-check-label lblHorarios" id="lblHorarios2"
                                    for="gridRadios2Miercoles">
                                    Abierto todo el día
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check" onclick="ocultarMiercoles('gridRadios3Miercoles')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Miercoles]"
                                    id="gridRadios3Miercoles" value="Cerrado Todo el Día">
                                  <label class="form-check-label lblHorarios" id="lblHorarios3"
                                    for="gridRadios3Miercoles">
                                    Cerrado todo el día
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check" onclick="ocultarMiercoles('gridRadios4Miercoles')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Miercoles]"
                                    id="gridRadios4Miercoles" value="Solo con Turnos">
                                  <label class="form-check-label lblHorarios" id="lblHorarios4"
                                    for="gridRadios4Miercoles">
                                    Solo con turnos
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div id="containerMiercoles">
                            </div>
                            <div class="row">
                              <div class="col">
                                <button type="button" id="btnAñadirHorariosMiercoles"
                                  class="btn btn-secondary btnAñadirHorarios">Añadir horarios</button>
                              </div>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="bordered-justified-jueves" role="tabpanel"
                            aria-labelledby="jueves-tab">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                              <div class="col">
                                <div class="form-check" onclick="mostrarJueves()">
                                  <input class="form-check-input impHorarios" type="radio" name='horarios[Jueves]'
                                    id="gridRadios1Jueves" value="Ingresar Horarios" checked>
                                  <label class="form-check-label lblHorarios" id="lblHorarios1" for="gridRadios1Jueves">
                                    Ingresar horarios
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check" onclick="ocultarJueves('gridRadios2Jueves')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Jueves]"
                                    id="gridRadios2Jueves" value="Abierto Todo el Día">
                                  <label class="form-check-label lblHorarios" id="lblHorarios2" for="gridRadios2Jueves">
                                    Abierto todo el día
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check" onclick="ocultarJueves('gridRadios3Jueves')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Jueves]"
                                    id="gridRadios3Jueves" value="Cerrado Todo el Día">
                                  <label class="form-check-label lblHorarios" id="lblHorarios3" for="gridRadios3Jueves">
                                    Cerrado todo el día
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check" onclick="ocultarJueves('gridRadios4Jueves')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Jueves]"
                                    id="gridRadios4Jueves" value="Solo con Turnos">
                                  <label class="form-check-label lblHorarios" id="lblHorarios4" for="gridRadios4Jueves">
                                    Solo con turnos
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div id="containerJueves">
                            </div>
                            <div class="row">
                              <div class="col">
                                <button type="button" id="btnAñadirHorariosJueves"
                                  class="btn btn-secondary btnAñadirHorarios">Añadir horarios</button>
                              </div>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="bordered-justified-viernes" role="tabpanel"
                            aria-labelledby="viernes-tab">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                              <div class="col">
                                <div class="form-check" onclick="mostrarViernes()">
                                  <input class="form-check-input impHorarios" type="radio" name='horarios[Viernes]'
                                    id="gridRadios1Viernes" value="Ingresar Horarios" checked>
                                  <label class="form-check-label lblHorarios" id="lblHorarios1"
                                    for="gridRadios1Viernes">
                                    Ingresar horarios
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check" onclick="ocultarViernes('gridRadios2Viernes')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Viernes]"
                                    id="gridRadios2Viernes" value="Abierto Todo el Día">
                                  <label class="form-check-label lblHorarios" id="lblHorarios2"
                                    for="gridRadios2Viernes">
                                    Abierto todo el día
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                              <div class="form-check" onclick="ocultarViernes('gridRadios3Viernes')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Viernes]"
                                    id="gridRadios3Viernes" value="Cerrado Todo el Día">
                                  <label class="form-check-label lblHorarios" id="lblHorarios3"
                                    for="gridRadios3Viernes">
                                    Cerrado todo el día
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check" onclick="ocultarViernes('gridRadios4Viernes')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Viernes]"
                                    id="gridRadios4Viernes" value="Solo con Turnos">
                                  <label class="form-check-label lblHorarios" id="lblHorarios4"
                                    for="gridRadios4Viernes">
                                    Solo con turnos
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div id="containerViernes">
                            </div>
                            <div class="row">
                              <div class="col">
                                <button type="button" id="btnAñadirHorariosViernes"
                                  class="btn btn-secondary btnAñadirHorarios">Añadir horarios</button>
                              </div>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="bordered-justified-sábado" role="tabpanel"
                            aria-labelledby="sábado-tab">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                              <div class="col">
                                <div class="form-check" onclick="mostrarSabado()">
                                  <input class="form-check-input impHorarios" type="radio" name='horarios[Sabado]'
                                    id="gridRadios1Sabado" value="Ingresar Horarios" checked>
                                  <label class="form-check-label lblHorarios" id="lblHorarios1" for="gridRadios1Sabado">
                                    Ingresar horarios
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check" onclick="ocultarSabado('gridRadios2Sabado')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Sabado]"
                                    id="gridRadios2Sabado" value="Abierto Todo el Día">
                                  <label class="form-check-label lblHorarios" id="lblHorarios2" for="gridRadios2Sabado">
                                    Abierto todo el día
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check" onclick="ocultarSabado('gridRadios3Sabado')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Sabado]"
                                    id="gridRadios3Sabado" value="Cerrado Todo el Día">
                                  <label class="form-check-label lblHorarios" id="lblHorarios3" for="gridRadios3Sabado">
                                    Cerrado todo el día
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check" onclick="ocultarSabado('gridRadios4Sabado')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Sabado]"
                                    id="gridRadios4Sabado" value="Solo con Turnos">
                                  <label class="form-check-label lblHorarios" id="lblHorarios4" for="gridRadios4Sabado">
                                    Solo con turnos
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div id="containerSabado">
                            </div>
                            <div class="row">
                              <div class="col">
                                <button type="button" id="btnAñadirHorariosSabado"
                                  class="btn btn-secondary btnAñadirHorarios">Añadir horarios</button>
                              </div>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="bordered-justified-domingo" role="tabpanel"
                            aria-labelledby="domingo-tab">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                              <div class="col">
                                <div class="form-check" onclick="mostrarDomingo()">
                                  <input class="form-check-input impHorarios" type="radio" name='horarios[Domingo]'
                                    id="gridRadios1Domingo" value="Ingresar Horarios" checked>
                                  <label class="form-check-label lblHorarios" id="lblHorarios1"
                                    for="gridRadios1Domingo">
                                    Ingresar horarios
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check" onclick="ocultarDomingo('gridRadios2Domingo')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Domingo]"
                                    id="gridRadios2Domingo" value="Abierto Todo el Día">
                                  <label class="form-check-label lblHorarios" id="lblHorarios2"
                                    for="gridRadios2Domingo">
                                    Abierto todo el día
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check" onclick="ocultarDomingo('gridRadios3Domingo')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Domingo]"
                                    id="gridRadios3Domingo" value="Cerrado Todo el Día">
                                  <label class="form-check-label lblHorarios" id="lblHorarios3"
                                    for="gridRadios3Domingo">
                                    Cerrado todo el día
                                  </label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check" onclick="ocultarDomingo('gridRadios4Domingo')">
                                  <input class="form-check-input impHorarios" type="radio" name="horarios[Domingo]"
                                    id="gridRadios4Domingo" value="Solo con Turnos">
                                  <label class="form-check-label lblHorarios" id="lblHorarios4"
                                    for="gridRadios4Domingo">
                                    Solo con turnos
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div id="containerDomingo">
                            </div>
                            <div class="row">
                              <div class="col">
                                <button type="button" id="btnAñadirHorariosDomingo"
                                  class="btn btn-secondary btnAñadirHorarios">Añadir horarios</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-secondary w-100" type="submit">Crear Servicio</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <template id="template">
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 selectHorarios" id="selectHorarios">
          <div class="col-md-5">
            <select class="form-select" id="desde" name="desde" aria-label="Default select example">
              <option selected>De</option>
              <?php require_once("../controller/optionHorarioDesde.php"); ?>     
            </select>
          </div>
          <div class="col-md-5">
            <select class="form-select" id="hasta" name="hasta" aria-label="Default select example">
              <option selected>Hasta</option>
              <?php require_once("../controller/optionHorarioHasta.php"); ?>     
            </select>
          </div>
          <div class="col-md-2">
            <button type="button" onclick="BorrarHorario(id)" id="btnBorrarHorario" class="btn btn-secondary btnBorrarHorario"><i class="bi bi-trash-fill"></i></button>
          </div>
        </div>
      </template>

      <template id="templateGaleriaImg">
        <div class="col" id="contImagenPrevisualizacion">
          <img class="imagenPrevisualizacion" id="imagenPrevisualizacion" src="" alt="">
          <button type="button" onclick="BorrarImagenPrevisualizacion(id)" id="btnImagenPrevisualizacion" class="btn btn-secondary btnImagenPrevisualizacion"><i class="bi bi-trash-fill"></i></button>
        </div>
      </template>

      <template id="templateInputImgGaleria">
        <input name="btnSubirImg" onclick="inputSubirImg(id)" class="form-control btnSubirImg" id="btnSubirImg" type="file" accept="image/png, .jpeg, .jpg" style="color: transparent">
      </template>
    </div>

  </main><!-- End #main -->

  <?php require("./../assets/php/footer.php")?>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <script>
    const userRole = <?= $usuario["FK_idRol"]; ?>;
    
</script>
  <!-- Vendor JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  
  <!-- Template Main JS File -->
  <!-- <script src="../assets/js/validacionCheckRadio.js"></script> -->
  <script src="../assets/js/departamento.js"></script>
  <script src="../assets/js/galeriaImg.js"></script>
  <script src="../assets/js/horarios.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/selectCategorias.js"></script>  
</body>

</html>
