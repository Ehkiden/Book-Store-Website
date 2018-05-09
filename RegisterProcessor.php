<html>
<!--
File name: RegisterProcessor.php
Original Author: Patrick True
Edits made by: Leah Woodworth, Jared Rigdon
Purpose:	After the user clicks submit on the RegisterPage.html, this program will check if the all the fields where enter correctly
			If so, then add new user into database and redirect to the SignIn.html
			If not, display an error message and redisplay the text fields until requirements are met
-->

  <style>
    body {background-color:lightblue;}
    h1 {font-style:bold;}
    div.a{
			position: absolute;
    		top: 10px;
    		left: 10px;
		}
  </style>
	<!--displays the back button to go back the sign in page-->
	<body>
		<div class="a">
		<a href="SignIn.html">Back</a>
		</div>
	
	<!--displays the title and textboxes-->
	<center>
		<h1 align="center"> The Bookworm Bookstore</h1> <br/>
	
	<form action="RegisterProcessor.php"
	method="post">

		<table>
		<tbody>
		<tr>
		<td colspan="2">Please enter the following information:</td>
		</tr>
		<tr>
		<td>First Name:</td>
		<td><input type="text" name="FName"></td>
		</tr>
		<tr>
		<td>Middle Name:</td>
		<td><input type="text" name="MName"></td>
		</tr>
		<tr>
		<td>Last Name:</td>
		<td><input type="text" name="LName"></td>
		</tr>
		<tr>
		<td>E-Mail Address:</td>
		<td><input type="text" name="Email"></td>
		</tr>
		<tr>
		<td>Password:</td>
		<td><input type="password" name="Password"></td>
		</tr>
		<tr>
		<td>Age:</td>
		<td><input type="text" name="Age"></td>
		</tr>
		<tr>
		<td>Gender:</td>
		<td><input type="text" name="Gender"></td>
		</tr>
		<tr>
		<td>User Name:</td>
		<td><input type="text" name="UName"></td>
		</tr>
		</tbody>
		</table>

		<input type="submit" value="Create Account">
		
		</form>

		<?php
		//assigns variables values passed in from the RegisterPage.html
		$FName = $_POST["FName"];
		$MName = $_POST["MName"];
		$LName = $_POST["LName"];
		$Email = $_POST["Email"];
		$Password = $_POST["Password"];
		$Age = (int)$_POST["Age"];
		$Gender = $_POST["Gender"];
		$UName = $_POST["UName"];
		
		//connects to database
		$serverName = "delphi.cs.uky.edu"; 
		$userName = "lnwo224";
		$password = "password";
		$dbName = "lnwo224";
	
		$conn = mysqli_connect($serverName, $userName, $password, $dbName);
		if(!$conn)
		{
			die("Connection Failed".mysqli_connect_error());
		}
		
		//query to check if the username already exsits
		$sql = "SELECT UserName FROM users";
		$results = mysqli_query($conn, $sql);
		$flag = 0;
		while($row = mysqli_fetch_assoc($results))
		{
			$db_username = $row["UserName"];
			if($UName == $db_username){
				$flag = 1;	//sets the flag to if the user name does exists already
				break;
			}
		}

		if($FName != "" && $MName != "" && $LName != "" && $Email != "" && $Password != "" && $Age != "" && $Gender != "" && $UName != ""){
			//displays an error message if the username already exists
			if($flag==1)
			{
				echo "<p style='color:Red;'>That username is already taken.</p>";
			}
			else{
				//query to insert all the user submitted data into the database
				$sql = "INSERT INTO users(Manager, Fname, Mname, Lname, Email, Password, Age, Gender, UserName) VALUES (0, '$FName', '$MName', '$LName', '$Email', '$Password', '$Age', '$Gender', '$UName')";
				//if successful then redirect to SignIn.html
				if (mysqli_query($conn, $sql)) 
				{
		   			header('Location:./SignIn.html');
				}
			}
		}
		//if any field is left empty then display an error message
		else
		{
			echo "<p style='color:Red;'>All fields are required.</p>";
		}
		//close the connection
		$conn->close();
		?>
	</center>
	</body>
</html>