<?php
// Incluir el archivo de logging
include 'logConfig.php';

(file_exists("./../config/conexion.php"))? require_once('./../config/conexion.php') : require_once('./config/conexion.php');
class Usuario{

    public static function rolByName($rol){ //recive el nombre del rol devuelve el id
        $respuesta = BaseDeDatos::consulta("SELECT * 
                                            FROM rol
                                            WHERE upper(rol) = upper('$rol')");
        if($row = mysqli_fetch_array($respuesta)){
            return $row["idRol"];
        }
    }

    public static function agregarUsuarios($nomUsuario,$password,$email,$imgLogoRuta,$imgBannerRuta,$telefono,$nombreApellido, $rol){
        $idRolPredeterminado = Usuario::rolByName($rol);

        $user = BaseDeDatos::consulta("INSERT INTO usuario (user_login,user_pass,user_email,user_img_perfil,user_img_banner,user_telefono,user_nombre,usr_alta,fec_alta,FK_idRol) 
                                        VALUES ('$nomUsuario',sha1('$password'),'$email','$imgLogoRuta','$imgBannerRuta','$telefono','$nombreApellido','DESARROLLO',now(),'$idRolPredeterminado');");
        
        return $user;
    }

    public static function getAllUsuarios(){
        $user = BaseDeDatos::consulta("SELECT u.*, r.rol, idServicio, servicio_nombre
                                      FROM usuario u
                                      INNER JOIN rol r
                                      ON u.FK_idRol = r.idRol
                                      LEFT JOIN servicio s
                                      ON u.idUsuario = s.FK_idUsuario
                                      ORDER BY user_nombre ;");
        
        return $user;
    }

    public static function getAllServicios($idUsuario){
        $servicio = BaseDeDatos::consulta(" SELECT idServicio,
                                                   servicio_nombre,
                                                   servicio_descripcion,
                                                   provincia_name,
                                                   departamento,
                                                   user_nombre,
                                                   s.fec_alta
                                            FROM servicio s,provincia p,departamento d, usuario u
                                            WHERE p.idProvincia = s.FK_idProvincia
                                            AND d.idDepartamento = s.FK_idDepartamento
                                            AND u.idUsuario = s.FK_idUsuario
                                            AND s.fec_baja IS NULL
                                            AND u.idUsuario = $idUsuario;");
        return $servicio;                                            
    }

    public static function getServicios($idUsuario){
        $servicio = BaseDeDatos::consulta(" SELECT idServicio
                                            FROM usuario u
                                            LEFT JOIN servicio s
                                            ON u.idUsuario = s.FK_idUsuario
                                            WHERE u.idUsuario = $idUsuario;");
        return $servicio;                                            
    }
    
    public static function getUsuario($idUsuario){
        $user = BaseDeDatos::consulta("SELECT *
                                      FROM usuario u
                                      INNER JOIN rol r
                                      ON u.FK_idRol = r.idRol
                                      WHERE idUsuario = $idUsuario");
        return $user;
    }

    public static function getUsuarioByServicio($idServicio){
        $user = BaseDeDatos::consulta("SELECT u.*
                                      FROM usuario u join servicio s ON u.idUsuario = s.FK_idUsuario
                                      WHERE s.idServicio = $idServicio;");
        return $user;
    }

    public static function getLastUsuario(){
        return BaseDeDatos::consulta("SELECT * FROM usuario u
                                        INNER JOIN rol r
                                        ON u.FK_idRol = r.idRol
                                        WHERE idUsuario IN (SELECT MAX(idUsuario) FROM usuario);");
    }

    public static function getLastUsuarioAccurate($email){
        return BaseDeDatos::consulta("SELECT * FROM usuario u
                                        WHERE user_email = '$email';");
    }

    public static function updateUsuario($nomUsuario,$password,$email,$imgLogoRuta,$telefono,$nombreApellido,$usuarioModificacion,$idUsuario, $rol){

        $idRol = Usuario::rolByName($rol);

        if($password == ""){
            return BaseDeDatos::consulta("UPDATE usuario
                                        SET user_nombre = '$nombreApellido',
                                            user_email = '$email',
                                            user_login = '$nomUsuario',
                                            user_telefono = '$telefono',
                                            user_img_perfil = '$imgLogoRuta',
                                            usr_mod = '$usuarioModificacion',
                                            fec_mod = now(),
                                            FK_idRol = '$idRol'
                                        WHERE idUsuario = $idUsuario;");
        }else{
            return BaseDeDatos::consulta("UPDATE usuario
                                        SET user_nombre = '$nombreApellido',
                                            user_email = '$email',
                                            user_pass = sha1('$password'),
                                            user_login = '$nomUsuario',
                                            user_telefono = '$telefono',
                                            user_img_perfil = '$imgLogoRuta',
                                            usr_mod = '$usuarioModificacion',
                                            fec_mod = now(),
                                            FK_idRol = '$idRol'
                                        WHERE idUsuario = $idUsuario;");
        }

    }

    public static function getUsuarios($nomUsuario){
        $getUsuarios = BaseDeDatos::consulta("SELECT * FROM usuario WHERE '$nomUsuario' = user_login;");

        return $getUsuarios;                                                  
    }
    

    public static function getContraseña($nomUsuario){
        $getContraseña = BaseDeDatos::consulta("SELECT u.user_pass FROM usuario u WHERE '$nomUsuario' = u.user_login;");

        return $getContraseña;                                                  
    }

    public static function getUsuariosEmail($email){
        $getUsuariosEmail = BaseDeDatos::consulta("SELECT u.* FROM usuario u WHERE u.user_email = '$email';");

        return $getUsuariosEmail;  
        
    }

    public static function getUsuarioContraseña($user,$pass){
        $getUsuarioContraseña = BaseDeDatos::consulta("SELECT u.*, r.*, s.idServicio 
                                                       FROM usuario u
                                                       INNER JOIN rol r
                                                       ON r.idRol = u.FK_idRol
                                                       LEFT JOIN servicio s
                                                       ON s.FK_idUsuario = u.idUsuario
                                                       WHERE u.user_login = '$user'
                                                       AND u.user_pass = '$pass';");
        return $getUsuarioContraseña;
    }

    public static function setForgotPasswordUser($email,$forgotPassword){
        $hashedPassword = password_hash($forgotPassword, PASSWORD_DEFAULT);
        return BaseDeDatos::consulta("UPDATE usuario
                                      SET forgot_pass = '$hashedPassword'
                                      WHERE user_email = '$email';");
    }

    public static function getUsuarioWithForgotPassword($forgotPassword){
        return BaseDeDatos::consulta("SELECT *
                                      FROM usuario
                                      WHERE forgot_pass = '$forgotPassword';");
    }

    public static function setPassword($password,$userlogin,$forgotPassword){
        return BaseDeDatos::consulta("UPDATE usuario 
                                        SET user_pass = sha1('$password'),
                                            forgot_pass = NULL
                                        WHERE user_login = '$userlogin'
                                        AND forgot_pass = '$forgotPassword';");
    }

    public static function updateRolUsuario($idUsuario, $idRol){
        return BaseDeDatos::consulta("UPDATE usuario
                                      SET FK_idRol = $idRol
                                      WHERE idUsuario = $idUsuario;");
    }

    public static function updateRolUsuarioToFree($idUsuario){
        return BaseDeDatos::consulta("UPDATE usuario
                                      SET FK_idRol = 6
                                      WHERE idUsuario = $idUsuario;");
    }

    public static function deleteUsuario($idUsuario){
        return BaseDeDatos::consulta("DELETE FROM usuario 
                                        WHERE user_email = '$idUsuario';");
    }

    public static function actualizarPlanSinSuscripcion(){
        return BaseDeDatos::consulta("UPDATE usuario
                                      SET FK_idRol = 6,
                                      fecha_actua_plan = NULL
                                      WHERE fecha_actua_plan IS NOT NULL
                                      AND fecha_actua_plan < CURDATE();");
    }

    public static function actualizarFechaPlan($idUsuario){
        return BaseDeDatos::consulta("UPDATE usuario
                                      SET fecha_actua_plan = DATE_ADD(CURDATE(), INTERVAL 15 DAY)
                                      WHERE idUsuario = $idUsuario;");
    }

    public static function generarReporteUsuario($userIds){
        return BaseDeDatos::consulta("SELECT 
                                        u.idUsuario, 
                                        u.user_nombre, 
                                        u.user_email, 
                                        s.servicio_nombre, 
                                        u.user_telefono, 
                                        r.rol, 
                                        u.fec_alta,
                                        GROUP_CONCAT(c.tipo ORDER BY c.tipo SEPARATOR ', ') AS categorias
                                    FROM 
                                        usuario u
                                    INNER JOIN 
                                        rol r ON r.idRol = u.FK_idRol
                                    LEFT JOIN 
                                        servicio s ON u.idUsuario = s.FK_idUsuario
                                    LEFT JOIN 
                                        categoria_servicio cs ON s.idServicio = cs.FK_idServicio
                                    LEFT JOIN 
                                        categoria c ON cs.FK_idCategoria = c.idCategoria
                                    WHERE 
                                        u.idUsuario IN ($userIds)
                                    GROUP BY 
                                        u.idUsuario, 
                                        s.idServicio
                                    ");
    }

}
