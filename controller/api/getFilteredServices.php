<?php
require_once(__DIR__.'/../../models/servicio.php');
require_once(__DIR__.'/ApiInterface.php');


$inputData = file_get_contents('php://input');

$requestData = json_decode($inputData, true);


$searchTerm = $requestData['searchTerm'] ?? '';
$selectedCategories = $requestData['selectedCategories'] ?? [];
$pag = $requestData['page'] ?? 1;


$filteredServices = Servicio::filterServices($searchTerm, $selectedCategories, $pag);


header('Content-Type: application/json');
echo json_encode($filteredServices);
?>
