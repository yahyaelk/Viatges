<?php

require_once('Categoria.php');

$categoria =  $_REQUEST['categoria'];

$categoria = new Categoria();

$categories = $categoria->filtreCategories();

if(!empty($categories)){
    $response =  array("status" => "OK", "datos" =>  $categories);   
}else{
    $response =  array("status" => "ERROR");   
}

echo json_encode($response);

?>