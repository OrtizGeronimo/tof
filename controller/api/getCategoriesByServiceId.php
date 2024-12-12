<?php

require_once(__DIR__.'/../../models/categoria.php');
require_once(__DIR__.'/ApiInterface.php');


$inputData = file_get_contents('php://input');

$requestData = json_decode($inputData, true);


$idServicio = $requestData['idServicio'] ?? '';

$categoria = Categoria::getCategoriasByUser($idServicio);

$categorias = ApiInterface::formulateResponse($categoria);

header('Content-Type: application/json');
echo json_encode($categorias);
?>
