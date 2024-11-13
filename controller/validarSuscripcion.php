<?php
require_once __DIR__ . '/../vendor/autoload.php';

//require(__DIR__."/../models/usuario.php");
require(__DIR__."/../models/categoria.php");
require(__DIR__."/../models/galeria.php");
require(__DIR__."/../models/servicio.php");
//require(__DIR__."/../models/suscripcionServicio.php");

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\PreApproval\PreApprovalClient;
use MercadoPago\Client\PreApprovalPlan\PreApprovalPlanClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../config/");
$dotenv->load();

$access_token = $_ENV['ACCESS_TOKEN'] ?? null;

MercadoPagoConfig::setAccessToken($access_token);

class ValidarSuscripcion {

public static function validarEstadoSuscripcion($idUsuario, $checkDate){
    $suscripcion = SuscripcionServicio::getSuscripcion($idUsuario);
    
    $idSuscripcion = mysqli_fetch_array($suscripcion)["id_suscripcion"];

    $preapproval_plan = new PreApprovalClient();
    
    //se llama a mp
    $preapproval = $preapproval_plan->get($idSuscripcion);

    $response = json_encode($preapproval);
    $responseArray = json_decode($response, true);
    $summarized = $responseArray['summarized'];
    $suscriptionStatus = $responseArray['status'];

    $status = $summarized['semaphore'] === null ? "yellow" : $summarized['semaphore'];

    $respuesta = "no entro a ningun if porque status: ".$status." y idSuscripcion: ".$idSuscripcion. " y summarized: ".$summarized. " y response: ".$response;

    if ($suscriptionStatus === "cancelled") {
        if ($checkDate || $summarized['semaphore'] === null) {
        $result = mysqli_fetch_array(Servicio::getServicioByUsuarioId($idUsuario));
        $idServicio = $result ? $result["idServicio"] : null;
        
        //si el status es red, significa que no se ha hecho un pago, por lo tanto MODIFICAR EL PLAN/rol DEL USUARIO a gratis
        Usuario::updateRolUsuarioToFree($idUsuario);
        
        //si no tiene un servicio, no se hace nada, solo se le da de baja la suscripcion
        if  ($idServicio !== null){
        //le damos fecha de baja a todas las categorias al plan gratuito (dejamos solo 1)
        Categoria::updateCategoriasToFree($idServicio);
        //le damos fecha de baja a todas las fotos de la galeria al plan gratuito (dejamos solo 1)
        Galeria::downgradeToFreePlan($idUsuario);
        //le modificamos la foto del servicio por la generica de su categoria y la de banner
        Servicio::downgradeToFree($idUsuario, $idServicio);
        }
        //damos de baja la suscripcion, como esta en gratis no deberia existir mas (baja logica para no perder el dato)
        SuscripcionServicio::logicDeleteSuscripcion($idUsuario);
        //damos de baja la suscripcion en mercadopago
        /*$preapproval_plan->update($idSuscripcion, [
            "status" => "cancelled"
        ]);*/
        $respuesta = "se cancela plan porque status red";
        } else {
            SuscripcionServicio::updateEstadoSuscripcion($idUsuario, "pendiente");
            $respuesta = "no se cancela plan porque status red pero no se ha cumplido la fecha de vencimiento";
        }
    }  else if ($status === "green") {
        $dateTime = new DateTime($responseArray['next_payment_date']);
        $dateTime = $dateTime->modify('+1 day');
        // Format the DateTime object to match MySQL's DATETIME format (Y-m-d H:i:s)
        $mysqlFormattedDate = $dateTime->format('Y-m-d H:i:s');
        SuscripcionServicio::updateEstadoSuscripcion($idUsuario, "activa");
        SuscripcionServicio::updateFechaVencimiento($idUsuario, $mysqlFormattedDate);
        $respuesta = "se actualiza estado a activa porque status green";
    } else if ($status === "yellow") {
        SuscripcionServicio::updateEstadoSuscripcion($idUsuario, "pendiente");
        $respuesta = "se actualiza estado a pendiente porque status yellow";
    }
    



    return $respuesta. " y response: " . $response;
}



}
  

?>