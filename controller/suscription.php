<?php
require('./../models/suscripcionServicio.php');
//obtenemos data de la peticion
    $input = file_get_contents('php://input'); 
    $data = json_decode($input, true);  

    SuscripcionServicio::crearSuscripcion($data['idUsuario'], $data['id'], $data['estado']);
    
    $response = [
        'status' => "success",
        'message' => 'Suscripcion creada con exito'
    ];


    echo json_encode($response);
?>