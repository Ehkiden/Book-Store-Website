<html>
<body>
<?php 
/*
File name: UpdateKeyProcessor.php
Original Author: Patrick True
Purpose:	Updates the keyword for the current ISBN
*/
	//connect to db
	$serverName = "delphi.cs.uky.edu"; 
	$userName = "lnwo224";
	$password = "password";
	$dbName = "lnwo224";
	
	$conn = mysqli_connect($serverName, $userName, $password, $dbName);
	
	if(!$conn){
		die("Connection Failed".mysqli_connect_error());
	}

	
	session_start();
	$ISBN=$_SESSION['ISBN_current'];
	$Word_old=$_SESSION['Word_old'];
	//get the current isbn and keyword
	$Word=$_POST['Keyword'];
	
	//update the keyword
	$sql_key="UPDATE keywords SET Word='$Word' WHERE ISBNk=$ISBN and Word='$Word_old'";

	//redirect the to book details page
	if(mysqli_query($conn, $sql_key)){
		header("Location: ./ManagerBookDetails.php?ISBN=$ISBN");
	}

	//close the db
	myqli_close($conn);

?>
</body>
</html>