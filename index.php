<?php

// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
  
// set number of records per page
$records_per_page = 100;
  
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
  
// include database and object files
include_once 'config/database.php';
include_once 'objects/contact.php';
include_once 'objects/address.php';
include_once 'objects/phone.php';


// instantiate database and objects
$database = new Database();
$db = $database->getConnection();
  
$contact = new Contact($db);

 $address = new Address($db);
 $phone = new Phone($db);
  
// query contacts
$stmt = $contact->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();

// set page header
$page_title = "Contact Informations";
include_once "header.php";


//Contents Start


if($num>0){
  
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Email</th>";
            echo "<th>Add New</th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
        echo "</tr>";
  
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  
            extract($row);
  
            echo "<tr>";
                echo "<td>{$first_name}</td>";
                echo "<td>{$last_name}</td>";
                echo "<td>{$email}</td>";
                echo "<td>";
                echo "<a href='update_contact.php?contact_id={$contact_id}' class='btn btn-info left-margin'>
                <span class='glyphicon glyphicon-edit'></span> Edit
                </a>";
                echo "</td>";
                echo "<td>";
                echo "<a delete-id='{$contact_id}' class='btn btn-danger delete-object'>
                <span class='glyphicon glyphicon-remove'></span> Delete
                </a>";
                echo "</td>";
              
  
                echo "<td>";
                $address->contact_id = $contact_id;
                $address->readAddress();
                echo $address->full_address;

                echo "<a href='adress_list.php?contact_id={$contact_id}' class='btn btn-info left-margin'>
                <span class='glyphicon glyphicon-edit'></span> Edit Address List
                </a>";
                   
                echo "</td>";
                
                echo "<td>";
                $phone->contact_id = $contact_id;
                $phone->readPhone();
                echo $phone->phone_numbers;
                 echo "<a delete-id='{$contact_id}' class='btn btn-info left-margin'>
                <span class='glyphicon glyphicon-edit'></span> Edit Phone Numbers
                </a>";
                   
                echo "</td>";
  
            echo "</tr>";
  
        }
  
    echo "</table>";
  
    // the page where this paging is used
     $page_url = "index.php?";
  
     // count all contacts in the database to calculate total pages
     $total_rows = $contact->countAll();
  
    // paging buttons here
     include_once 'paging.php';
}
  
// tell the user there are no contacts
else{
    echo "<div class='alert alert-info'>No Contact Info found.</div>";
}


//Contents End

//Set footer
include_once "footer.php";
?>