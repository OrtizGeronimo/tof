<?php
// Incluir el archivo de logging
include 'logConfig.php';
$paths = [
    './config/conexion.php',
    './../config/conexion.php',
    '../../config/conexion.php',
];

foreach ($paths as $path) {
    if (file_exists($path)) {
        require_once $path;
        break;
    }
}

class Servicio{
    public static function getServiciosBasicos(){
        $serviciosBasicos = BaseDeDatos::consulta("SELECT *
                                                    FROM servicio s,provincia p,departamento d, usuario u,rol r
                                                    WHERE p.idProvincia = s.FK_idProvincia
                                                    AND d.idDepartamento = s.FK_idDepartamento
                                                    AND u.idUsuario = s.FK_idUsuario
                                                    AND u.FK_idRol  = r.idRol
                                                    AND s.fec_baja IS NULL
                                                    AND   r.rol       = 'basico'");
        return $serviciosBasicos;                                                  
    }

    public static function getServiciosPro(){
        $serviciosPro = BaseDeDatos::consulta("SELECT *
                                                FROM servicio s,provincia p,departamento d, usuario u,rol r
                                                WHERE p.idProvincia = s.FK_idProvincia
                                                AND d.idDepartamento = s.FK_idDepartamento
                                                AND u.idUsuario = s.FK_idUsuario
                                                AND u.FK_idRol  = r.idRol
                                                AND s.fec_baja IS NULL
                                                AND   r.rol 
                                                = 'pro'");
        return $serviciosPro;                                                  
    }

    public static function getAllServicios(){
        $servicio = BaseDeDatos::consulta("SELECT idServicio,
                                                  servicio_nombre,
                                                  servicio_descripcion,
                                                  provincia_name,
                                                  departamento,
                                                  user_nombre,
                                                  user_login,
                                                  s.fec_alta,
                                                  s.servicio_imagen,
                                                  r.rol
                                           FROM servicio s,provincia p,departamento d, usuario u,rol r
                                            WHERE p.idProvincia = s.FK_idProvincia
                                            AND d.idDepartamento = s.FK_idDepartamento
                                            AND u.idUsuario = s.FK_idUsuario
                                            AND u.FK_idRol  = r.idRol
                                            AND s.fec_baja IS NULL
                                            ORDER BY 
                                                CASE r.rol
                                                WHEN r.rol = 'pro'    THEN 'pro'
                                                WHEN r.rol = 'basico' THEN 'basico'
                                            END");

        return $servicio;
    }

    public static function getAllServiciosPaginado($inicio,$cant,$filtro = null){
        
        $categoria = "";
        $provincia = "";
        $tags      = "";
        
        $categoria = (isset($filtro["categorias"]) && $filtro["categorias"]!="")?"AND cs.FK_idCategoria IN (SELECT idCategoria FROM categoria WHERE tipo IN (".implode(",",$filtro["categorias"])."))" : '';
        $provincia = (isset($filtro["provincias"]) && $filtro["provincias"]!="")?"AND p.provincia_name IN (".implode(",",$filtro["provincias"]).")" : '';
        $tags      = (isset($filtro["tags"]) && $filtro["tags"]!="")?"AND t.tags IN (".implode(",",$filtro["tags"]).")" : '';
        
        $query = "SELECT 
                        s.*, 
                        u.*, 
                        r.*, 
                        p.*
                    FROM servicio  s
                    INNER JOIN	usuario u ON s.FK_idUsuario = u.idUsuario
                    INNER JOIN	rol r ON u.FK_idRol  = r.idRol
                    INNER JOIN	provincia p ON s.FK_idProvincia = p.idProvincia  
                    LEFT JOIN categoria_servicio cs ON s.idServicio = cs.FK_idServicio
                    WHERE s.fec_baja IS NULL
                        AND cs.fec_baja IS NULL
                        ".$categoria."
                        ".$provincia."
                    GROUP BY s.idServicio, u.idUsuario
                    ORDER BY CASE 
                        WHEN rol = 'pro'    THEN 1
                        WHEN rol = 'basico' THEN 2
                        WHEN rol = 'gratis' THEN 3
                        ELSE 4
                    END ASC
                    LIMIT $inicio,$cant";
        //writeLog($query);       
        $servicio = BaseDeDatos::consulta($query);

        return $servicio;
    }

    public static function getLastServicio(){
        return BaseDeDatos::consulta("SELECT *
                                      FROM servicio
                                      WHERE idServicio IN (SELECT MAX(idServicio) 
                                                           FROM servicio);");
    }

    public static function addServicio($nombre,$descripción,$email,$telefono,$siteweb,$imgServicio,$bannerServicio,$idProvincia,$idDepartamento,$idUsuario,$usuarioAlta){
        return BaseDeDatos::consulta("INSERT INTO servicio  (servicio_nombre,servicio_descripcion,servicio_email,servicio_telefono,servicio_web,servicio_imagen,servicio_banner,FK_idProvincia,FK_idDepartamento,FK_idUsuario,usr_alta,fec_alta) 
                                      VALUES ('$nombre','$descripción','$email','$telefono','$siteweb','$imgServicio','$bannerServicio',$idProvincia,$idDepartamento,$idUsuario,'$usuarioAlta',now());");
    }

    public static function addHorariosServicios($hora_desde,$hora_hasta = "--",$idServicio,$dia,$usuarioAlta){
        return BaseDeDatos::consulta("INSERT INTO servicio_horario (servicio_tipo_hora_desde,servicio_tipo_hora_hasta,FK_idServicio,FK_idDias,usr_alta,fec_alta)
                                      VALUES ('$hora_desde','$hora_hasta',$idServicio,(SELECT  idDias FROM servicio_dias
                                                                                        WHERE upper(dia) = upper('$dia')),'$usuarioAlta',now());");
    }

    public static function addCategoria($idServicio,$idCategoria,$usuarioAlta){
        return BaseDeDatos::consulta("INSERT INTO categoria_servicio (FK_idServicio,FK_idCategoria,usr_alta,fec_alta)
                                      VALUE ($idServicio,$idCategoria,'$usuarioAlta',now());");
    }

    public static function updateGenericImg($imagen, $idServicio){
        return BaseDeDatos::consulta("UPDATE servicio
                                      SET servicio_imagen = '$imagen'
                                      WHERE idServicio = $idServicio;");
    }

    public static function addRedesSociales($instagram,$linkedin,$facebook,$idServicio,$usuarioAlta){
        return BaseDeDatos::consulta("INSERT INTO red_social (redSocial_Instagram,redSocial_LinkedIn,redSocial_Facebook,FK_idServicio,usr_alta,fec_alta)
                                      VALUES ('$instagram','$linkedin','$facebook',$idServicio,'$usuarioAlta',now());");
    }

    public static function addTipoServicios($tipo,$idServicio,$usuarioAlta){
        return BaseDeDatos::consulta("INSERT INTO servicio_tipo (tipo,FK_idServicio,usr_alta,fec_alta) 
                                      VALUES ('$tipo',$idServicio,'$usuarioAlta',now());");
    }
    
    
    public static function countServicios(){
        return BaseDeDatos::consulta("SELECT COUNT(*) AS CANTIDAD
                                      FROM servicio
                                      WHERE fec_baja IS NULL;");
    }


    public static function getServicio($idServicio){
        return BaseDeDatos::consulta("SELECT * 
                                      FROM usuario    u
                                      INNER JOIN servicio   s
                                      ON u.idUsuario = s.FK_idUsuario
                                      LEFT JOIN red_social rs
                                      ON s.idServicio= rs.FK_idServicio
                                      WHERE   s.idServicio =  $idServicio");
    }

    public static function getServicioByUserId($idUser){
        return BaseDeDatos::consulta("SELECT * 
                                      FROM usuario    u
                                      INNER JOIN servicio   s
                                      ON u.idUsuario = s.FK_idUsuario
                                      LEFT JOIN red_social rs
                                      ON s.idServicio= rs.FK_idServicio
                                      WHERE   u.idUsuario =  $idUser");
    }

    public static function getServicioByUsuarioId($idUsuario){
        return BaseDeDatos::consulta("SELECT * 
                                      FROM servicio  s
                                      WHERE   s.FK_idUsuario =  $idUsuario");
    }

    public static function getHorariosServicio($idServicio){
        return BaseDeDatos::consulta("SELECT sh.idServicio_horario,
                                             d.dia,
                                             sh.servicio_tipo_hora_desde AS hora_desde,
                                             sh.servicio_tipo_hora_hasta AS hora_hasta
                                      FROM  servicio s,
                                            servicio_horario sh,
                                            servicio_dias d
                                      WHERE sh.FK_idDias = d.idDias
                                      AND s.idServicio = sh.FK_idServicio
                                      AND s.idServicio = $idServicio");
    }

    public static function getCategoriasServicio($idServicio){
        return BaseDeDatos::consulta("SELECT DISTINCT c.idCategoria,c.tipo
                                        FROM servicio s,categoria_servicio cs,categoria c
                                        WHERE s.idServicio = cs.FK_idServicio
                                        AND c.idCategoria = cs.FK_idCategoria
                                        AND cs.fec_baja IS NULL
                                        AND s.fec_baja IS NULL
                                        AND c.fec_baja IS NULL
                                        AND s.idServicio = $idServicio;");
    }

    public static function getTipoServicio($idServicio){
        return BaseDeDatos::consulta("SELECT st.*
                                      FROM servicio s, servicio_tipo st 
                                      WHERE s.idServicio = st.FK_idServicio
                                      AND s.idServicio = $idServicio");
    }

    public static function updateServicio($idServicio,$nombre,$descripción,$email,$telefono,$siteweb,$imgServicio,$bannerServicio,$idProvincia,$idDepartamento,$idUsuario,$usuarioModificacion){
        return BaseDeDatos::consulta("UPDATE servicio
                                      SET servicio_descripcion = '$descripción',
                                          servicio_nombre = '$nombre',
                                          FK_idProvincia = $idProvincia,
                                          FK_idDepartamento = $idDepartamento,
                                          servicio_email = '$email',
                                          servicio_web = '$siteweb',
                                          servicio_imagen = '$imgServicio',
                                          servicio_banner = '$bannerServicio',
                                          servicio_telefono = $telefono,
                                          usr_mod = '$usuarioModificacion',
                                          fec_mod = now()
                                        WHERE idServicio = $idServicio;");
    }

    public static function updateCategoriaServicio($idServicio,$idCategoria,$usuarioModificacion){
        return BaseDeDatos::consulta("INSERT INTO categoria_servicio (FK_idServicio,FK_idCategoria,usr_alta,fec_alta,usr_mod,fec_mod)
                                      VALUE ($idServicio,$idCategoria,'$usuarioModificacion',now(),'$usuarioModificacion',now());");
    }

    public static function updateRedSocial($instagram,$linkedin,$facebook,$idRedSocial,$usuarioModificacion){
        return BaseDeDatos::consulta("UPDATE red_social
                                        SET redSocial_Instagram = '$instagram',
                                            redSocial_LinkedIn = '$linkedin',
                                            redSocial_Facebook = '$facebook',
                                            usr_mod = '$usuarioModificacion',
                                            fec_mod = now()
                                        WHERE idRedSocial = $idRedSocial;");
    }

    public static function updateTipoServicio ($tipo,$idServicio,$usuarioModificacion){
        return BaseDeDatos::consulta("UPDATE servicio_tipo
                                    SET tipo = '$tipo',
                                        usr_mod = '$usuarioModificacion',
                                        fec_mod = now()
                                    WHERE idTipo = $idServicio;");
    }

    public static function updateHoraServicio($hora_desde,$hora_hasta,$idHorario,$dia,$usuarioModificacion){
        return BaseDeDatos::consulta("UPDATE servicio_horario
                                        SET servicio_tipo_hora_desde = '$hora_desde',
                                            servicio_tipo_hora_hasta = '$hora_hasta',
                                            FK_idDias = (SELECT idDias
                                                         FROM servicio_dias
                                                         WHERE dia = '$dia'),
                                            usr_mod = '$usuarioModificacion',
                                            fec_mod = now()
                                        WHERE idServicio_horario = $idHorario");
    }

    public static function deleteServicio($idServicio,$usuarioBaja){
        return BaseDeDatos::consulta("UPDATE servicio
                                      SET usr_baja = '$usuarioBaja',
                                          fec_baja = now()
                                      WHERE idServicio = $idServicio;");
    }

    public static function bajaFisicaServicio($idServicio){
        return BaseDeDatos::consulta("DELETE FROM servicio
                                      WHERE idServicio = $idServicio;");
    }

    public static function deleteServicioHorarios($idServicio,$usuarioBaja){
        return BaseDeDatos::consulta("UPDATE servicio_horario
                                        SET usr_baja = '$usuarioBaja',
                                            fec_baja = now()
                                        WHERE FK_idServicio  = '$idServicio';");
    }

    public static function bajaFisicaHorarios($idServicio){
        return BaseDeDatos::consulta("DELETE FROM servicio_horario
                                        WHERE FK_idServicio  = '$idServicio';");
    }

    public static function deleteServicioTipo($idServicio,$usuarioBaja){
        return BaseDeDatos::consulta("UPDATE servicio_tipo
                                      SET usr_baja = '$usuarioBaja',
                                          fec_baja = now()
                                      WHERE FK_idServicio = $idServicio;");
    }

    public static function bajaFisicaTipo($idServicio){
        return BaseDeDatos::consulta("DELETE FROM servicio_tipo
                                      WHERE FK_idServicio = $idServicio;");
    }

    public static function deleteRedSocialServicio($idServicio,$usuarioBaja){
        return BaseDeDatos::consulta("UPDATE red_social
                                        SET usr_baja = '$usuarioBaja',
                                            fec_baja = now()
                                        WHERE FK_idServicio = $idServicio;");
    }

    public static function bajaFisicaRedSocial($idServicio){
        return BaseDeDatos::consulta("DELETE FROM red_social
                                        WHERE FK_idServicio = $idServicio;");
    }

    public static function deleteCategoriaServicio($idServicio,$usuarioBaja){
        return BaseDeDatos::consulta("UPDATE categoria_servicio
                                        SET usr_baja = '$usuarioBaja',
                                            fec_baja = now()
                                        WHERE FK_idServicio = $idServicio;");
    }

    public static function bajaFisicaCategoriaServicio($idServicio){
        return BaseDeDatos::consulta("DELETE FROM categoria_servicio
                                        WHERE FK_idServicio = $idServicio;");
    }

    public static function bajaFisicaTags($idServicio){
        return BaseDeDatos::consulta("DELETE FROM servicio_tags
                                        WHERE FK_idServicio = $idServicio;");
    }

    public static function bajaFisicaComentario($idServicio){
        $servicio = BaseDeDatos::consulta(" DELETE FROM comentario_servicio
                                            WHERE FK_idServicio = $idServicio;");
        return $servicio;                                            
    }
    
    public static function agregarServiciosBasicos($descripción,$idCategoria,$idProvincia,$idDepartamento,$idUsuario,$emailContacto,$sitioWeb,$nombreServicio){
        $agregarServiciosBasicos = BaseDeDatos::consulta("INSERT INTO servicio (servicio_descripcion,FK_idCategoria,FK_idProvincia,FK_idDepartamento,FK_idUsuario,usr_alta,fec_alta,servicio_email,servicio_web,servicio_nombre) VALUES ('$descripción',$idCategoria,$idProvincia,$idDepartamento,$idUsuario,'DESARROLLO',now(),'$emailContacto','$sitioWeb','$nombreServicio');");

        return $agregarServiciosBasicos;                                                  
    }


    public static function getServiciosBasicos2($idUsuario){

        $serviciosBasicos = BaseDeDatos::consulta("SELECT * FROM servicio WHERE $idUsuario = FK_idUsuario");
        return $serviciosBasicos;                                                  
    }

    public static function editServiceRolValidation($idServicio, $rol){
        // Saneamos el valor de $idServicio para evitar inyección SQL
        $idServicio = intval($idServicio);
    
        $query = "SELECT IFNULL(DATEDIFF(NOW(), fec_mod), 31) AS days_difference
                    FROM servicio
                    WHERE idServicio = $idServicio;";
        
        $result = BaseDeDatos::consulta($query);
    
        if($result){
            $data = mysqli_fetch_array($result);
            $datediff = $data["days_difference"];
    
            $edit = ["canEdit" => false, "daysRemaining" => 0];
            switch ($rol){
                case "gratis":
                    
                    if($datediff > 30)
                        $edit["canEdit"] = true;
                    else
                        $edit["daysRemaining"] = 30 - $datediff;
                    break;
                case "basico":
                    if($datediff > 7)
                        $edit["canEdit"] = true;
                    else
                        $edit["daysRemaining"] = 7 - $datediff;
                    break;
                default:
                    $edit["canEdit"] = true;
                    break;
            }            
            return $edit;
        } 
    }

    
    public static function downgradeToFree($idUsuario, $idServicio){
        //se supone que a la hora de ejecutar este metodo, el usuario ya fue modificado al plan gratuito y ya tiene solo una categoria activa
        $categoria = Categoria::getCategoriasByUser($idServicio);
        if (mysqli_num_rows($categoria) > 0) { 
            $idCategoria = mysqli_fetch_array($categoria)["FK_idCategoria"];

            $nombreImgPerfil = "category_".$idCategoria.".webp";
        }else{
            $nombreImgPerfil = "user_profile.webp";
        }

        //esta consulta deberia modificar la imagen del servicio a la generica
        return BaseDeDatos::consulta("UPDATE servicio
                                    SET servicio_imagen = '$nombreImgPerfil', servicio_banner = ''
                                    WHERE FK_idUsuario = $idUsuario;");
    }


    public static function filterServices($nombreServicio, $categorias, $pag){
        $cant = 21; 
        $offset  = ($pag-1) * $cant;
        
        $query = "SELECT s.*, u.*, r.*
                    FROM servicio s
                    INNER JOIN usuario u ON s.FK_idUsuario = u.idUsuario
                    INNER JOIN rol r ON u.FK_idRol = r.idRol
                    LEFT JOIN categoria_servicio cs ON s.idServicio = cs.FK_idServicio
                    WHERE s.fec_baja IS NULL
                    AND cs.fec_baja IS NULL
                    AND s.servicio_nombre LIKE '%$nombreServicio%'
                    " .($categorias != null ? "AND cs.FK_idCategoria IN (".implode(",",$categorias).")" : "")."
                    GROUP BY s.idServicio, u.idUsuario
                    ORDER BY CASE 
                        WHEN rol = 'pro'    THEN 1
                        WHEN rol = 'basico' THEN 2
                        WHEN rol = 'gratis' THEN 3
                        ELSE 4
                    END ASC
                    LIMIT $cant
                    OFFSET $offset";
        
        $sv = BaseDeDatos::consulta($query);

        $servicios = [];
        while ($row = mysqli_fetch_array($sv, MYSQLI_ASSOC)) {
            $servicios[] = $row; 
        }
        
        $queryCantPaginas = "SELECT COUNT(*) AS CANTIDAD
        FROM (SELECT s.idServicio FROM servicio s LEFT JOIN categoria_servicio cs ON s.idServicio = cs.FK_idServicio
        WHERE s.fec_baja IS NULL 
        AND cs.fec_baja IS NULL
        AND s.servicio_nombre LIKE '%$nombreServicio%'
        " .($categorias != null ? "AND cs.FK_idCategoria IN (".implode(",",$categorias).")" : "")."
        GROUP BY s.idServicio) as total_services";

        $resultCantidad = BaseDeDatos::consulta($queryCantPaginas);

        $cantPaginas = ceil(mysqli_fetch_array($resultCantidad)["CANTIDAD"] / 21);

        return ["servicios" => $servicios, "cantPaginas" => $cantPaginas, "pag" => $pag];  

    }

    public static function loadServices(){
        
        $query = "SELECT s.*, u.*, r.*
                    FROM servicio s
                    INNER JOIN usuario u ON s.FK_idUsuario = u.idUsuario
                    INNER JOIN rol r ON u.FK_idRol = r.idRol
                    LEFT JOIN categoria_servicio cs ON s.idServicio = cs.FK_idServicio
                    WHERE s.fec_baja IS NULL
                    AND cs.fec_baja IS NULL
                    GROUP BY s.idServicio, u.idUsuario
                    ORDER BY CASE 
                        WHEN rol = 'pro'    THEN 1
                        WHEN rol = 'basico' THEN 2
                        WHEN rol = 'gratis' THEN 3
                        ELSE 4
                    END ASC
                    LIMIT 21
                    OFFSET 0";
        
        $sv = BaseDeDatos::consulta($query);

        $servicios = [];
        while ($row = mysqli_fetch_array($sv, MYSQLI_ASSOC)) {
            $servicios[] = $row; 
        }
        
        $queryCantPaginas = "SELECT COUNT(*) AS CANTIDAD
                                FROM servicio
                                WHERE fec_baja IS NULL;";

        $resultCantidad = BaseDeDatos::consulta($queryCantPaginas);
        
        $cantPaginas = ceil(mysqli_fetch_array($resultCantidad)["CANTIDAD"] / 21);

        return ["servicios" => $servicios, "cantPaginas" => $cantPaginas, "pag" => '1'];

    }

    public static function calcularPuntaje($servicio){
        $puntaje = BaseDeDatos::consulta("SELECT AVG(puntaje) as puntaje FROM comentario_servicio WHERE FK_idServicio = $servicio");
        $puntaje = mysqli_fetch_array($puntaje);
        $puntaje = $puntaje['puntaje'];
        $puntaje = round($puntaje, 1);
        $updatePuntaje = BaseDeDatos::consulta("UPDATE servicio SET servicio_puntaje = $puntaje WHERE idServicio = $servicio");
        return $updatePuntaje;
    }
}
