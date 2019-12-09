<?php

require_once('DBAbstractModel.php');

class Experiencia extends DBAbstractModel {

    function __construct() {
        $this->db_name = "a17yahelekaj_viatges";
    }

    public function selectUltimesExperiencies() {
        $this->query = "SELECT titol FROM experiencia";
        $this->get_results_from_query();

        if (count($this->rows)==1) {
            foreach ($this->rows[0] as $property => $value)
            $this->$property = $value;
        }

        return $this->rows;
    }

}

?>