<?php

require_once('Experiencia.php');

$username =  $_REQUEST['accion'];
$id = $_REQUEST['id'];

$experiencia = new Experiencia();

$response =  array("status" => "NOACTION");

if($username == 'like'){
    $experiencia->likeExperiencia($id);
    $numLikes = $experiencia->selectLikes($id);
    if($numLikes == false){
        $response =  array("status" => "ERROR");   
    }else{
        $response =  array("status" => "OK", "num" => $numLikes);   
    }
}else if($username == 'dislike'){
    $experiencia->dislikeExperiencia($id);
    $numDislikes = $experiencia->selectDislikes($id);
    if($numDislikes == false){
        $response =  array("status" => "ERROR");   
    }else{
        $response =  array("status" => "OK", "num" => $numDislikes);   
    }
}

echo json_encode($response);

?>