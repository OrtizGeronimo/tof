<?php
require_once __DIR__ . '/../vendor/autoload.php';

//require(__DIR__."/../models/usuario.php");
require(__DIR__."/../models/categoria.php");
require(__DIR__."/../models/galeria.php");
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

public static function validarEstadoSuscripcion($idUsuario){
    $suscripcion = SuscripcionServicio::getSuscripcion($idUsuario);
    
    $idSuscripcion = mysqli_fetch_array($suscripcion)["id_suscripcion"];

    $preapproval_plan = new PreApprovalClient();
    
    //se llama a mp
    $preapproval = $preapproval_plan->get($idSuscripcion);

    $response = json_encode($preapproval);
    $responseArray = json_decode($response, true);
    $summarized = $responseArray['summarized'];

    $status = $summarized['semaphore'] === null ? "yellow" : $summarized['semaphore'];

    $respuesta = "no entro a ningun if porque status: ".$status." y idSuscripcion: ".$idSuscripcion. " y summarized: ".$summarized. " y response: ".$response;

    if ($status === "red") {
        //si el status es red, significa que no se ha hecho un pago, por lo tanto MODIFICAR EL PLAN/rol DEL USUARIO a gratis
        Usuario::updateRolUsuarioToFree($idUsuario);
        //le damos fecha de baja a todas las categorias al plan gratuito (dejamos solo 1)
        Categoria::updateCategoriasToFree($idUsuario);
        //le damos fecha de baja a todas las fotos de la galeria al plan gratuito (dejamos solo 1)
        Galeria::downgradeToFreePlan($idUsuario);
        //le modificamos la foto del servicio por la generica de su categoria y la de banner
        Servicio::downgradeToFree($idUsuario);
        //damos de baja la suscripcion, como esta en gratis no deberia existir mas (baja logica para no perder el dato)
        SuscripcionServicio::logicDeleteSuscripcion($idUsuario);
        //damos de baja la suscripcion en mercadopago
        $preapproval_plan->update($idSuscripcion, [
            "status" => "cancelled"
        ]);
        $respuesta = "se cancela plan porque status red";
    }  else if ($status === "green") {
        $dateTime = new DateTime($responseArray['next_payment_date']);

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