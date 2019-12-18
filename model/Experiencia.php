<?php

require_once('conexio.php');

class Experiencia extends Conexio {

    function __construct() {
        $this->db_name = "a17yahelekaj_viatges";
    }

    public function selectUltimesExperiencies() {
        $this->query = "SELECT * FROM experiencia ORDER BY fecha_publ DESC LIMIT 12";
        $this->get_results_from_query();

        if (count($this->rows)==1) {
            foreach ($this->rows[0] as $property => $value)
            $this->$property = $value;
        }

        return $this->rows;
    }

    public function afegirExperiencia($titol, $fecha, $text, $cat){
        session_start();
        if(isset($_SESSION['userLogged'])){
            $idUser = $_SESSION['userLogged'];
            $random= random_int(8, 100);
            $url= "https://picsum.photos/286/180?random=";
            $img= $url. $random;
            $this->query = "INSERT INTO experiencia (titol, contingut, fecha_publ, imatge, id_us, id_cat) VALUES ('$titol', '$text', '$fecha', '$img', $idUser, $cat)";
            $this->execute_single_query();
        }
        
        
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

    public function selectExperienciesOrdenades($dataPunt, $ascDesc, $categoria) {
        $querySelectExp = "";
        $where = "";

        if($categoria != "todas"){
            $where = "WHERE id_cat = $categoria";
        }

        if($dataPunt == 'data'){
            if($ascDesc == 'asc'){
                $querySelectExp = "SELECT * FROM experiencia ".$where." ORDER BY fecha_publ ASC LIMIT 12";
            }else if($ascDesc == 'desc'){
                $querySelectExp = "SELECT * FROM experiencia ".$where." ORDER BY fecha_publ DESC LIMIT 12";
            }
        }else if($dataPunt == 'puntuacio'){
            if($ascDesc == 'asc'){
                $querySelectExp = "SELECT * FROM experiencia ".$where." ORDER BY (valoracioPos - valoracioNeg) ASC LIMIT 12";
            }else if($ascDesc == 'desc'){
                $querySelectExp = "SELECT * FROM experiencia ".$where." ORDER BY (valoracioPos - valoracioNeg) DESC LIMIT 12";
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