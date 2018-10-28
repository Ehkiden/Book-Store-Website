<html>
<!--
File name: ManagerPageProcessor.php
Original Author: Patrick True
Edits made by: Jared Rigdon
Purpose:	Adds the new book to the db
-->
<style>
    body {background-color:lightblue;}
</style>
<body>
<?php

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
	$Title=$_POST["Title"];
	$Authors=$_POST["Authors"];
	$Summary=$_POST["Summary"];
	$Language=$_POST["Language"];
	$Publish_Date=$_POST["PublishDate"];
	$Publisher=$_POST["Publisher"];
	$Quantity=$_POST["Quantity"];
	$Price=$_POST["Price"];

	// SQL insert command
	$sql = "INSERT INTO books(Title, Authors, Summary, Language, Publish_Date, Publisher, Quantity, Price) VALUES ('$Title', '$Authors', '$Summary', '$Language', '$Publish_Date', '$Publisher', '$Quantity', '$Price')";
	
	// Send the command	
	if (mysqli_query($conn,$sql))
	{
		// Disconnect from the DB
		mysqli_close($conn);
		// Once the insert is successful, reload the page.	
		header("Location: ./ManagerPage.php");
	}
?>

</body>
</html>
