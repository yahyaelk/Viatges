<?php

require_once('conexio.php');
require_once('index.php');

class Usuari extends Conexio {

    function __construct() {
        $this->db_name = "viatges";
    }

    public function iniciarSessio($username, $password) {
        $this->query = "SELECT * FROM usuari WHERE nom='$username' AND contrasenya='$password'";
        $this->get_results_from_query();

        if (count($this->rows)==1) {
            foreach ($this->rows[0] as $property => $value)
            $this->$property = $value;
        }

        return $this->rows;
    }

}

?>