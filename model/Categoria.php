<?php

require_once('conexio.php');

class Categoria extends Conexio {

    function __construct() {
        $this->db_name = "viatges";
    }

    public function selectTotesCategories(){
        $this->query = "SELECT * FROM categoria";
        $this->get_results_from_query();

        if (count($this->rows)==1) {
            foreach ($this->rows[0] as $property => $value)
            $this->$property = $value;
        }

        return $this->rows;
    }

}

?>