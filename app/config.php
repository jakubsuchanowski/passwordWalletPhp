<?php
class config{
    private $db_host;
    private $db_username;
    private $db_password;
    private $db_name;
    public $conn;

    public function __construct() {
        $this->db_host = "localhost";  
        $this->db_username = "root";  
        $this->db_password = "root";   
        $this->db_name = "mydb";       
    }
    public function connect(){
        try{
            $this->conn=new mysqli($this->db_host,$this->db_username, $this->db_password, $this->db_name);
            if($this->conn->connect_error){
                throw new Exception($this->conn->connect_error);
            }
            return $this->conn;
        }catch(Exception $e){
        die("Błąd połączenia z bazą danych: ". $e->getMessage());
    }
    }
}




?>
