<?php

require_once('Categoria.php');

$categoria =  $_REQUEST['categoria'];

$objCategoria = new Categoria();

$categories = $objCategoria->filtreCategories($categoria);

if(!empty($categories)){
    $response =  array("status" => "OK", "datos" =>  $categories);   
}else{
    $response =  array("status" => "ERROR");   
}

echo json_encode($response);

?>