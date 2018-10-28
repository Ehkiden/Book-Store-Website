<html>
<body>
<?php
/*
File name: WishlistProcessor.php
Original Author: Jared Rigdon
Purpose:	Adds the requested book to the wishlist table in the db and redirects them to the wishlist page
*/
	if(isset($_GET['ISBN'])){
		$ISBN = $_GET['ISBN'];
	}
	//connect to db
	$serverName = "server";
	$userName = "username";
	$password = "password";
	$dbName = "username";
	
	$conn = mysqli_connect($serverName, $userName, $password, $dbName);
	
	if(!$conn){
		die("Connection Failed".mysqli_connect_error());
	}
	session_start();
	$username = $_SESSION["username"];

	//get the current UserID
	$sql_user="SELECT UserID from users where UserName='$username'";
	$userid_r=mysqli_query($conn, $sql_user);
	while($res=mysqli_fetch_array($userid_r)){
		$userid=$res['UserID'];
	}

	//check if the isbn is already in the wishlist, if so then do nothing
	$sql_check="SELECT ISBNw from wishlist where UserIDw=$userid and ISBNw=$ISBN";
	$res_check=mysqli_query($conn, $sql_check);
	$num_rows=mysqli_num_rows($res_check);
	echo"Rows: ".$num_rows;
	if ($num_rows == 0) {
		//add the current item into the wish list
		$sql_wish="INSERT INTO wishlist(UserIDw,ISBNw) VALUES($userid,$ISBN)";
		if(mysqli_query($conn, $sql_wish)){
			header("Location: ./WishlistPage.php");
		}

	}
	else{
		header("Location: ./WishlistPage.php");

	}

	mysqli_close($conn);
?>

</body>
</html>
