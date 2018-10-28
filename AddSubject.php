<html>
<?php
/*
File name: AddKeyword.php
Original Author: Patrick True
Purpose:	Adds the keyword to the keyword table and redirects the current ManagerBookDetails.php
*/
	//connect to db
	$serverName = "server"; 
	$userName = "username";
	$password = "password";
	$dbName = "username";

	//gets the current isbn and passed in subject value
	session_start();
	$ISBN_current = $_SESSION["ISBN_current"];
	$subject = $_POST["subject"];

	$conn = mysqli_connect($serverName, $userName, $password, $dbName);
	if(!$conn)
	{
		die("Connection Failed".mysqli_connect_error());
	}
	
	//query to insert the subject into the db
	$sql = "INSERT INTO subject(ISBNb, Subject) VALUES('$ISBN_current', '$subject')";
	$results=mysqli_query($conn, $sql);

	//redirects
	header("Location: ./ManagerBookDetails.php?ISBN=$ISBN_current");

?>
<html>
