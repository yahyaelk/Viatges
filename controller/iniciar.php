<?php
    require_once('../model/usuari.php');
    $usuari= new Usuari ();
    $user = $usuari->iniciarSessio();

    if (sizeof($user) == 0){
        echo 'false';
    }
    else{
        echo 'true';
    }
?>