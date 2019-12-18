<?php

include "conexio.php";
//require_once('index.php');

class Usuari extends Conexio {

    function __construct() {
        $this->db_name = "a17yahelekaj_viatges";
    }

    public function iniciarSessio($username, $password) {
        $this->query = "SELECT * FROM usuari WHERE nom='$username' AND contrasenya='$password'";
        $this->get_results_from_query();
        if (count($this->rows)==1) {
            foreach ($this->rows[0] as $property => $value)
            $this->$property = $value;
            session_start();
            $_SESSION['userLogged']= $this->rows[0]['id'];
            return $this->rows;
        }
        else{
            return false;
        }
    }
    public function registrar ($username, $password){
        $this->query = "INSERT INTO usuari (nom, contrasenya) VALUES ('$username', '$password')";
        $this->execute_single_query();

        return $this->iniciarSessio($username, $password);
    }

    public function existeixUsuari ($username){
        $this->query = "SELECT * FROM usuari WHERE nom='$username'";
        $this->get_results_from_query();

        if (count($this->rows)==1) {
            foreach ($this->rows[0] as $property => $value)
            $this->$property = $value;
            return $this->rows;
        }
        else{
            return false;
        }
    }
}

?>