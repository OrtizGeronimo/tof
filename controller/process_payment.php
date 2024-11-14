<?php
require_once './../vendor/autoload.php';
require('./../models/categoria.php');
require('./../models/servicio.php');
require('./../models/suscripcionServicio.php');
require_once('./../models/galeria.php');
require('./../models/usuario.php');

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\PreApproval\PreApprovalClient;
use MercadoPago\Client\PreApprovalPlan\PreApprovalPlanClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

$dotenv = Dotenv\Dotenv::createImmutable("./../config/");
$dotenv->load();

$access_token = $_ENV['ACCESS_TOKEN'] ?? null;

MercadoPagoConfig::setAccessToken($access_token);

$client = new PaymentClient();
//$request_options = new RequestOptions();
//$request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);

$input = file_get_contents('php://input');  // Get the raw POST data
$data = json_decode($input, true);  

//var_dump($data);
try {
  /*$payment = $client->create([
    "transaction_amount" => (float) $data['transaction_amount'], // Transaction amount
    "token" => $data['token'],                                   // Card token
    "description" => $data['description'],                       // Description
    "installments" => (int) $data['installments'],               // Number of installments
    "payment_method_id" => $data['payment_method_id'],           // Payment method ID
    "issuer_id" => $data['issuer_id'],                           // Issuer ID (Bank)
    "payer" => [
      "email" => $data['payer']['email'],                        // Payer's email
      "identification" => [
        "type" => $data['payer']['identification']['type'],      // Payer's ID type
        "number" => $data['payer']['identification']['number'],  // Payer's ID number
      ]
    ]
  ]);*/

  if($data['formType'] === "E"){

    if($data['planActual'] === "basico" || $data['planActual'] === "pro"){
      $usuario = Usuario::getUsuariosEmail($data['payer']['email']);
      $idUsuario = mysqli_fetch_array($usuario)["idUsuario"];
      //$idServicio = mysqli_fetch_array(Servicio::getServicioByUsuarioId($idUsuario))["idServicio"];
      $Servicio = Servicio::getServicioByUsuarioId($idUsuario);                
      if(mysqli_num_rows($Servicio) > 0){
          $idServicio = mysqli_fetch_array($Servicio)["idServicio"];
      }else{
          $idServicio = null;
      }
      $suscripcion = SuscripcionServicio::getSuscripcion($idUsuario);    
      $idSuscripcion = mysqli_fetch_array($suscripcion)["id_suscripcion"];
      $preapproval_plan = new PreApprovalClient();    
      //se llama a mp
      //$preapproval = $preapproval_plan->get($idSuscripcion);

      //cancelar suscripcion
      $preapproval_plan->update($idSuscripcion, [
        "status" => "cancelled"
      ]);

      //damos de baja la suscripcion (baja logica para no perder el dato)
      SuscripcionServicio::logicDeleteSuscripcion($idUsuario);

      if($data['plan'] === "basico" && $data['planActual'] === "pro"){
        //si pasa de uno pago a otro pago se cancela la suscripcion y se crea la del nuevo plan ademas de modificar limite de beneficios si es necesario
        
        //le damos fecha de baja a todas las categorias al plan basico
        if($idServicio !== null){
          Categoria::downgradeCategoriasToBasic($idServicio);          
          //le damos fecha de baja a todas las fotos de la galeria al plan basico
          Galeria::downgradeToBasicPlan($idUsuario);
        }
        
      }
    }
  }

  $preapproval_plan = new PreApprovalClient();

  if  ($data['plan'] === "basico") {
    $preapproval = $preapproval_plan->create([
      "preapproval_plan_id" => "2c93808491eb5f1c01920c31b87f0a74",
      "back_url" => "https://www.todooficio.com/admin/newService.php",
      "reason" => "Suscripción a plan basico",
      "reference" => "4",
      "card_token_id" => $data['token'],
      "payer_email" => $data['payer']['email'],
      "status" => "authorized",
      "auto_recurring" => [
        "frequency" => 1,
        "frequency_type" => "months",
        "transaction_amount" => 60,
        "currency_id" => "ARS"
      ]
    ]);
  } else if ($data['plan'] === "pro") {

    $preapproval = $preapproval_plan->create([
      "preapproval_plan_id" => "2c93808491eb5f1c01920c31b9ae0a75",
      "back_url" => "https://www.todooficio.com/admin/newService.php",
      "reason" => "Suscripción a plan basico",
      "reference" => "5",
      "card_token_id" => $data['token'],
      "payer_email" => $data['payer']['email'],
      "status" => "authorized",
      "auto_recurring" => [
        "frequency" => 1,
        "frequency_type" => "months",
        "transaction_amount" => 70,
        "currency_id" => "ARS"
      ]
    ]);
  }
  
echo json_encode($preapproval); 

//$payment_json = json_encode($payment);
//echo ($payment_json);
} catch (MPApiException $e) {
    echo json_encode($e->getApiResponse()->getContent());
}

?>