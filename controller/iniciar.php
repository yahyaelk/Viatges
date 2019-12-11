<?php
    //require_once('../model/usuari.php');
    include "conexio.php";

    // Check user login or not
    if(!isset($_SESSION['userLogged'])){
        header('Location: index.php');
    }

    // logout
    if(isset($_POST['but_logout'])){
        session_destroy();
        header('Location: index.php');
    }
    /*$usuari= new Usuari ();
$user = $usuari->iniciarSessio();

if (sizeof($user) == 0){
echo 'false';
}
else{
echo 'true';
}*/
?>

<!DOCTYPE html>
<html>

<head></head>

<body>
    <h1>Homepage</h1>
    <form method='post' action="">
        <input type="submit" value="Logout" name="but_logout">
    </form>
</body>

</html>