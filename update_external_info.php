<?php
$flag = isset($_GET['flag']) ? $_GET['flag'] : die('ERROR: missing ID.');
$location_id = isset($_GET['location_id']) ? $_GET['location_id'] : die('ERROR: missing ID.');

if($flag == 'address')
{
 
include_once 'config/database.php';
include_once 'objects/contact.php';
include_once 'objects/address.php';
include_once 'objects/phone.php';

// get database connection
$database = new Database();
$db = $database->getConnection();


$address = new Address($db);


// set ID property of contact to be edited
$address->location_id = $location_id;

// read the details of contact to be edited
$address->readLocation();


// set page header
$page_title = "Update Address";
include_once "header.php";
 ?>

 <!-- end post code -->

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?location_id={$location_id}");?>" method="post">
	<table class='table table-hover table-responsive table-bordered'>

		<tr>
			<td>Location Type</td>
			<td><input type='text' name='location_type' value='<?php echo $address->location_type; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Street</td>
			<td><input type='text' name='street' value='<?php echo $address->street; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Country</td>
			<td><input type='date' name='country' value='<?php echo $address->country; ?>' class='form-control' /></td>
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

<?
include_once "footer.php";
}
 ?>