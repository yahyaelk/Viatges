<?php

require_once('conexio.php');

class Usuari extends Conexio {

    function __construct() {
        $this->db_name = "a17yahelekaj_viatges";
    }

    public function selectTotsUsuaris() {
        $this->query = "SELECT id, nom FROM usuari";
        $this->get_results_from_query();

        if (count($this->rows)==1) {
            foreach ($this->rows[0] as $property => $value)
            $this->$property = $value;
        }

        return $this->rows;
    }

    public function deleteUsuari($id){
        $this->query = "DELETE FROM usuari WHERE id = $id";
        $this->execute_single_query();
    }

}

?>