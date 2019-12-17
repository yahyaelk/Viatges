<?php
require_once('Categoria.php');

$categoria =  $_REQUEST['categoria'];
$cat = new Categoria();
$cat->eliminarCategoria($categoria);


?>