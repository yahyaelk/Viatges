<?php

    session_start();

    if (empty($_SESSION['userLogged'])) {
        echo 'false';
    }else{
        echo 'true';
    }
    
?>