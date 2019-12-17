<?php

require_once('../model/Usuari.php');

if(isset($_POST['idEliminar']) && !empty($_POST['idEliminar'])){
    $id = $_POST['idEliminar'];

    $usuari = new Usuari();

    $usuari->deleteUsuari($id);
}

header("Location: admin_users.php");
die();
?>