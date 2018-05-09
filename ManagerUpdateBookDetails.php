<html>
<?php
/*
File name: ManagerUpdateBookDetails.php
Original Author: Patrick True
Purpose:	Updates the book details with the user input
*/
	//get the current isbn
	session_start();
	$ISBN = $_SESSION["ISBN_current"];
	//connect to db
	$serverName = "delphi.cs.uky.edu"; 
	$userName = "lnwo224";
	$password = "password";
	$dbName = "lnwo224";

	$conn = mysqli_connect($serverName, $userName, $password, $dbName);

	if(!$conn)
	{
		die("Connection Failed".mysqli_connect_error());
	}

	// Get the updated values from POST
	$newTitle = $_POST["Title"];
	$newAuthors = $_POST["Authors"];
	$newLanguage = $_POST["Language"];
	$newPublisher = $_POST["Publisher"];
	$newPublish_Date = $_POST["PublishDate"];
	$newQuantity = $_POST["Quantity"];
	$newPrice = $_POST["Price"];
	$newSummary = $_POST["Summary"];


	// Set the command
	$sql = "UPDATE books SET Title='$newTitle', Authors='$newAuthors', Summary='$newSummary', Language='$newLanguage', Publish_Date='$newPublish_Date', Publisher='$newPublisher', Quantity='$newQuantity', Price='$newPrice' WHERE ISBN = '$ISBN' ";

	// Send the command to the server
	$update_results = mysqli_query($conn, $sql);

	// Close the connection
	mysqli_close($conn);

	// Reload the page
	header("Location: ./ManagerBookDetails.php?ISBN=$ISBN");

	?>
<html>