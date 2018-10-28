<html>
<?php
/*
File name: ManagerUpdateUserDetails.php
Original Author: Patrick True
Edits made by: Jared Rigdon
Purpose:	Updates the user details from the manager input
*/
	//connect to db
	$serverName = "server";
	$userName = "username";
	$password = "password";
	$dbName = "username";
	
	$conn = mysqli_connect($serverName, $userName, $password, $dbName);
	
	if(!$conn){
		die("Connection Failed".mysqli_connect_error());
	}

	//assign the currently looked up userid to a variable
	session_start();
	$UserID_current = $_SESSION["UserID_current"];

	// Variables
	$FName = $_POST["FirstName"];
	$MName = $_POST["MiddleName"];
	$LName = $_POST["LastName"];
	$Email = $_POST["EmailAddress"];
	$Age = $_POST["Age"];
	$Gender = $_POST["Gender"];
	$Manager = $_POST["Manager"];

	// SQL Update command
	$sql = "UPDATE users Set Manager='$Manager', Fname='$FName', Mname='$MName', Lname='$LName', Email='$Email', Age='$Age', Gender='$Gender' WHERE UserID = $UserID_current";

	// Send the command	
	if (mysqli_query($conn,$sql))
	{
		// Disconnect from the DB
		mysqli_close($conn);
		// Once the insert is successful, reload the page.	
		header("Location: ./ManagerUserDetails.php?UserID=$UserID_current");
	}
	else{
		echo " didnt update";
	}
?>

</html>
