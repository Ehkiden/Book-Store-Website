<?php
/*
File name: SubjectUpdate.php
Original Author: Patrick True
Edits made by: Jared Rigdon
Purpose:	Displays the subject that was requested to be updated into a textbox
*/
	//get the isbn and the subject
	session_start();
	$ISBN_curr=$_SESSION['ISBN_current'];
	if(isset($_GET["Subject"])){
		$Subject_curr=$_GET['Subject'];
	}
	//get the old subject value
	$_SESSION['Subject_old']=$Subject_curr;

	//display the current subject
	$serverName = "delphi.cs.uky.edu"; 
	$userName = "lnwo224";
	$password = "password";
	$dbName = "lnwo224";
	
	$conn = mysqli_connect($serverName, $userName, $password, $dbName);
	
	if(!$conn){
		die("Connection Failed".mysqli_connect_error());
	}

	//used the collected isbn and subject to update
	$sql_sub="SELECT * from subject where ISBNb=$ISBN_curr and Subject='$Subject_curr'";
	$res_sub=mysqli_query($conn, $sql_sub);

	//assign to variables
	while($res=mysqli_fetch_array($res_sub)){
		$ISBN_curr=$res['ISBNb'];
		$Subject_curr=$res['Subject'];
	}

	mysqli_close();

?>

<html>
<head>
	<style>
		    body {background-color:lightblue;}

	</style>
</head>
<body>
	<!--displays the titles and forms to update subject-->
	<h1 align="center"> The Bookworm Bookstore</h1> <br/>
	<h2 align="center"> Manager's Page: Book Subject Update</h2><br/>

	<form action="UpdateSubProccessor.php" method="post">
		<table>
			<tbody>
				<tr>
					<td>ISBN:</td>
					<td><?php echo $ISBN_curr;?></td>
				</tr>
				<tr>
					<td>Subject:</td>
					<td><input type="text" name="Subject" value="<?php echo $Subject_curr?>"></td>
				</tr>
			</tbody>
		</table>

		<input type="submit" value="Update">
	</form>

</body>
</html>