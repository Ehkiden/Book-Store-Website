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

	//get the current isbn and the passed in keyword
	session_start();
	$ISBN_current = $_SESSION["ISBN_current"];
	$keyword = $_POST["keyword"];

	$conn = mysqli_connect($serverName, $userName, $password, $dbName);
	if(!$conn)
	{
		die("Connection Failed".mysqli_connect_error());
	}
	
	//query to insert the keyword into the db
	$sql = "INSERT INTO keywords(ISBNk, Word) VALUES('$ISBN_current', '$keyword')";
	$results=mysqli_query($conn, $sql);

	//redirect
	header("Location: ./ManagerBookDetails.php?ISBN=$ISBN_current");

?>
<html>
