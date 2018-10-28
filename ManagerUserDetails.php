<html>
<!--
File name: ManagerUserDetails.php
Original Author: Patrick True
Edits made by: Jared Rigdon
Purpose:	Displays the textboxes and button to update the user details and make the user a manager or not
-->
<head>
	<style>
		body {background-color:lightblue;}
		table{
				border-collapse: collapse;
				width: 50%;
			}
			td, th{
				border: 1px solid black;
				text-align: left;
				padding: 8px;
			}
			tr:nth-child(even){
				background-color: #76bdd5;	
			}
			div.a{
			position: absolute;
    		top: 10px;
    		left: 10px;
			}
	</style>	
</head>
	<body>
		<div class="a">
			<a href="ManagerUsersPage.php">Back</a>
		</div>
	</body>
	<?php  

	//assign the current user being looked up
	if(isset($_GET['UserID'])){
		$UserID = $_GET['UserID'];
	}
	
	//assign the current UserID being looked up into a custom session
	//this will also overide itself when looking up a different user
	session_start();
	$_SESSION["UserID_current"]=$UserID;

	//connect to db
	$serverName = "server";
	$userName = "username";
	$password = "password";
	$dbName = "username";
	
	$conn = mysqli_connect($serverName, $userName, $password, $dbName);
	
	if(!$conn){
		die("Connection Failed".mysqli_connect_error());
	}

	//retrieve the data for the user requested
	$sql_dets = "SELECT * FROM users WHERE UserID = $UserID";
	$details = mysqli_query($conn, $sql_dets);

	//assigning the varaibles
		while($res=mysqli_fetch_array($details))
	{
		$UserID = $res["UserID"];
		$FName = $res["Fname"];
		$MName = $res["Mname"];
		$LName = $res["Lname"];
		$EMail = $res["Email"];
		$Age = $res["Age"];
		$Gender = $res["Gender"];
		$UserName = $res["UserName"];
		$Manager = $res["Manager"];
	}

	mysqli_close($conn);
?>


<body>
	<h1 align="center"> The Bookworm Bookstore</h1> <br/>
	<h2 align="center"> Manager's Page: User Details</h2><br/>

	<!--display the user details-->
	<form action="ManagerUpdateUserDetails.php"
	method="post">
	<table>
		<tbody>
		<tr>
		<td colspan="2"><h3 allign ="left">UserID:	<?php echo $UserID;?><br/> UserName: <?php echo $UserName;?></h3></td>
		</tr>
		<tr>
		<td>First Name:</td>
		<td><input type="text" name="FirstName" value="<?php echo $FName ?>">
		</tr>
		<tr>
		<td>Middle Name:</td>
		<td><input type="text" name="MiddleName" value="<?php echo $MName ?>"></td>
		</tr>
		<tr>
		<td>Last Name:</td>
		<td><input type="text" name="LastName" value="<?php echo $LName ?>"></td>
		</tr>
		<tr>
		<td>E-Mail Address:</td>
		<td><input type="text" name="EmailAddress" value="<?php echo $EMail ?>"></td>
		</tr>
		<tr>
		<td>Age:</td>
		<td><input type="text" name="Age" value="<?php echo $Age ?>"></td>
		</tr>
		<tr>
		<td>Gender:</td>
		<td><input type="text" name="Gender" value="<?php echo $Gender ?>"></td>
		</tr>
		<tr>
		<td>Manager:</td>
		<td><input type="text" name="Manager" value="<?php echo $Manager ?>"></td>
		</tr>
		</tbody>
		</table>

		<input type="submit" value="Update"><br/><br/><br/>
		</form>

		</br></br>


</body>
</html>
