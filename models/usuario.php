<?php
// Incluir el archivo de logging
include 'logConfig.php';

(file_exists("./../config/conexion.php"))? require_once('./../config/conexion.php') : require_once('./config/conexion.php');
class Usuario{
    
    public static function agregarUsuarios($nomUsuario,$password,$email,$imgLogoRuta,$imgBannerRuta,$telefono,$nombreApellido,$idRol = null){
        if(!$idRol){
            $servicioBasico = BaseDeDatos::consulta("SELECT * 
                                                     FROM rol
                                                     WHERE upper(rol) = 'BASICO'");
    
            if($row = mysqli_fetch_array($servicioBasico)){
                $idRolBasico = $row["idRol"];
                $user = BaseDeDatos::consulta("INSERT INTO usuario (user_login,user_pass,user_email,user_img_perfil,user_img_banner,user_telefono,user_nombre,usr_alta,fec_alta,FK_idRol) 
                                               VALUES ('$nomUsuario',sha1('$password'),'$email','$imgLogoRuta','$imgBannerRuta','$telefono','$nombreApellido','DESARROLLO',now(),'$idRolBasico');");
    
            }
        }else{
            $user = BaseDeDatos::consulta("INSERT INTO usuario (user_login,user_pass,user_email,user_img_perfil,user_img_banner,user_telefono,user_nombre,usr_alta,fec_alta,FK_idRol) 
                                           VALUES ('$nomUsuario',sha1('$password'),'$email','$imgLogoRuta','$imgBannerRuta','$telefono','$nombreApellido','DESARROLLO',now(),'$idRol');");
        }

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

    public static function getUsuario($idUsuario){
        $user = BaseDeDatos::consulta("SELECT *
                                      FROM usuario
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
        return BaseDeDatos::consulta("SELECT * FROM usuario
                                      WHERE idUsuario IN (SELECT MAX(idUsuario) FROM usuario);");
    }

    public static function updateUsuario($nomUsuario,$password,$email,$imgLogoRuta,$telefono,$nombreApellido,$usuarioModificacion,$idUsuario){

        if($password == ""){
            return BaseDeDatos::consulta("UPDATE usuario
                                        SET user_nombre = '$nombreApellido',
                                            user_email = '$email',
                                            user_login = '$nomUsuario',
                                            user_telefono = '$telefono',
                                            user_img_perfil = '$imgLogoRuta',
                                            usr_mod = '$usuarioModificacion',
                                            fec_mod = now()
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
                                            fec_mod = now()
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
        $getUsuariosEmail = BaseDeDatos::consulta("SELECT u.* FROM usuario u WHERE '$email' = u.user_email;");

        return $getUsuariosEmail;  
        
    }

    public static function getUsuarioContraseña($user,$pass){
        $getUsuarioContraseña = BaseDeDatos::consulta("SELECT * 
                                                       FROM usuario u, rol r
                                                       WHERE r.idRol = u.FK_idRol
                                                       AND u.user_login = '$user'
                                                       AND u.user_pass = '$pass';");
        return $getUsuarioContraseña;
    }

    public static function setForgotPasswordUser($email,$forgotPassword){
        return BaseDeDatos::consulta("UPDATE usuario
                                      SET forgot_pass = md5('$forgotPassword')
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
}
