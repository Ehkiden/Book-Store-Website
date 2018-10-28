<html>
<body>
<?php
/*
File name: AddReviewProcessor.php
Original Author: Jared Rigdon
Purpose:	Adds the user submitted data to the ratings table in the database and then redirects the page back to the current BookDetails page
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
	
	//verify the user is logged in before this is executed
	//collect the username
	session_start();
	$username = $_SESSION["username"];

	//get the current UserID
	$sql_user="SELECT UserID from users where UserName='$username'";
	$userid_r=mysqli_query($conn, $sql_user);
	while($res=mysqli_fetch_array($userid_r)){
		$userid=$res['UserID'];
	}
	
	//pass in the variables
	$ISBN=$_SESSION["ISBN_current"];
	$score=$_POST['score'];
	$review=$_POST['input'];

	//add in the new review
	$sql3= "INSERT INTO ratings(ISBNr,UserIDr,Review,Score) VALUES($ISBN,$userid,'$review',$score)";	//this works now for some reason
	
	//this will basically reload the page
	if (mysqli_query($conn,$sql3)){
		header("Location: ./BookDetails.php?ISBN=$ISBN");
	}

	mysqli_close($conn);	//close db
?>
</body>
</html>
