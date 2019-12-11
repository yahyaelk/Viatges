<?php

include "conexio.php";
//require_once('index.php');

$username =  $_REQUEST['username'];
$password =  $_REQUEST['password'];

if ($username!= "" && $password!= ""){
    $response =  array("status" => "OK", "datos" =>  array( "nombre" => "pepe" , "imagen" => "imagen.jpg"));   
}
else{
    $response =  array("status" => "FAIL");
}

echo json_encode($response);
?>