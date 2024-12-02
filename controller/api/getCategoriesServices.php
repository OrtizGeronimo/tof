<?php
require_once(__DIR__.'/../../models/categoria.php');
require_once(__DIR__.'/ApiInterface.php');
    
    $categoria = Categoria::getCategoriaServicio();
    $categorias = ApiInterface::formulateResponse($categoria);

    header('Content-Type: application/json');
    echo json_encode($categorias);


?>