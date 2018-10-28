<html>
<style>
    body {background-color:lightblue;}
</style>
<body>
<?php
/*
File name: ManagerUsersPageProcessor.php
Original Author: Patrick True
Edits made by: Jared Rigdon
Purpose:	Adds a new user to the db based on the manager input
*/
	// DB connection info:
	$serverName = "server";
	$userName = "username";
	$password = "password";
	$dbName = "username";

	// Connect to DB
	$conn = mysqli_connect($serverName, $userName, $password, $dbName);
	
	if(!$conn)
	{
		die("Connection Failed".mysqli_connect_error());
	}
	
	// verify the user is logged in before this is executed
	// collect the username
	session_start();
	$username = $_SESSION["username"];
	
	// Variables
	$FName = $_POST["FName"];
	$MName = $_POST["MName"];
	$LName = $_POST["LName"];
	$Email = $_POST["Email"];
	$Password = $_POST["Password"];
	$Age = $_POST["Age"];
	$Gender = $_POST["Gender"];
	$UserName = $_POST["UserName"];
	$Manager = $_POST["Manager"];

	// SQL insert command
	$sql = "INSERT INTO users(Manager, Fname, Mname, Lname, Email, Password, Age, Gender, UserName) VALUES ('$Manager', '$FName', '$MName', '$LName', '$Email', '$Password', '$Age', '$Gender', '$UserName')";
	
	// Send the command	
	if (mysqli_query($conn,$sql))
	{
		// Disconnect from the DB
		mysqli_close($conn);
		// Once the insert is successful, reload the page.	
		header("Location: ./ManagerUsersPage.php");
	}
?>

</body>
</html>
