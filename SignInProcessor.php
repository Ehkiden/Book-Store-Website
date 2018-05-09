<html>
<!--
File name: SignInProcessor.php
Original Author: Leah Woodworth
Edits made by: Patrick True
Purpose:	Check if the user submitted data is correct
			if so, then save the username to a session and redirect to the MainPage.php
			If not, then redisplay the forms from SignIn.html with an error message until satisfied
-->
  <style>
    body {background-color:lightblue;}
    h1 {font-style:bold;}
  </style>
	
	<body>
	<center>
	<!--display the sign in form and title-->
	<form action="SignInProcessor.php"
	method="post">
    
	<h1 align="center"> Welcome to The Bookworm Bookstore.</h1> <br/>
	

		<table>
			<tbody>
			<tr>
			<td colspan="2">Please log in to continue</td>
			</tr>
			<tr>
			<td>Username:</td>
			<td><input type="text" name="username"></td>
			</tr>
			<tr>
			<td>Password:</td>
			<td><input type="password" name="password"></td>
			</tr>
			</tbody>
		</table>

		<input type="submit" value="Log In"><br/>


	</form>

	<?php
	//connect to the database
	$serverName = "delphi.cs.uky.edu"; 
	$userName = "lnwo224";
	$password = "password";
	$dbName = "lnwo224";
	
	$conn = mysqli_connect($serverName, $userName, $password, $dbName);
	if(!$conn){
		die("Connection Failed".mysqli_connect_error());
	}
	//start the session to save the username
	session_start();

	//assign the variables the passed in values
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	//query to check if the user submitted username and password is correct
	$sql = "SELECT UserName, Password FROM users WHERE UserName='$username'";
	$results = mysqli_query($conn, $sql);

	if(mysqli_num_rows($results)>0){
		while($row = mysqli_fetch_assoc($results)){
			$dbUserName = $row["UserName"];
			$dbPassword = $row["Password"];
		}
	}

	//assign the current username to the session, this overrides each time a new user is signed in
	$_SESSION["username"]= $dbUserName;
	//if the username and password are empty or do not match then return an error message
	if ($username=="" && $password=="")
	{
		echo '<p style="color:Red;"> Incorrect Username or password.</p>';
	}
	//if the username and password match, then redirect to the MainPage.php
	else if($username==$dbUserName && $password==$dbPassword){
		header('Location:./MainPage.php');
	}	
	else
	{
		echo '<p style="color:Red;"> Incorrect Username or password.</p>';
	}
	//close the connection
	mysqli_close($conn);
	?>
	<!--display the new user form-->
	<form action="RegisterPage.html"
	method="post">

			<input type="submit" value="New User"><br/>

	</form>
	</center>
	</body>
</html>

