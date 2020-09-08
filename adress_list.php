<?php
$contact_id = isset($_GET['contact_id']) ? $_GET['contact_id'] : die('ERROR: missing ID.');
include_once 'config/database.php';
include_once 'objects/contact.php';
include_once 'objects/address.php';
include_once 'objects/phone.php';
$page_title = "Adress Informations";
include_once 'header.php';



// instantiate database and objects
$database = new Database();
$db = $database->getConnection();
$address = new Address($db);
$address->contact_id = $contact_id;
$stmt = $address->readOne();
$num = $stmt->rowCount();

if($num>0){
  
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Location Type</th>";
            echo "<th>Street</th>";
            echo "<th>Country</th>";
             echo "<th>Add New</th>";
              echo "<th></th>";
           
        echo "</tr>";
  
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  
            extract($row);
  
            echo "<tr>";
                echo "<td>{$location_type}</td>";
                echo "<td>{$street}</td>";
                echo "<td>{$country}</td>";
                  echo "<td>";
                echo "<a href='update_external_info.php?location_id={$location_id}&flag=address' class='btn btn-info left-margin'>
                <span class='glyphicon glyphicon-edit'></span> Edit
                </a>";
                echo "</td>";
                echo "<td>";
                echo "<a delete-id='{$location_id}' class='btn btn-danger delete-object'>
                <span class='glyphicon glyphicon-remove'></span> Delete
                </a>";
                echo "</td>";
                echo "</tr>";
  
        }
  
    echo "</table>";
  

}else{
	 echo "<div class='alert alert-info'>No Address Info found.</div>";
}
?>