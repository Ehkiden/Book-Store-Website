<html>
<!--
File name: ManagerUserPage.php
Original Author: Patrick True
Edits made by: Jared Rigdon
Purpose:	Displays the textboxes and button to add new user
			Displays all the users in the db except the sysadmin and the current manager that is logged in
-->
<style>
    body {background-color:lightblue;}
    div.a{
			position: absolute;
    		top: 10px;
    		left: 10px;
		}
</style>
	<!--displays the titles and the form to add user-->
	<body>
		<div class="a">
			<a href="ManagerPage.php">Back</a>
		</div>

		<h1 align="center"> The Bookworm Bookstore</h1> <br/>
		<h2 align="center"> Manager's Page: User Management</h2><br/>
		<h3> Add a new user:</h3>

		<form action="ManagerUsersPageProcessor.php"
		method="post">
		
			<table>
				<tbody>
				<tr>
					<th>First Name</th>
					<th>Middle Name</th>
					<th>Last Name</th>
					<th>E-Mail Address</th>
					<th>Password</th>
					<th>Age</th>
					<th>Gender</th>
					<th>User Name</th>
					<th>Manager?</th>
					<th></th>

				</tr>
				<td><input type="text" name="FName"></td>
				<td><input type="text" name="MName"></td>
				<td><input type="text" name="LName"></td>
				<td><input type="text" name="Email"></td>
				<td><input type="text" name="Password"></td>
				<td><input type="text" name="Age"></td>
				<td><input type="text" name="Gender"></td>
				<td><input type="text" name="UserName"></td>
				<td><input type="text" name="Manager"></td>
				<td><input type="submit" value="Add User"></td>
				</tbody>
			</table>
		</form>
		<br/><br/>
		<h3> Current Users:</h3>

		<?php

		session_start();
		//connects to the db
		$serverName = "server";
		$userName = "username";
		$password = "password";
		$dbName = "username";
		
		$conn = mysqli_connect($serverName, $userName, $password, $dbName);
		
		if(!$conn)
		{
			die("Connection Failed".mysqli_connect_error());
		}

		$username = $_SESSION["username"];
		//get the current UserID
		$sql_user="SELECT UserID from users where UserName='$username'";
		$userid_r=mysqli_query($conn, $sql_user);
		while($res=mysqli_fetch_array($userid_r)){
		$userid=$res['UserID'];
		}
		//make sure not to show the user details of the currently logged in user as to prevent them from being able to delete themselves and so on
		//also do not show the user details of the sysadmin as they should never have thier info changed
		$sql = "SELECT * FROM users where UserID != $userid and UserName != 'sysadmin'";
		$results = mysqli_query($conn, $sql);

		?>

		<!--displays the details and delete links for each user-->
		<table>
		<?php while($row1 = mysqli_fetch_assoc($results)):?>
		<tr>
			<td> 
			User: 
			<?php echo $row1['Fname'];
				  echo " ";
				  echo $row1['Lname'];?><br/>
			UserID: 
			<?php echo $row1['UserID'];?><br/><br/>
				<?php echo "<td><a href='ManagerUserDetails.php?UserID=".$row1['UserID']."'>User Details</a></td>";?>
				<?php echo "<td><a href='deletebutton.php?UserID=".$row1['UserID']."'>Delete</a></td>";?>
			</td>
		</tr>
		<?php endwhile;?>
	</body>
	</html>
