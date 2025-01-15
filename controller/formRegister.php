<?php

if (!empty($_POST['gridRadios1'])) {

    if ((!empty($_POST['nombre'])) && (!empty($_POST['apellido'])) && (!empty($_POST['descripción'])) && (!empty($_POST['email'])) && (!empty($_POST['nombreUsuario'])) && (!empty($_POST['newpassword'])) && (!empty($_POST['renewpassword'])) && (!empty($_FILES['imgLogo'])) && (!empty($_POST['telefono'])) && (!empty($_POST['categoria'])) && (!empty($_POST['provincia'])) && (!empty($_POST['departamento']))) {
        
        $nomUsuario = $_POST['nombreUsuario'];
        $email = $_POST['email'];

        require('../models/usuario.php');
        $usuarios = Usuario::getUsuarios($nomUsuario);        
        $bandera = false;

        while($row=mysqli_fetch_array($usuarios)) {
            
            if ($nomUsuario == $row['user_login']) {

                $bandera = true;
                header("Location: ../register.php");
                
            }
            
        }

        $usuarios = Usuario::getUsuariosEmail($email);        

        while($row=mysqli_fetch_array($usuarios)) {
            
            if ($email == $row['user_email']) {

                $bandera = true;
                header("Location: ../register.php");
                
            }
            
        }

        if ($bandera == false) {

            if ($_POST['newpassword'] == $_POST['renewpassword']) {

                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];

                if (((preg_match("/([0-9])/", $nombre)) == 0) && ((preg_match("/([0-9])/", $apellido)) == 0)) {
                    
                    $nombreApellido = $nombre ." " .$apellido;
                    $telefono = $_POST['telefono'];
                    $descripción = $_POST['descripción'];
                    $password = sha1($_POST['newpassword']);
                    $carpeta = '../archivos/user_' .$nomUsuario;

                    if (!file_exists($carpeta)) {
                        
                        mkdir($carpeta, 0777, true);

                        try {

                            $imgLogo = $_FILES['imgLogo']['name'];
                            $imgBanner = $_FILES['imgBanner']['name'];
                            $Img0 = $_FILES['btnSubirImg0']['name'];
                            $Img1 = $_FILES['btnSubirImg1']['name'];
                            $pdf = $_FILES['pdf']['name'];
            
                        } catch (Exception $e) {
            
                            echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
            
                        }
            
                        if (isset($imgLogo) && $imgLogo != "") {
            
                            $tipo = $_FILES['imgLogo']['type'];
                            $tamano = $_FILES['imgLogo']['size'];
                            $temp = $_FILES['imgLogo']['tmp_name'];
                            
                            if (!((strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 3048576))) {
                                echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                                - Se permiten archivos .jpg, .png. y de 1MB como máximo.</b></div>';
                            }
                            else {

                                $imgLogoRuta = $carpeta .'/' .$imgLogo;
                            
                                if (move_uploaded_file($temp, $imgLogoRuta)) {
                                
                                    chmod($imgLogoRuta, 0777);
                                    $imgLogoRuta = 'archivos/user_' .$nomUsuario .'/' .$imgLogo;
                                    echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                                }
                                else {
                                
                                    echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                                }
                            }

                        } else {

                            $imgLogoRuta = 'assets/img/logos/negroFondoAmarillo.png';
                        }
            
                        if (isset($imgBanner) && $imgBanner != "") {
            
                            $tipo = $_FILES['imgBanner']['type'];
                            $tamano = $_FILES['imgBanner']['size'];
                            $temp = $_FILES['imgBanner']['tmp_name'];
                            
                            if (!((strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 3048576))) {
                                echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                                - Se permiten archivos .jpg, .png. y de 2MB como máximo.</b></div>';
                            }
                            else {

                                $imgBannerRuta = $carpeta .'/' .$imgBanner;
                            
                                if (move_uploaded_file($temp, $imgBannerRuta)) {
                                
                                    chmod($imgBannerRuta, 0777);
                                    $imgBannerRuta = 'archivos/user_' .$nomUsuario .'/' .$imgBanner;
                                    echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                                }
                                else {
                                
                                    echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                                }
                            }
                            
                        } else {

                            $imgBannerRuta = 'assets/img/hero-bg-abstract.jpg';
                        }
            
                        if (isset($Img0) && $Img0 != "") {
            
                            $tipo = $_FILES['btnSubirImg0']['type'];
                            $tamano = $_FILES['btnSubirImg0']['size'];
                            $temp = $_FILES['btnSubirImg0']['tmp_name'];
                            
                            if (!((strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 3048576))) {
                                echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                                - Se permiten archivos .jpg, .png. y de 1MB como máximo.</b></div>';
                            }
                            else {
                            
                                $Img0Ruta = $carpeta .'/' .$Img0;

                                if (move_uploaded_file($temp, $Img0Ruta)) {
                                
                                    chmod($Img0Ruta, 0777);
                                    $Img0Ruta = 'archivos/user_' .$nomUsuario .'/' .$Img0;
                                    echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
            
                                }
                                else {
                                
                                    echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                                }
                            }

                        } else {

                            $Img0Ruta = "--";
                        }
            
                        if (isset($Img1) && $Img1 != "") {
            
                            $tipo = $_FILES['btnSubirImg1']['type'];
                            $tamano = $_FILES['btnSubirImg1']['size'];
                            $temp = $_FILES['btnSubirImg1']['tmp_name'];
                            
                            if (!((strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 3048576))) {
                                echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                                - Se permiten archivos .jpg, .png. y de 1MB como máximo.</b></div>';
                            }
                            else {

                                $Img1Ruta = $carpeta .'/' .$Img1;
                            
                                if (move_uploaded_file($temp, $Img1Ruta)) {
                                
                                    chmod($Img1Ruta, 0777);
                                    $Img1Ruta = 'archivos/user_' .$nomUsuario .'/' .$Img1;
                                    echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                                }
                                else {
                                
                                    echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                                }
                            }

                        } else {

                            $Img1Ruta = "--";
                        }
            
                        if (isset($pdf) && $pdf != "") {
            
                            $tipo = $_FILES['pdf']['type'];
                            $tamano = $_FILES['pdf']['size'];
                            $temp = $_FILES['pdf']['tmp_name'];
                            
                            if (!((strpos($tipo, "pdf")) && ($tamano < 3048576))) {
                                echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                                - Se permiten archivos .jpg, .png. y de 1MB como máximo.</b></div>';
                            }
                            else {

                                $pdfRuta = $carpeta .'/' .$pdf;
                            
                                if (move_uploaded_file($temp, $pdfRuta)) {
                                
                                    chmod($pdfRuta, 0777);
                                    $pdfRuta = 'archivos/user_' .$nomUsuario .'/' .$pdf;
                                    echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                                }
                                else {
                                
                                    echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                                }
                            }

                        } else {

                            $pdfRuta = "--";
                        }
                        
                    }
                    
                    if (!empty($_POST['emailContacto'])) {

                        $emailContacto = $_POST['emailContacto'];

                    } else {

                        $emailContacto = $email;
                    }

                    if ((preg_match("/[1-6]{3}[0-9]{3}[0-9]{4}/", $telefono)) == 0) {
                        header("Location: ../register.php");
                    } 

                    if (!empty($_POST['sitioWeb'])) {

                        $sitioWeb = $_POST['sitioWeb'];

                    } else {

                        $sitioWeb = "--";

                    }

                    if (!empty($_POST['facebook'])) {

                        $facebook = $_POST['facebook'];

                    } else {

                        $facebook = "--";
                        
                    }

                    if (!empty($_POST['instagram'])) {

                        $instagram = $_POST['instagram'];

                    } else {

                        $instagram = "--";
                        
                    }

                    if (!empty($_POST['linkedin'])) {

                        $linkedin = $_POST['linkedin'];

                    } else {

                        $linkedin = "--";
                        
                    }
                                     
                    if ($_POST['categoria'] == "Abre este menú de selección") {

                        header("Location: ../register.php");
                        
                    } else {

                        $categoria = $_POST['categoria'];

                        if (!empty($_POST['nombreServicio'])) {

                            $nombreServicio = $_POST['nombreServicio'];

                        } else {

                            $nombreServicio = $categoria;
                        }

                    }

                    if (!empty($_POST['tags1'])) {

                        $tags1 = "Acepta Mercado Pago";

                    } else {

                        $tags1 = "--";

                    }

                    if (!empty($_POST['tags2'])) {

                        $tags2 = "Acepta Tarjetas de Crédito";
         
                    } else {

                        $tags2 = "--";

                    }

                    if (!empty($_POST['tags3'])) {

                        $tags3 = "Acepta Tarjetas de Débito";

                    } else {

                        $tags3 = "--";

                    }

                    if ($_POST['tipo'] == "Abre este menú de selección") {

                        header("Location: ../register.php");

                    } else {

                        $tipo = $_POST['tipo'];

                    }                    
                    
                    if ($_POST['provincia'] == "Abre este menú de selección") {

                        header("Location: ../register.php");

                    } else {

                        $provincia = $_POST['provincia'];

                    }

                    if ($_POST['departamento'] == "Abre este menú de selección") {

                        header("Location: ../register.php");

                    } else {

                        $departamento = $_POST['departamento'];

                    }

                    if ((isset($nombreApellido) && $nombreApellido != "") && (isset($nombreServicio) && $nombreServicio != "") && (isset($descripción) && $descripción != "") && (isset($email) && $email != "") && (isset($nomUsuario) && $nomUsuario != "") && (isset($password) && $password != "") && (isset($imgLogoRuta) && $imgLogoRuta != "") && (isset($imgBannerRuta) && $imgBannerRuta != "") && (isset($Img0Ruta) && $Img0Ruta != "") && (isset($Img1Ruta) && $Img1Ruta != "") && (isset($pdfRuta) && $pdfRuta != "") && (isset($emailContacto) && $emailContacto != "") && (isset($telefono) && $telefono != "") && (isset($sitioWeb) && $sitioWeb != "") && (isset($facebook) && $facebook != "") && (isset($instagram) && $instagram != "") && (isset($linkedin) && $linkedin != "") && (isset($categoria) && $categoria != "") && (isset($tags1) && $tags1 != "") && (isset($tags2) && $tags2 != "") && (isset($tags3) && $tags3 != "") && (isset($tipo) && $tipo != "") && (isset($provincia) && $provincia != "") && (isset($departamento) && $departamento != "")) {
                         
                        if (Usuario::agregarUsuarios($nomUsuario,$password,$email,$imgLogoRuta,$imgBannerRuta,$telefono,$nombreApellido) == true) {
                            echo "Usuario creado con exito.";

                            $usuarios = Usuario::getUsuarios($nomUsuario); 

                            while($row=mysqli_fetch_array($usuarios)) {
                                
                                if ($nomUsuario == $row['user_login']) {

                                    $idUsuario = $row['idUsuario'];
                                    break;
                                }
                            }

                            require('../models/redSocial.php');
                                                           
                            if (RedSocial::agregarRedSocial($instagram,$linkedin,$facebook,$idUsuario) == true) {
                                echo "RS creada con exito.";

                                require('../models/categoria.php');
                                $categoriasBD = Categoria::buscarCategoria($categoria); 

                                while($row=mysqli_fetch_array($categoriasBD)) {
                                
                                    if ($categoria == $row['tipo']) {
    
                                        $idCategoria = $row['idCategoria'];
                                        break;
                                    }
                                }
             
                                require('../models/provincia.php');
                                $provincias = Provincia::buscarProvincia($provincia); 

                                while($row=mysqli_fetch_array($provincias)) {
                                
                                    if ($provincia == $row['provincia_name']) {
    
                                        $idProvincia = $row['idProvincia'];
                                        break;
                                    }
                                }
                    
                                require('../models/departamento.php');
                                $departamentos = Departamento::getDepartamentoProvincia($idProvincia,$departamento); 

                                while($row=mysqli_fetch_array($departamentos)) {
                                
                                    if ($departamento == $row['Departamento']) {
    
                                        $idDepartamento = $row['idDepartamento'];
                                        break;
                                    }
                                }

                                require('../models/servicio.php');

                                if (Servicio::agregarServiciosBasicos($descripción,$idCategoria,$idProvincia,$idDepartamento,$idUsuario,$emailContacto,$sitioWeb,$nombreServicio) == true) {
                                    echo "Servicio creado con exito.";

                                    $servicios = Servicio::getServiciosBasicos2($idUsuario); 

                                    while($row=mysqli_fetch_array($servicios)) {
                                
                                        if ($idUsuario == $row['FK_idUsuario']) {
        
                                            $idServicio = $row['idServicio'];
                                            break;
                                        }
                                    }

                                    require('../models/fotoServicio.php');                                  

                                    if ($Img0Ruta != "--") {
                                        
                                        if (FotoServicio::agregarFotoServicio($Img0Ruta,$idServicio) == true) {

                                            echo "Img0Ruta creada con exito.";

                                            if ($Img1Ruta != "--") {
                                        
                                                if (FotoServicio::agregarFotoServicio($Img1Ruta,$idServicio) == true) {
        
                                                    echo "Img1Ruta creada con exito.";

                                                }
                                            }
                                        }
                                    }

                                    require('../models/archivoServicio.php');    

                                    if ($pdfRuta != "--") {
                                        
                                        if (ArchivoServicio::agregarArchivoServicio($pdfRuta,$idServicio) == true) {

                                            echo "pdf creado con exito.";

                                        }
                                    }

                                    require('../models/tipoServicio.php');    

                                    if (TipoServicio::agregarTipoServicio($tipo,$idServicio) == true) {

                                        echo "tipo creado con exito.";

                                    }

                                    require('../models/tagsServicio.php');  

                                    if ($tags1 != "--") {
                                        
                                        if (TagsServicio::agregarTagsServicio($tags1,$idServicio) == true) {

                                            echo "tags1 creado con exito.";

                                        }
                                    }

                                    if ($tags2 != "--") {
                                        
                                        if (TagsServicio::agregarTagsServicio($tags2,$idServicio) == true) {

                                            echo "tags1 creado con exito.";

                                        }
                                    }

                                    if ($tags3 != "--") {
                                        
                                        if (TagsServicio::agregarTagsServicio($tags3,$idServicio) == true) {

                                            echo "tags1 creado con exito.";

                                        }
                                    }

                                    require('../models/horarioServicio.php');   

                                    if (!empty($_POST['gridRadios1Lunes'])) {
                                      
                                        if ((!empty($_POST['desde0Lunes'])) && (!empty($_POST['hasta0Lunes']))) {

                                            $desde0Lunes = $_POST['desde0Lunes'];
                                            $hasta0Lunes = $_POST['hasta0Lunes'];                                           
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Lunes,$hasta0Lunes,$idServicio,1)) {
    
                                                echo "desde-hasta0Lunes creado con exito.";
                                 
                                            }
                             
                                        } 

                                        if ((!empty($_POST['desde1Lunes'])) && (!empty($_POST['hasta1Lunes']))) {

                                            $desde1Lunes = $_POST['desde1Lunes'];
                                            $hasta1Lunes = $_POST['hasta1Lunes'];  
    
                                            if (HorarioServicio::agregarHorarioServicio($desde1Lunes,$hasta1Lunes,$idServicio,1)) {
    
                                                echo "desde-hasta1Lunes creado con exito.";
                                 
                                            }
                             
                                        } 

                                    }

                                    if (!empty($_POST['gridRadios2Lunes'])) {

                                        $desde0Lunes = 'Abierto todo el día';
                                        $hasta0Lunes = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Lunes,$hasta0Lunes,$idServicio,1)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }

                                    if (!empty($_POST['gridRadios3Lunes'])) {

                                        $desde0Lunes = 'Cerrado todo el día';
                                        $hasta0Lunes = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Lunes,$hasta0Lunes,$idServicio,1)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }

                                    if (!empty($_POST['gridRadios4Lunes'])) {

                                        $desde0Lunes = 'Solo con turnos';
                                        $hasta0Lunes = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Lunes,$hasta0Lunes,$idServicio,1)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }

                                    if (!empty($_POST['gridRadios1Martes'])) {

                                        if ((!empty($_POST['desde0Martes'])) && (!empty($_POST['hasta0Martes']))) {

                                            $desde0Martes = $_POST['desde0Martes'];
                                            $hasta0Martes = $_POST['hasta0Martes'];                                           
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Martes,$hasta0Martes,$idServicio,2)) {
    
                                                echo "desde-hasta0Martes creado con exito.";
                                 
                                            }
                             
                                        } 

                                        if ((!empty($_POST['desde1Martes'])) && (!empty($_POST['hasta1Martes']))) {

                                            $desde1Martes = $_POST['desde1Martes'];
                                            $hasta1Martes = $_POST['hasta1Martes'];  
    
                                            if (HorarioServicio::agregarHorarioServicio($desde1Martes,$hasta1Martes,$idServicio,2)) {
    
                                                echo "desde-hasta1Martes creado con exito.";
                                 
                                            }
                             
                                        } 

                                    }

                                    if (!empty($_POST['gridRadios2Martes'])) {

                                        $desde0Martes = 'Abierto todo el día';
                                        $hasta0Martes = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Martes,$hasta0Martes,$idServicio,2)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }

                                    if (!empty($_POST['gridRadios3Martes'])) {

                                        $desde0Martes = 'Cerrado todo el día';
                                        $hasta0Martes = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Martes,$hasta0Martes,$idServicio,2)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }

                                    if (!empty($_POST['gridRadios4Martes'])) {

                                        $desde0Martes = 'Solo con turnos';
                                        $hasta0Martes = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Martes,$hasta0Martes,$idServicio,2)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }

                                    if (!empty($_POST['gridRadios1Miercoles'])) {

                                        if ((!empty($_POST['desde0Miercoles'])) && (!empty($_POST['hasta0Miercoles']))) {

                                            $desde0Miercoles = $_POST['desde0Miercoles'];
                                            $hasta0Miercoles = $_POST['hasta0Miercoles'];                                           
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Miercoles,$hasta0Miercoles,$idServicio,3)) {
    
                                                echo "desde-hasta0Miercoles creado con exito.";
                                 
                                            }
                             
                                        } 

                                        if ((!empty($_POST['desde1Miercoles'])) && (!empty($_POST['hasta1Miercoles']))) {

                                            $desde1Miercoles = $_POST['desde1Miercoles'];
                                            $hasta1Miercoles = $_POST['hasta1Miercoles'];  
    
                                            if (HorarioServicio::agregarHorarioServicio($desde1Miercoles,$hasta1Miercoles,$idServicio,3)) {
    
                                                echo "desde-hasta1Miercoles creado con exito.";
                                 
                                            }
                             
                                        } 

                                    }

                                    if (!empty($_POST['gridRadios2Miercoles'])) {

                                        $desde0Miercoles = 'Abierto todo el día';
                                        $hasta0Miercoles = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Miercoles,$hasta0Miercoles,$idServicio,3)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }

                                    if (!empty($_POST['gridRadios3Miercoles'])) {

                                        $desde0Miercoles = 'Cerrado todo el día';
                                        $hasta0Miercoles = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Miercoles,$hasta0Miercoles,$idServicio,3)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }

                                    if (!empty($_POST['gridRadios4Miercoles'])) {

                                        $desde0Miercoles = 'Solo con turnos';
                                        $hasta0Miercoles = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Miercoles,$hasta0Miercoles,$idServicio,3)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }

                                    if (!empty($_POST['gridRadios1Jueves'])) {

                                        if ((!empty($_POST['desde0Jueves'])) && (!empty($_POST['hasta0Jueves']))) {

                                            $desde0Jueves = $_POST['desde0Jueves'];
                                            $hasta0Jueves = $_POST['hasta0Jueves'];                                           
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Jueves,$hasta0Jueves,$idServicio,4)) {
    
                                                echo "desde-hasta0Jueves creado con exito.";
                                 
                                            }
                             
                                        } 

                                        if ((!empty($_POST['desde1Jueves'])) && (!empty($_POST['hasta1Jueves']))) {

                                            $desde1Jueves = $_POST['desde1Jueves'];
                                            $hasta1Jueves = $_POST['hasta1Jueves'];  
    
                                            if (HorarioServicio::agregarHorarioServicio($desde1Jueves,$hasta1Jueves,$idServicio,4)) {
    
                                                echo "desde-hasta1Jueves creado con exito.";
                                 
                                            }
                             
                                        } 

                                    }

                                    if (!empty($_POST['gridRadios2Jueves'])) {

                                        $desde0Jueves = 'Abierto todo el día';
                                        $hasta0Jueves = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Jueves,$hasta0Jueves,$idServicio,4)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }

                                    if (!empty($_POST['gridRadios3Jueves'])) {

                                        $desde0Jueves = 'Cerrado todo el día';
                                        $hasta0Jueves = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Jueves,$hasta0Jueves,$idServicio,4)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }

                                    if (!empty($_POST['gridRadios4Jueves'])) {

                                        $desde0Jueves = 'Solo con turnos';
                                        $hasta0Jueves = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Jueves,$hasta0Jueves,$idServicio,4)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }

                                    if (!empty($_POST['gridRadios1Viernes'])) {

                                        if ((!empty($_POST['desde0Viernes'])) && (!empty($_POST['hasta0Viernes']))) {

                                            $desde0Viernes = $_POST['desde0Viernes'];
                                            $hasta0Viernes = $_POST['hasta0Viernes'];                                           
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Viernes,$hasta0Viernes,$idServicio,5)) {
    
                                                echo "desde-hasta0Viernes creado con exito.";
                                 
                                            }
                             
                                        } 

                                        if ((!empty($_POST['desde1Viernes'])) && (!empty($_POST['hasta1Viernes']))) {

                                            $desde1Viernes = $_POST['desde1Viernes'];
                                            $hasta1Viernes = $_POST['hasta1Viernes'];  
    
                                            if (HorarioServicio::agregarHorarioServicio($desde1Viernes,$hasta1Viernes,$idServicio,5)) {
    
                                                echo "desde-hasta1Viernes creado con exito.";
                                 
                                            }
                             
                                        } 

                                    }

                                    if (!empty($_POST['gridRadios2Viernes'])) {

                                        $desde0Viernes = 'Abierto todo el día';
                                        $hasta0Viernes = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Viernes,$hasta0Viernes,$idServicio,5)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }

                                    if (!empty($_POST['gridRadios3Viernes'])) {

                                        $desde0Viernes = 'Cerrado todo el día';
                                        $hasta0Viernes = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Viernes,$hasta0Viernes,$idServicio,5)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }

                                    if (!empty($_POST['gridRadios4Viernes'])) {

                                        $desde0Viernes = 'Solo con turnos';
                                        $hasta0Viernes = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Viernes,$hasta0Viernes,$idServicio,5)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }

                                    if (!empty($_POST['gridRadios1Sabado'])) {

                                        if ((!empty($_POST['desde0Sabado'])) && (!empty($_POST['hasta0Sabado']))) {

                                            $desde0Sabado = $_POST['desde0Sabado'];
                                            $hasta0Sabado = $_POST['hasta0Sabado'];                                           
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Sabado,$hasta0Sabado,$idServicio,6)) {
    
                                                echo "desde-hasta0Sabado creado con exito.";
                                 
                                            }
                             
                                        } 

                                        if ((!empty($_POST['desde1Sabado'])) && (!empty($_POST['hasta1Sabado']))) {

                                            $desde1Sabado = $_POST['desde1Sabado'];
                                            $hasta1Sabado = $_POST['hasta1Sabado'];  
    
                                            if (HorarioServicio::agregarHorarioServicio($desde1Sabado,$hasta1Sabado,$idServicio,6)) {
    
                                                echo "desde-hasta1Sabado creado con exito.";
                                 
                                            }
                             
                                        } 

                                    }

                                    if (!empty($_POST['gridRadios2Sabado'])) {

                                        $desde0Sabado = 'Abierto todo el día';
                                        $hasta0Sabado = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Sabado,$hasta0Sabado,$idServicio,6)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }

                                    if (!empty($_POST['gridRadios3Sabado'])) {

                                        $desde0Sabado = 'Cerrado todo el día';
                                        $hasta0Sabado = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Sabado,$hasta0Sabado,$idServicio,6)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }

                                    if (!empty($_POST['gridRadios4Sabado'])) {

                                        $desde0Sabado = 'Solo con turnos';
                                        $hasta0Sabado = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Sabado,$hasta0Sabado,$idServicio,6)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }
                                  
                                    if (!empty($_POST['gridRadios1Domingo'])) {

                                        if ((!empty($_POST['desde0Domingo'])) && (!empty($_POST['hasta0Domingo']))) {

                                            $desde0Domingo = $_POST['desde0Domingo'];
                                            $hasta0Domingo = $_POST['hasta0Domingo'];                                           
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Domingo,$hasta0Domingo,$idServicio,7)) {
    
                                                echo "desde-hasta0Domingo creado con exito.";
                                 
                                            }
                             
                                        } 

                                        if ((!empty($_POST['desde1Domingo'])) && (!empty($_POST['hasta1Domingo']))) {

                                            $desde1Domingo = $_POST['desde1Domingo'];
                                            $hasta1Domingo = $_POST['hasta1Domingo'];  
    
                                            if (HorarioServicio::agregarHorarioServicio($desde1Domingo,$hasta1Domingo,$idServicio,7)) {
    
                                                echo "desde-hasta1Domingo creado con exito.";
                                 
                                            }
                             
                                        } 

                                    }

                                    if (!empty($_POST['gridRadios2Domingo'])) {

                                        $desde0Domingo = 'Abierto todo el día';
                                        $hasta0Domingo = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Domingo,$hasta0Domingo,$idServicio,7)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }

                                    if (!empty($_POST['gridRadios3Domingo'])) {

                                        $desde0Domingo = 'Cerrado todo el día';
                                        $hasta0Domingo = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Domingo,$hasta0Domingo,$idServicio,7)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }

                                    if (!empty($_POST['gridRadios4Domingo'])) {

                                        $desde0Domingo = 'Solo con turnos';
                                        $hasta0Domingo = '--';

                                        if (HorarioServicio::agregarHorarioServicio($desde0Domingo,$hasta0Domingo,$idServicio,7)) {
    
                                            echo "Abierto todo el día creado con exito.";
                             
                                        }

                                    }

                                    header("Location: ../register-completo.php");
                                    
                                }
                            }
                        }

                    }
                                       
                } else {

                    header("Location: ../register.php");
                }
                            
            } else {

                header("Location: ../register.php");
            }
        
        }

    } else {

        header("Location: ../register.php");
    }
    
} else {

    if (!empty($_POST['gridRadios2'])) {

        if ((!empty($_POST['nombreEmpresa'])) && (!empty($_POST['descripción'])) && (!empty($_POST['email'])) && (!empty($_POST['nombreUsuario'])) && (!empty($_POST['newpassword'])) && (!empty($_POST['renewpassword'])) && (!empty($_FILES['imgLogo'])) && (!empty($_POST['telefono'])) && (!empty($_POST['categoria'])) && (!empty($_POST['provincia'])) && (!empty($_POST['departamento']))) {
        
            $nomUsuario = $_POST['nombreUsuario'];
            $email = $_POST['email'];
    
            require('../models/usuario.php');
            $usuarios = Usuario::getUsuarios($nomUsuario);        
            $bandera = false;
    
            while($row=mysqli_fetch_array($usuarios)) {
                
                if ($nomUsuario == $row['user_login']) {
    
                    $bandera = true;
                    header("Location: ../register.php");
                    
                }
                
            }
    
            $usuarios = Usuario::getUsuariosEmail($email);        
    
            while($row=mysqli_fetch_array($usuarios)) {
                
                if ($email == $row['user_email']) {
    
                    $bandera = true;
                    header("Location: ../register.php");
                    
                }
                
            }
    
            if ($bandera == false) {
    
                if ($_POST['newpassword'] == $_POST['renewpassword']) {
    
                    $nombre = $_POST['nombreEmpresa'];
    
                    if ((preg_match("/([0-9])/", $nombre)) == 0) {
                        
                        $nombreApellido = $nombre;
                        $telefono = $_POST['telefono'];
                        $descripción = $_POST['descripción'];
                        $password = sha1($_POST['newpassword']);
                        $carpeta = '../archivos/user_' .$nomUsuario;
    
                        if (!file_exists($carpeta)) {
                            
                            mkdir($carpeta, 0777, true);
    
                            try {
    
                                $imgLogo = $_FILES['imgLogo']['name'];
                                $imgBanner = $_FILES['imgBanner']['name'];
                                $Img0 = $_FILES['btnSubirImg0']['name'];
                                $Img1 = $_FILES['btnSubirImg1']['name'];
                                $pdf = $_FILES['pdf']['name'];
                
                            } catch (Exception $e) {
                
                                echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                
                            }
                
                            if (isset($imgLogo) && $imgLogo != "") {
                
                                $tipo = $_FILES['imgLogo']['type'];
                                $tamano = $_FILES['imgLogo']['size'];
                                $temp = $_FILES['imgLogo']['tmp_name'];
                                
                                if (!((strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 3048576))) {
                                    echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                                    - Se permiten archivos .jpg, .png. y de 1MB como máximo.</b></div>';
                                }
                                else {
    
                                    $imgLogoRuta = $carpeta .'/' .$imgLogo;
                                
                                    if (move_uploaded_file($temp, $imgLogoRuta)) {
                                    
                                        chmod($imgLogoRuta, 0777);
                                        $imgLogoRuta = 'archivos/user_' .$nomUsuario .'/' .$imgLogo;
                                        echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                                    }
                                    else {
                                    
                                        echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                                    }
                                }
    
                            } else {
    
                                $imgLogoRuta = 'assets/img/logos/negroFondoAmarillo.png';
                            }
                
                            if (isset($imgBanner) && $imgBanner != "") {
                
                                $tipo = $_FILES['imgBanner']['type'];
                                $tamano = $_FILES['imgBanner']['size'];
                                $temp = $_FILES['imgBanner']['tmp_name'];
                                
                                if (!((strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 3048576))) {
                                    echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                                    - Se permiten archivos .jpg, .png. y de 2MB como máximo.</b></div>';
                                }
                                else {
    
                                    $imgBannerRuta = $carpeta .'/' .$imgBanner;
                                
                                    if (move_uploaded_file($temp, $imgBannerRuta)) {
                                    
                                        chmod($imgBannerRuta, 0777);
                                        $imgBannerRuta = 'archivos/user_' .$nomUsuario .'/' .$imgBanner;
                                        echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                                    }
                                    else {
                                    
                                        echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                                    }
                                }
                                
                            } else {
    
                                $imgBannerRuta = 'assets/img/hero-bg-abstract.jpg';
                            }
                
                            if (isset($Img0) && $Img0 != "") {
                
                                $tipo = $_FILES['btnSubirImg0']['type'];
                                $tamano = $_FILES['btnSubirImg0']['size'];
                                $temp = $_FILES['btnSubirImg0']['tmp_name'];
                                
                                if (!((strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 3048576))) {
                                    echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                                    - Se permiten archivos .jpg, .png. y de 1MB como máximo.</b></div>';
                                }
                                else {
                                
                                    $Img0Ruta = $carpeta .'/' .$Img0;
    
                                    if (move_uploaded_file($temp, $Img0Ruta)) {
                                    
                                        chmod($Img0Ruta, 0777);
                                        $Img0Ruta = 'archivos/user_' .$nomUsuario .'/' .$Img0;
                                        echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                
                                    }
                                    else {
                                    
                                        echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                                    }
                                }
    
                            } else {
    
                                $Img0Ruta = "--";
                            }
                
                            if (isset($Img1) && $Img1 != "") {
                
                                $tipo = $_FILES['btnSubirImg1']['type'];
                                $tamano = $_FILES['btnSubirImg1']['size'];
                                $temp = $_FILES['btnSubirImg1']['tmp_name'];
                                
                                if (!((strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 3048576))) {
                                    echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                                    - Se permiten archivos .jpg, .png. y de 1MB como máximo.</b></div>';
                                }
                                else {
    
                                    $Img1Ruta = $carpeta .'/' .$Img1;
                                
                                    if (move_uploaded_file($temp, $Img1Ruta)) {
                                    
                                        chmod($Img1Ruta, 0777);
                                        $Img1Ruta = 'archivos/user_' .$nomUsuario .'/' .$Img1;
                                        echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                                    }
                                    else {
                                    
                                        echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                                    }
                                }
    
                            } else {
    
                                $Img1Ruta = "--";
                            }
                
                            if (isset($pdf) && $pdf != "") {
                
                                $tipo = $_FILES['pdf']['type'];
                                $tamano = $_FILES['pdf']['size'];
                                $temp = $_FILES['pdf']['tmp_name'];
                                
                                if (!((strpos($tipo, "pdf")) && ($tamano < 3048576))) {
                                    echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                                    - Se permiten archivos .jpg, .png. y de 1MB como máximo.</b></div>';
                                }
                                else {
    
                                    $pdfRuta = $carpeta .'/' .$pdf;
                                
                                    if (move_uploaded_file($temp, $pdfRuta)) {
                                    
                                        chmod($pdfRuta, 0777);
                                        $pdfRuta = 'archivos/user_' .$nomUsuario .'/' .$pdf;
                                        echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                                    }
                                    else {
                                    
                                        echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                                    }
                                }
    
                            } else {
    
                                $pdfRuta = "--";
                            }
                            
                        }
                        
                        if (!empty($_POST['emailContacto'])) {
    
                            $emailContacto = $_POST['emailContacto'];
    
                        } else {
    
                            $emailContacto = $email;
                        }
    
                        if ((preg_match("/[1-6]{3}[0-9]{3}[0-9]{4}/", $telefono)) == 0) {
                            header("Location: ../register.php");
                        } 
    
                        if (!empty($_POST['sitioWeb'])) {
    
                            $sitioWeb = $_POST['sitioWeb'];
    
                        } else {
    
                            $sitioWeb = "--";
    
                        }
    
                        if (!empty($_POST['facebook'])) {
    
                            $facebook = $_POST['facebook'];
    
                        } else {
    
                            $facebook = "--";
                            
                        }
    
                        if (!empty($_POST['instagram'])) {
    
                            $instagram = $_POST['instagram'];
    
                        } else {
    
                            $instagram = "--";
                            
                        }
    
                        if (!empty($_POST['linkedin'])) {
    
                            $linkedin = $_POST['linkedin'];
    
                        } else {
    
                            $linkedin = "--";
                            
                        }
                                         
                        if ($_POST['categoria'] == "Abre este menú de selección") {
    
                            header("Location: ../register.php");
                            
                        } else {
    
                            $categoria = $_POST['categoria'];
    
                            if (!empty($_POST['nombreServicio'])) {
    
                                $nombreServicio = $_POST['nombreServicio'];
    
                            } else {
    
                                $nombreServicio = $categoria;
                            }
    
                        }
    
                        if (!empty($_POST['tags1'])) {
    
                            $tags1 = "Acepta Mercado Pago";
    
                        } else {
    
                            $tags1 = "--";
    
                        }
    
                        if (!empty($_POST['tags2'])) {
    
                            $tags2 = "Acepta Tarjetas de Crédito";
             
                        } else {
    
                            $tags2 = "--";
    
                        }
    
                        if (!empty($_POST['tags3'])) {
    
                            $tags3 = "Acepta Tarjetas de Débito";
    
                        } else {
    
                            $tags3 = "--";
    
                        }
    
                        if ($_POST['tipo'] == "Abre este menú de selección") {
    
                            header("Location: ../register.php");
    
                        } else {
    
                            $tipo = $_POST['tipo'];
    
                        }                    
                        
                        if ($_POST['provincia'] == "Abre este menú de selección") {
    
                            header("Location: ../register.php");
    
                        } else {
    
                            $provincia = $_POST['provincia'];
    
                        }
    
                        if ($_POST['departamento'] == "Abre este menú de selección") {
    
                            header("Location: ../register.php");
    
                        } else {
    
                            $departamento = $_POST['departamento'];
    
                        }
    
                        if ((isset($nombreApellido) && $nombreApellido != "") && (isset($nombreServicio) && $nombreServicio != "") && (isset($descripción) && $descripción != "") && (isset($email) && $email != "") && (isset($nomUsuario) && $nomUsuario != "") && (isset($password) && $password != "") && (isset($imgLogoRuta) && $imgLogoRuta != "") && (isset($imgBannerRuta) && $imgBannerRuta != "") && (isset($Img0Ruta) && $Img0Ruta != "") && (isset($Img1Ruta) && $Img1Ruta != "") && (isset($pdfRuta) && $pdfRuta != "") && (isset($emailContacto) && $emailContacto != "") && (isset($telefono) && $telefono != "") && (isset($sitioWeb) && $sitioWeb != "") && (isset($facebook) && $facebook != "") && (isset($instagram) && $instagram != "") && (isset($linkedin) && $linkedin != "") && (isset($categoria) && $categoria != "") && (isset($tags1) && $tags1 != "") && (isset($tags2) && $tags2 != "") && (isset($tags3) && $tags3 != "") && (isset($tipo) && $tipo != "") && (isset($provincia) && $provincia != "") && (isset($departamento) && $departamento != "")) {
                             
                            if (Usuario::agregarUsuarios($nomUsuario,$password,$email,$imgLogoRuta,$imgBannerRuta,$telefono,$nombreApellido) == true) {
                                echo "Usuario creado con exito.";
    
                                $usuarios = Usuario::getUsuarios($nomUsuario); 
    
                                while($row=mysqli_fetch_array($usuarios)) {
                                    
                                    if ($nomUsuario == $row['user_login']) {
    
                                        $idUsuario = $row['idUsuario'];
                                        break;
                                    }
                                }
    
                                require('../models/redSocial.php');
                                                               
                                if (RedSocial::agregarRedSocial($instagram,$linkedin,$facebook,$idUsuario) == true) {
                                    echo "RS creada con exito.";
    
                                    require('../models/categoria.php');
                                    $categoriasBD = Categoria::buscarCategoria($categoria); 
    
                                    while($row=mysqli_fetch_array($categoriasBD)) {
                                    
                                        if ($categoria == $row['tipo']) {
        
                                            $idCategoria = $row['idCategoria'];
                                            break;
                                        }
                                    }
                 
                                    require('../models/provincia.php');
                                    $provincias = Provincia::buscarProvincia($provincia); 
    
                                    while($row=mysqli_fetch_array($provincias)) {
                                    
                                        if ($provincia == $row['provincia_name']) {
        
                                            $idProvincia = $row['idProvincia'];
                                            break;
                                        }
                                    }
                        
                                    require('../models/departamento.php');
                                    $departamentos = Departamento::getDepartamentoProvincia($idProvincia,$departamento); 
    
                                    while($row=mysqli_fetch_array($departamentos)) {
                                    
                                        if ($departamento == $row['Departamento']) {
        
                                            $idDepartamento = $row['idDepartamento'];
                                            break;
                                        }
                                    }
    
                                    require('../models/servicio.php');
    
                                    if (Servicio::agregarServiciosBasicos($descripción,$idCategoria,$idProvincia,$idDepartamento,$idUsuario,$emailContacto,$sitioWeb,$nombreServicio) == true) {
                                        echo "Servicio creado con exito.";
    
                                        $servicios = Servicio::getServiciosBasicos2($idUsuario); 
    
                                        while($row=mysqli_fetch_array($servicios)) {
                                    
                                            if ($idUsuario == $row['FK_idUsuario']) {
            
                                                $idServicio = $row['idServicio'];
                                                break;
                                            }
                                        }
    
                                        require('../models/fotoServicio.php');                                  
    
                                        if ($Img0Ruta != "--") {
                                            
                                            if (FotoServicio::agregarFotoServicio($Img0Ruta,$idServicio) == true) {
    
                                                echo "Img0Ruta creada con exito.";
    
                                                if ($Img1Ruta != "--") {
                                            
                                                    if (FotoServicio::agregarFotoServicio($Img1Ruta,$idServicio) == true) {
            
                                                        echo "Img1Ruta creada con exito.";
    
                                                    }
                                                }
                                            }
                                        }
    
                                        require('../models/archivoServicio.php');    
    
                                        if ($pdfRuta != "--") {
                                            
                                            if (ArchivoServicio::agregarArchivoServicio($pdfRuta,$idServicio) == true) {
    
                                                echo "pdf creado con exito.";
    
                                            }
                                        }
    
                                        require('../models/tipoServicio.php');    
    
                                        if (TipoServicio::agregarTipoServicio($tipo,$idServicio) == true) {
    
                                            echo "tipo creado con exito.";
    
                                        }
    
                                        require('../models/tagsServicio.php');  
    
                                        if ($tags1 != "--") {
                                            
                                            if (TagsServicio::agregarTagsServicio($tags1,$idServicio) == true) {
    
                                                echo "tags1 creado con exito.";
    
                                            }
                                        }
    
                                        if ($tags2 != "--") {
                                            
                                            if (TagsServicio::agregarTagsServicio($tags2,$idServicio) == true) {
    
                                                echo "tags1 creado con exito.";
    
                                            }
                                        }
    
                                        if ($tags3 != "--") {
                                            
                                            if (TagsServicio::agregarTagsServicio($tags3,$idServicio) == true) {
    
                                                echo "tags1 creado con exito.";
    
                                            }
                                        }
    
                                        require('../models/horarioServicio.php');   
    
                                        if (!empty($_POST['gridRadios1Lunes'])) {
                                          
                                            if ((!empty($_POST['desde0Lunes'])) && (!empty($_POST['hasta0Lunes']))) {
    
                                                $desde0Lunes = $_POST['desde0Lunes'];
                                                $hasta0Lunes = $_POST['hasta0Lunes'];                                           
        
                                                if (HorarioServicio::agregarHorarioServicio($desde0Lunes,$hasta0Lunes,$idServicio,1)) {
        
                                                    echo "desde-hasta0Lunes creado con exito.";
                                     
                                                }
                                 
                                            } 
    
                                            if ((!empty($_POST['desde1Lunes'])) && (!empty($_POST['hasta1Lunes']))) {
    
                                                $desde1Lunes = $_POST['desde1Lunes'];
                                                $hasta1Lunes = $_POST['hasta1Lunes'];  
        
                                                if (HorarioServicio::agregarHorarioServicio($desde1Lunes,$hasta1Lunes,$idServicio,1)) {
        
                                                    echo "desde-hasta1Lunes creado con exito.";
                                     
                                                }
                                 
                                            } 
    
                                        }
    
                                        if (!empty($_POST['gridRadios2Lunes'])) {
    
                                            $desde0Lunes = 'Abierto todo el día';
                                            $hasta0Lunes = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Lunes,$hasta0Lunes,$idServicio,1)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
    
                                        if (!empty($_POST['gridRadios3Lunes'])) {
    
                                            $desde0Lunes = 'Cerrado todo el día';
                                            $hasta0Lunes = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Lunes,$hasta0Lunes,$idServicio,1)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
    
                                        if (!empty($_POST['gridRadios4Lunes'])) {
    
                                            $desde0Lunes = 'Solo con turnos';
                                            $hasta0Lunes = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Lunes,$hasta0Lunes,$idServicio,1)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
    
                                        if (!empty($_POST['gridRadios1Martes'])) {
    
                                            if ((!empty($_POST['desde0Martes'])) && (!empty($_POST['hasta0Martes']))) {
    
                                                $desde0Martes = $_POST['desde0Martes'];
                                                $hasta0Martes = $_POST['hasta0Martes'];                                           
        
                                                if (HorarioServicio::agregarHorarioServicio($desde0Martes,$hasta0Martes,$idServicio,2)) {
        
                                                    echo "desde-hasta0Martes creado con exito.";
                                     
                                                }
                                 
                                            } 
    
                                            if ((!empty($_POST['desde1Martes'])) && (!empty($_POST['hasta1Martes']))) {
    
                                                $desde1Martes = $_POST['desde1Martes'];
                                                $hasta1Martes = $_POST['hasta1Martes'];  
        
                                                if (HorarioServicio::agregarHorarioServicio($desde1Martes,$hasta1Martes,$idServicio,2)) {
        
                                                    echo "desde-hasta1Martes creado con exito.";
                                     
                                                }
                                 
                                            } 
    
                                        }
    
                                        if (!empty($_POST['gridRadios2Martes'])) {
    
                                            $desde0Martes = 'Abierto todo el día';
                                            $hasta0Martes = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Martes,$hasta0Martes,$idServicio,2)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
    
                                        if (!empty($_POST['gridRadios3Martes'])) {
    
                                            $desde0Martes = 'Cerrado todo el día';
                                            $hasta0Martes = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Martes,$hasta0Martes,$idServicio,2)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
    
                                        if (!empty($_POST['gridRadios4Martes'])) {
    
                                            $desde0Martes = 'Solo con turnos';
                                            $hasta0Martes = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Martes,$hasta0Martes,$idServicio,2)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
    
                                        if (!empty($_POST['gridRadios1Miercoles'])) {
    
                                            if ((!empty($_POST['desde0Miercoles'])) && (!empty($_POST['hasta0Miercoles']))) {
    
                                                $desde0Miercoles = $_POST['desde0Miercoles'];
                                                $hasta0Miercoles = $_POST['hasta0Miercoles'];                                           
        
                                                if (HorarioServicio::agregarHorarioServicio($desde0Miercoles,$hasta0Miercoles,$idServicio,3)) {
        
                                                    echo "desde-hasta0Miercoles creado con exito.";
                                     
                                                }
                                 
                                            } 
    
                                            if ((!empty($_POST['desde1Miercoles'])) && (!empty($_POST['hasta1Miercoles']))) {
    
                                                $desde1Miercoles = $_POST['desde1Miercoles'];
                                                $hasta1Miercoles = $_POST['hasta1Miercoles'];  
        
                                                if (HorarioServicio::agregarHorarioServicio($desde1Miercoles,$hasta1Miercoles,$idServicio,3)) {
        
                                                    echo "desde-hasta1Miercoles creado con exito.";
                                     
                                                }
                                 
                                            } 
    
                                        }
    
                                        if (!empty($_POST['gridRadios2Miercoles'])) {
    
                                            $desde0Miercoles = 'Abierto todo el día';
                                            $hasta0Miercoles = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Miercoles,$hasta0Miercoles,$idServicio,3)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
    
                                        if (!empty($_POST['gridRadios3Miercoles'])) {
    
                                            $desde0Miercoles = 'Cerrado todo el día';
                                            $hasta0Miercoles = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Miercoles,$hasta0Miercoles,$idServicio,3)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
    
                                        if (!empty($_POST['gridRadios4Miercoles'])) {
    
                                            $desde0Miercoles = 'Solo con turnos';
                                            $hasta0Miercoles = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Miercoles,$hasta0Miercoles,$idServicio,3)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
    
                                        if (!empty($_POST['gridRadios1Jueves'])) {
    
                                            if ((!empty($_POST['desde0Jueves'])) && (!empty($_POST['hasta0Jueves']))) {
    
                                                $desde0Jueves = $_POST['desde0Jueves'];
                                                $hasta0Jueves = $_POST['hasta0Jueves'];                                           
        
                                                if (HorarioServicio::agregarHorarioServicio($desde0Jueves,$hasta0Jueves,$idServicio,4)) {
        
                                                    echo "desde-hasta0Jueves creado con exito.";
                                     
                                                }
                                 
                                            } 
    
                                            if ((!empty($_POST['desde1Jueves'])) && (!empty($_POST['hasta1Jueves']))) {
    
                                                $desde1Jueves = $_POST['desde1Jueves'];
                                                $hasta1Jueves = $_POST['hasta1Jueves'];  
        
                                                if (HorarioServicio::agregarHorarioServicio($desde1Jueves,$hasta1Jueves,$idServicio,4)) {
        
                                                    echo "desde-hasta1Jueves creado con exito.";
                                     
                                                }
                                 
                                            } 
    
                                        }
    
                                        if (!empty($_POST['gridRadios2Jueves'])) {
    
                                            $desde0Jueves = 'Abierto todo el día';
                                            $hasta0Jueves = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Jueves,$hasta0Jueves,$idServicio,4)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
    
                                        if (!empty($_POST['gridRadios3Jueves'])) {
    
                                            $desde0Jueves = 'Cerrado todo el día';
                                            $hasta0Jueves = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Jueves,$hasta0Jueves,$idServicio,4)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
    
                                        if (!empty($_POST['gridRadios4Jueves'])) {
    
                                            $desde0Jueves = 'Solo con turnos';
                                            $hasta0Jueves = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Jueves,$hasta0Jueves,$idServicio,4)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
    
                                        if (!empty($_POST['gridRadios1Viernes'])) {
    
                                            if ((!empty($_POST['desde0Viernes'])) && (!empty($_POST['hasta0Viernes']))) {
    
                                                $desde0Viernes = $_POST['desde0Viernes'];
                                                $hasta0Viernes = $_POST['hasta0Viernes'];                                           
        
                                                if (HorarioServicio::agregarHorarioServicio($desde0Viernes,$hasta0Viernes,$idServicio,5)) {
        
                                                    echo "desde-hasta0Viernes creado con exito.";
                                     
                                                }
                                 
                                            } 
    
                                            if ((!empty($_POST['desde1Viernes'])) && (!empty($_POST['hasta1Viernes']))) {
    
                                                $desde1Viernes = $_POST['desde1Viernes'];
                                                $hasta1Viernes = $_POST['hasta1Viernes'];  
        
                                                if (HorarioServicio::agregarHorarioServicio($desde1Viernes,$hasta1Viernes,$idServicio,5)) {
        
                                                    echo "desde-hasta1Viernes creado con exito.";
                                     
                                                }
                                 
                                            } 
    
                                        }
    
                                        if (!empty($_POST['gridRadios2Viernes'])) {
    
                                            $desde0Viernes = 'Abierto todo el día';
                                            $hasta0Viernes = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Viernes,$hasta0Viernes,$idServicio,5)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
    
                                        if (!empty($_POST['gridRadios3Viernes'])) {
    
                                            $desde0Viernes = 'Cerrado todo el día';
                                            $hasta0Viernes = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Viernes,$hasta0Viernes,$idServicio,5)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
    
                                        if (!empty($_POST['gridRadios4Viernes'])) {
    
                                            $desde0Viernes = 'Solo con turnos';
                                            $hasta0Viernes = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Viernes,$hasta0Viernes,$idServicio,5)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
    
                                        if (!empty($_POST['gridRadios1Sabado'])) {
    
                                            if ((!empty($_POST['desde0Sabado'])) && (!empty($_POST['hasta0Sabado']))) {
    
                                                $desde0Sabado = $_POST['desde0Sabado'];
                                                $hasta0Sabado = $_POST['hasta0Sabado'];                                           
        
                                                if (HorarioServicio::agregarHorarioServicio($desde0Sabado,$hasta0Sabado,$idServicio,6)) {
        
                                                    echo "desde-hasta0Sabado creado con exito.";
                                     
                                                }
                                 
                                            } 
    
                                            if ((!empty($_POST['desde1Sabado'])) && (!empty($_POST['hasta1Sabado']))) {
    
                                                $desde1Sabado = $_POST['desde1Sabado'];
                                                $hasta1Sabado = $_POST['hasta1Sabado'];  
        
                                                if (HorarioServicio::agregarHorarioServicio($desde1Sabado,$hasta1Sabado,$idServicio,6)) {
        
                                                    echo "desde-hasta1Sabado creado con exito.";
                                     
                                                }
                                 
                                            } 
    
                                        }
    
                                        if (!empty($_POST['gridRadios2Sabado'])) {
    
                                            $desde0Sabado = 'Abierto todo el día';
                                            $hasta0Sabado = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Sabado,$hasta0Sabado,$idServicio,6)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
    
                                        if (!empty($_POST['gridRadios3Sabado'])) {
    
                                            $desde0Sabado = 'Cerrado todo el día';
                                            $hasta0Sabado = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Sabado,$hasta0Sabado,$idServicio,6)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
    
                                        if (!empty($_POST['gridRadios4Sabado'])) {
    
                                            $desde0Sabado = 'Solo con turnos';
                                            $hasta0Sabado = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Sabado,$hasta0Sabado,$idServicio,6)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
                                      
                                        if (!empty($_POST['gridRadios1Domingo'])) {
    
                                            if ((!empty($_POST['desde0Domingo'])) && (!empty($_POST['hasta0Domingo']))) {
    
                                                $desde0Domingo = $_POST['desde0Domingo'];
                                                $hasta0Domingo = $_POST['hasta0Domingo'];                                           
        
                                                if (HorarioServicio::agregarHorarioServicio($desde0Domingo,$hasta0Domingo,$idServicio,7)) {
        
                                                    echo "desde-hasta0Domingo creado con exito.";
                                     
                                                }
                                 
                                            } 
    
                                            if ((!empty($_POST['desde1Domingo'])) && (!empty($_POST['hasta1Domingo']))) {
    
                                                $desde1Domingo = $_POST['desde1Domingo'];
                                                $hasta1Domingo = $_POST['hasta1Domingo'];  
        
                                                if (HorarioServicio::agregarHorarioServicio($desde1Domingo,$hasta1Domingo,$idServicio,7)) {
        
                                                    echo "desde-hasta1Domingo creado con exito.";
                                     
                                                }
                                 
                                            } 
    
                                        }
    
                                        if (!empty($_POST['gridRadios2Domingo'])) {
    
                                            $desde0Domingo = 'Abierto todo el día';
                                            $hasta0Domingo = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Domingo,$hasta0Domingo,$idServicio,7)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
    
                                        if (!empty($_POST['gridRadios3Domingo'])) {
    
                                            $desde0Domingo = 'Cerrado todo el día';
                                            $hasta0Domingo = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Domingo,$hasta0Domingo,$idServicio,7)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
    
                                        if (!empty($_POST['gridRadios4Domingo'])) {
    
                                            $desde0Domingo = 'Solo con turnos';
                                            $hasta0Domingo = '--';
    
                                            if (HorarioServicio::agregarHorarioServicio($desde0Domingo,$hasta0Domingo,$idServicio,7)) {
        
                                                echo "Abierto todo el día creado con exito.";
                                 
                                            }
    
                                        }
    
                                        header("Location: ../register-completo.php");
                                        
                                    }
                                }
                            }
    
                        }
                                           
                    } else {
    
                        header("Location: ../register.php");
                    }
                                
                } else {
    
                    header("Location: ../register.php");
                }
            
            }
    
        } else {
    
            header("Location: ../register.php");
        }
    
    }
}

?>