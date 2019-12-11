<?php

require_once('Experiencia.php');

$experiencia = new Experiencia();

$experiencies = $experiencia->selectUltimesExperiencies();

echo json_encode($experiencies);

?>