<?php
class Phone{
  
    // database connection and table name
    private $conn;
    private $table_name = "phones";
  
    // object properties
    public $phone_id;
    public $contact_id;
    public $phone_type;
    public $number;
   
  
    public function __construct($db){
        $this->conn = $db;
    }
  
   // used to read category name by its ID
function readPhone(){
      
    $query = "SELECT * FROM " . $this->table_name . " WHERE contact_id = ?";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->contact_id);
    $stmt->execute();
    $i=0;
    $this->phone_numbers = "";
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $i++;
        $this->phone_type = $row['phone_type'];
        $this->number = $row['number'];
       
        $this->phone_numbers .= nl2br("Phone ".$i." : ".$this->phone_type." - ".$this->number."\r\n");
    }
   
      
    
}
  
}
?>