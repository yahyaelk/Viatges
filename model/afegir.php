<?php
require_once('Experiencia.php');

$titol =  $_REQUEST['titol'];
$fecha =  $_REQUEST['fecha'];
$text =  $_REQUEST['text'];

$experiencia= new Experiencia();

$experiencia-> afegirExperiencia($titol, $fecha, $text);

?>