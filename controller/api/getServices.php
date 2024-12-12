<?php
require_once(__DIR__.'/../../models/servicio.php');
require_once(__DIR__.'/ApiInterface.php');
    
    $servicios = Servicio::loadServices();
    
    header('Content-Type: application/json');
    echo json_encode($servicios);

?>