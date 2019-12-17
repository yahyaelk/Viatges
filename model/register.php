<?php

require_once('checkUser.php');

$username =  $_REQUEST['username'];
$password =  $_REQUEST['password'];

if ($username != "" && $password != "") {

    $user = new Usuari();

    if($user->existeixUsuari($username) == false){
        $resultUser = $user->registrar($username, $password);

        if ($resultUser == false) {
            echo "FAIL";
        } else {
            echo "OK";
        }

    }else{
        echo "EXISTEIX";
    }
   
} else {
    echo "VACIO";
}
