<?php 
//include "conexio.php";
require_once('checkUser.php');

$username =  $_REQUEST['username'];
$password =  $_REQUEST['password'];

if ($username!= "" && $password!= ""){

    $user = new Usuari();

    $resultUser = $user->registrar($username, $password);

    if($resultUser == false){
        $response =  array("status" => "FAIL");
    }else{
        $response =  array("status" => "OK");   
        //POR SI ACASO
        //$response =  array("status" => "OK", "datos" =>  array( "nombre" => $resultUser[0]['nom'] , "imagen" => "imagen.jpg"));   
    }
}
else{
    $response =  array("status" => "VACIO");
}

echo json_encode($response);


?>