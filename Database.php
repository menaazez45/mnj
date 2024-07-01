<?php


class Database{
    //properties
    public $tableName;
    public $conn;
public $dbname;




    //Methods

    public function __construct($TName)

    {
        $this -> tableName =$TName;
        $this-> dbname =$bd_name;
        $this -> connect();
    }
    public function connect(){
        $this -> conn = new mysqli("localhost" , "root" , "" ,$this->dbname);
    }
    
        public function selectAll(){
$select = "SELECT * from ($this ->tableName)";
$result = $this->conn ->quer($select);
// print_r($result->fetch_assoc()){
   
// }
        }
        public function delet($col,$val ){
$delet = "DELET FROM $this->tableName WHERE $col = $val";
$this-> conn ->quer($delet);
        }
        public function insert($arr) {
            $keys = array_keys($arr);
            
           $insert = "INSERT INTO $this->tableName() Values()";
        }
        }
    //endclass

    $admins = new Database("admins" , "dom_project");
    echo"<pre>";
    $admins->select("id","3");
    $admins -> delet("id" , "3");
$admins ->insert({
"username" => "mena",
"password" => "12345",
"phone" => "01290990",
"email" => "mena@gmail.com",
"gender" => "1",
"pr" =>"1";
});



?>