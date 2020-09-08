<?php
class Contact{
  
    // database connection and table name
    private $conn;
    private $table_name = "contacts";
  
    // object properties
    public $contact_id;
    public $first_name;
    public $last_name;
    public $birth_date;
    public $email;

  
    public function __construct($db){
        $this->conn = $db;
    }
  
    function readAll($from_record_num, $records_per_page){
  
    $query = "SELECT
                *
            FROM
                " . $this->table_name . "
            ORDER BY
                first_name ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    return $stmt;
}

function readOne(){
  
    $query = "SELECT
               *
            FROM
                " . $this->table_name . "
            WHERE
                contact_id = ?
            LIMIT
                0,1";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->contact_id);
    $stmt->execute();
  
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    $this->first_name = $row['first_name'];
    $this->last_name = $row['last_name'];
    $this->birth_date = $row['birth_date'];
    $this->email = $row['email'];
}
//Create

function create_contact(){
  
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                first_name = :first_name,
                last_name = :last_name,
                email = :email,
                birth_date  = :birth_date";
  
    $stmt = $this->conn->prepare($query);
  
    // posted values
    $this->first_name=htmlspecialchars(strip_tags($this->first_name));
    $this->last_name=htmlspecialchars(strip_tags($this->last_name));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->birth_date=htmlspecialchars(strip_tags($this->birth_date));
   
  
    // bind parameters
    $stmt->bindParam(':first_name', $this->first_name);
    $stmt->bindParam(':last_name', $this->last_name);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':birth_date', $this->birth_date);
   
    // execute the query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
}
//Create End

//Update

function update(){
  
    $query = "UPDATE
                " . $this->table_name . "
            SET
                first_name = :first_name,
                last_name = :last_name,
                email = :email,
                birth_date  = :birth_date
            WHERE
                contact_id = :contact_id";
  
    $stmt = $this->conn->prepare($query);
  
    // posted values
    $this->first_name=htmlspecialchars(strip_tags($this->first_name));
    $this->last_name=htmlspecialchars(strip_tags($this->last_name));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->birth_date=htmlspecialchars(strip_tags($this->birth_date));
    $this->contact_id=htmlspecialchars(strip_tags($this->contact_id));
  
    // bind parameters
    $stmt->bindParam(':first_name', $this->first_name);
    $stmt->bindParam(':last_name', $this->last_name);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':birth_date', $this->birth_date);
    $stmt->bindParam(':contact_id', $this->contact_id);
  
    // execute the query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
}
//Delete

// delete the product
function delete(){
  
    $query = "DELETE FROM " . $this->table_name . " WHERE contact_id = ?";
      
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->contact_id);
  
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}

// used for paging contatcs
public function countAll(){
  
    $query = "SELECT contact_id FROM " . $this->table_name . "";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    $num = $stmt->rowCount();
  
    return $num;
}
}
?>