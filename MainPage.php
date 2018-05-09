<?php
//this snippet of code is to ensure that each time a new search is made, the session sql query will be set back to empty string
session_start();
$_SESSION['sql']="";
?>
<html>
<!--
File name: MainPage.php
Original Author: Leah Woodworth
Edits made by: Patrick True, Jared Rigdon
Purpose:	Display the logout, order history, wishlist, cart, search critea buttons
			Only displays the manager button if the user is the manager
-->
<style>
    body {background-color:lightblue;}

    div.a {
    	text-align: center;
    }
    div.b {
    	position: absolute;
    	top: 10px;
    	left: 10px;
    }
    div.c {
    	position: absolute;
    	top: 500px;
    	left: 10px;
    }
    div.d {
    	position: absolute;
    	top: 500px;
    	right: 10px;
    }
    div.e {
    	position: absolute;
    	top: 10px;
    	right: 10px;
    }
    div.f {
    	position: absolute;
    	top: 500px;
    	right: 75px;
    }
</style>

<body>


	<h1 align="center"> The Bookworm Bookstore</h1> <br/>

	<br/><br/><br/><br/>
	<div class="a">
	<!-- displays the search criteria form-->
	<form action="SearchProcessor.php" method="post"> 
	
	Search by
	
	<SELECT name="select">
		<option value="Title">Title</option>
		<option value="Authors">Author</option>
		<option value="Subject">Subject</option>
		<option value="Word">Keyword</option>
	</SELECT> 
	<br/>	


	Search Criteria <input type="text" name="input1"> <br/><br/>

	AND/OR <br/><br/>

	Price Range (in dollars)<br/>
	Min <input type="text" name="input2"> Max <input type="text" name="input3"> <br/><br/>

	AND/OR<br/><br/>

	Publish Date (YYYY-MM-DD)<br/>
	Min <input type="text" name="input4"> Max <input type="text" name="input5"> <br/><br/>
	<input type="submit" value="Search"><br/> 
		</form>
	</div>

	<!--Displays the Log out, order history, and cart button-->
	<div class ="b">
		<form action="SignIn.html" method="post">
			<input type="submit" value="Log Out">
		</form>
	</div>

	<div class="c">
		<form action="OrderHistoryProcessor.php" method="post">
				<input type="submit" value="View Order History">
		</form>
	</div>

	<div class="d">
		<form action="CartView.php" method="post">
			<input type="submit" value="Cart">
		</form>
	</div>

	<?php

	//connect to db
	$serverName = "delphi.cs.uky.edu"; 
	$userName = "lnwo224";
	$password = "password";
	$dbName = "lnwo224";
	
	$conn = mysqli_connect($serverName, $userName, $password, $dbName);
	
	if(!$conn){
		die("Connection Failed".mysqli_connect_error());
	}
	
	//verify the user is logged in before this is executed
	//collect the username
	session_start();
	$username = $_SESSION["username"];
	//query to see if the user is a manager
	$sql = "SELECT Manager FROM users WHERE UserName ='$username'";
	$results = mysqli_query($conn, $sql);

	if(mysqli_num_rows($results)>0)
	{
		while($row = mysqli_fetch_assoc($results))
		{
			$dbmanagerflag = $row["Manager"];
		}
	}

	//if the user is a manager then display the manager button
	if($dbmanagerflag == 1) 
	{ 
	?>
		<div class="e">
			<form action="ManagerPage.php" method="post">
				<input type="submit" value="Manager">
			</form>
		</div>
	<?php
	 }
	 mysqli_close($conn);	//close db
	?>
	<!--displays the wishlist button-->
	<div class="f">
			<form action="WishlistPage.php" method="post">
				<input type="submit" value="WishList">
			</form>
		</div>


</body>
</html>