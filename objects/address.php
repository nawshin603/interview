<?php
class Address{
  
    // database connection and table name
    private $conn;
    private $table_name = "locations";
  
    // object properties
    public $location_id;
    public $contact_id;
    public $location_type;
    public $street;
    public $city;
    public $state;
    public $zip;
    public $country;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
   // used to read category name by its ID
function readAddress(){
      
    $query = "SELECT * FROM " . $this->table_name . " WHERE contact_id = ?";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->contact_id);
    $stmt->execute();
    $i=0;
    $this->full_address = "";
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $i++;
        $this->location_type = $row['location_type'];
        $this->street = $row['street'];
        $this->city = $row['city'];
        $this->state = $row['state'];
        $this->zip = $row['zip'];
        $this->country = $row['country'];
        $this->full_address .= nl2br("Address ".$i." : ".$this->location_type.",".$this->street.",".$this->city.",".$this->state.",".$this->zip.",".$this->country."\r\n");
    }
   
      
    
}

  function readOne(){
  
    $query = "SELECT
                *
            FROM
                " . $this->table_name . "
            WHERE
                contact_id = ?
            LIMIT
                0,4";
  
   
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->contact_id);
    $stmt->execute();

   
  
    return $stmt;
}

function readLocation(){
  
    $query = "SELECT
               *
            FROM
                " . $this->table_name . "
            WHERE
                location_id = ?
            LIMIT
                0,1";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->location_id);
    $stmt->execute();
  
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    $this->location_type = $row['location_type'];
    $this->street = $row['street'];
    $this->country = $row['country'];

}

public function countAll(){
  
    $query = "SELECT location_id FROM " . $this->table_name . "";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    $num = $stmt->rowCount();
  
    return $num;
}
  
}
?>