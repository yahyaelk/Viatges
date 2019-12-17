<?php

require_once('conexio.php');

class Categoria extends Conexio {

    function __construct() {
        $this->db_name = "viatges";
    }

    public function eliminarCategoria($categoria){
        $this->query = "DELETE FROM categoria WHERE id=$categoria";
        $this->get_results_from_query();

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

    public function filtreCategories($categoria){
        if ($categoria== "todas"){
            $this->query = "SELECT * FROM experiencia";
            $this->get_results_from_query();
        }
        else{
            $this->query = "SELECT * FROM experiencia WHERE id_cat = $categoria";
            $this->get_results_from_query();
        }
        if (count($this->rows)==1) {
            foreach ($this->rows[0] as $property => $value)
            $this->$property = $value;
        }

        return $this->rows;

    }

}

?>