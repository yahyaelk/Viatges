<?php

abstract class Conexio {
  private static $db_host = "localhost";
<<<<<<< HEAD
  private static $db_user = "a18sonvargar";
  private static $db_pass = "a18sonvargar7";
=======
  private static $db_user = "laia";
  private static $db_pass = "laia";
>>>>>>> 3495d0477e469bbbd83d35ac11d318828f1d41a6

  protected $db_name;

  protected $query;

  protected $rows=array();

  private $conn;

  private function open_connection() {
    $this->conn = new mysqli (self::$db_host, self::$db_user, self::$db_pass, $this->db_name);
    $this->conn ->set_charset("utf8");
  }
  
  private function close_connection(){
    $this->conn->close();
  }
  
  protected function execute_single_query(){
    $this->open_connection();
    $this->conn->query($this->query);
    $this->close_connection();
  }
  
  protected function get_results_from_query () {
    $this->open_connection();
    $result = $this->conn->query($this->query);
    for ($i=0;$i<$result->num_rows;$i++)
      $this->rows[$i]=$result->fetch_assoc();
    $result->close();
    $this->close_connection();
  }
}

?>