<html>
<body>
<?php 
/*
File name: UpdateSubProcessor.php
Original Author: Patrick True
Edits made by: Jared Rigdon
Purpose:	Updates the subject for the current isbn
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

	//get the current isbn and subject
	session_start();
	$ISBN=$_SESSION['ISBN_current'];
	$Subject_old=$_SESSION['Subject_old'];
	$Subject=$_POST['Subject'];

	//update the subject
	$sql_sub="UPDATE subject SET Subject='$Subject' WHERE ISBNb=$ISBN and Subject='$Subject_old'";

	//redirect the to book details page
	if(mysqli_query($conn, $sql_sub)){
		header("Location: ./ManagerBookDetails.php?ISBN=$ISBN");
	}
	//close the db
	myqli_close($conn);

?>
</body>
</html>
