<?php

require_once('Categoria.php');

$categoria = new Categoria();

$categories = $categoria->selectTotesCategories();

if(!empty($categories)){
    $response =  array("status" => "OK", "datos" =>  $categories);   
}else{
    $response =  array("status" => "ERROR");   
}

echo json_encode($response);

?>