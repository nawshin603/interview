<?php
// get ID of the product to be edited
$contact_id = isset($_GET['contact_id']) ? $_GET['contact_id'] : die('ERROR: missing ID.');

// include database and object files
include_once 'config/database.php';
include_once 'objects/contact.php';
include_once 'objects/address.php';
include_once 'objects/phone.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
  // 
// prepare objects
$contact = new Contact($db);

$address = new Address($db);
$phone = new Phone($db);

// set ID property of contact to be edited
$contact->contact_id = $contact_id;

// read the details of contact to be edited
$contact->readOne();


// set page header
$page_title = "Update Contact";
include_once "header.php";


?>
<!-- post code will be here -->

<?php 
// if the form was submitted
if(isset($_POST['update_existing'])){

    // set product property values
	$contact->first_name = $_POST['first_name'];
	$contact->last_name = $_POST['last_name'];
	$contact->email = $_POST['email'];
	$contact->birth_date = $_POST['birth_date'];

    // update the contact
	if($contact->update()){
		echo "<div class='alert alert-success alert-dismissable'>";
		echo "Contact Info was updated.";
		echo "</div>";
	}

    // if unable to update the contact, tell the user
	else{
		echo "<div class='alert alert-danger alert-dismissable'>";
		echo "Unable to update contact info.";
		echo "</div>";
	}
}

if(isset($_POST['create_new'])){

    // set product property values
	$contact->first_name = $_POST['first_name'];
	$contact->last_name = $_POST['last_name'];
	$contact->email = $_POST['email'];
	$contact->birth_date = $_POST['birth_date'];

    // update the contact
	if($contact->create_contact()){
		echo "<div class='alert alert-success alert-dismissable'>";
		echo "Contact Info was created.";
		echo "</div>";
	}

    // if unable to update the contact, tell the user
	else{
		echo "<div class='alert alert-danger alert-dismissable'>";
		echo "Unable to create contact info.";
		echo "</div>";
	}
}
?>

<!-- end post code -->

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?contact_id={$contact_id}");?>" method="post">
	<table class='table table-hover table-responsive table-bordered'>

		<tr>
			<td>First Name</td>
			<td><input type='text' name='first_name' value='<?php echo $contact->first_name; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Last Name</td>
			<td><input type='text' name='last_name' value='<?php echo $contact->last_name; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Birth Date</td>
			<td><input type='date' name='birth_date' value='<?php echo $contact->birth_date; ?>' class='form-control' /></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type='email' name='email' value='<?php echo $contact->email; ?>' class='form-control' /></td>
		</tr>


		<tr>
			<td></td>
			<td>
				<button type="submit" name="create_new" class="btn btn-primary">Create As New</button>
				<button type="submit" name="update_existing" class="btn btn-primary">Update</button>
				<input type="button" value="Back" class="btn btn-info" id="btnHome" 
				onClick="document.location.href='index.php'" />
			</td>


		</tr>


	</table>
</form>


<?php
// set page footer
include_once "footer.php";
?>