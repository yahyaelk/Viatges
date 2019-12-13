<?php
require_once('Experiencia.php');

$titol =  $_REQUEST['titol'];
$fecha =  $_REQUEST['fecha'];
$text =  $_REQUEST['text'];
$categoria =  $_REQUEST['categoria'];

$experiencia= new Experiencia();

$resultExp= $experiencia-> afegirExperiencia($titol, $fecha, $text);

$response =  array("status" => "OK"); 
echo json_encode($response);
?>