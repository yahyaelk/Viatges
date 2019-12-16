<?php

require_once('conexio.php');

class Experiencia extends Conexio {

    function __construct() {
        $this->db_name = "viatges";
    }

    public function selectUltimesExperiencies() {
        $this->query = "SELECT * FROM experiencia ORDER BY fecha_publ DESC LIMIT 3";
        $this->get_results_from_query();

        if (count($this->rows)==1) {
            foreach ($this->rows[0] as $property => $value)
            $this->$property = $value;
        }

        return $this->rows;
    }
    
    public function afegirExperiencia($titol, $fecha, $text){
        $img= "https://picsum.photos/286/180";
        $this->query = "INSERT INTO experiencia (titol, contingut, fecha_publ, imatge) VALUES ('$titol', '$text', '$fecha', '$img')";
        $this->execute_single_query();
        
    }
    
    public function likeExperiencia($id){
        $this->query = "UPDATE experiencia SET valoracioPos = valoracioPos + 1 WHERE id = $id";
        $this->execute_single_query($this->query);
    }
    
    public function dislikeExperiencia($id){
        $this->query = "UPDATE experiencia SET valoracioNeg = valoracioNeg + 1 WHERE id = $id";
        $this->execute_single_query($this->query);
    }

    public function selectLikes($id){
        $this->query = "SELECT valoracioPos FROM experiencia WHERE id=$id";
        $this->get_results_from_query();

        if (count($this->rows)==1) {
            return $this->rows[0]['valoracioPos'];
        }

        return false;
    }

    public function selectDislikes($id){
        $this->query = "SELECT valoracioNeg FROM experiencia WHERE id=$id";
        $this->get_results_from_query();

        if (count($this->rows)==1) {
            return $this->rows[0]['valoracioNeg'];
        }

        return false;
    }

    public function selectExperienciesOrdenades($dataPunt, $ascDesc) {
        $querySelectExp = "";
        if($dataPunt == 'data'){
            if($ascDesc == 'asc'){
                $querySelectExp = "SELECT * FROM experiencia ORDER BY fecha_publ ASC LIMIT 3";
            }else if($ascDesc == 'desc'){
                $querySelectExp = "SELECT * FROM experiencia ORDER BY fecha_publ DESC LIMIT 3";
            }
        }else if($dataPunt == 'puntuacio'){
            if($ascDesc == 'asc'){
                $querySelectExp = "SELECT * FROM experiencia ORDER BY (valoracioPos - valoracioNeg) ASC LIMIT 3";
            }else if($ascDesc == 'desc'){
                $querySelectExp = "SELECT * FROM experiencia ORDER BY (valoracioPos - valoracioNeg) DESC LIMIT 3";
            }
        }
        $this->query = $querySelectExp;
        $this->get_results_from_query();

        if (count($this->rows)==1) {
            foreach ($this->rows[0] as $property => $value)
            $this->$property = $value;
        }

        return $this->rows;
    }
}

?>