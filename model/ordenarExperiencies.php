<?php

require_once('Experiencia.php');

$dataPunt =  $_REQUEST['dataPunt'];

$ascDesc =  $_REQUEST['ascDesc'];

$categoria =  $_REQUEST['categoria'];

$experiencia = new Experiencia();

$experiencies = $experiencia->selectExperienciesOrdenades($dataPunt, $ascDesc, $categoria);

echo json_encode($experiencies);
?>