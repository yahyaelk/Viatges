<?php

require_once('Experiencia.php');

$dataPunt =  $_REQUEST['dataPunt'];

$ascDesc =  $_REQUEST['ascDesc'];

$experiencia = new Experiencia();

$experiencies = $experiencia->selectExperienciesOrdenades($dataPunt, $ascDesc);

echo json_encode($experiencies);
?>