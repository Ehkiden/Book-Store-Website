<?php
	//get the isbn and the keyword
	session_start();
	$ISBN_curr=$_SESSION['ISBN_current'];
	if(isset($_GET["Key"])){
		$Word_curr=$_GET['Key'];
	}
	//display the current keyword
	$serverName = "server";
	$userName = "username";
	$password = "password";
	$dbName = "username";
	
	$_SESSION['Word_old']=$Word_curr;

	$conn = mysqli_connect($serverName, $userName, $password, $dbName);
	
	if(!$conn){
		die("Connection Failed".mysqli_connect_error());
	}

	//used the collected isbn and keyword to update
	$sql_key="SELECT * from keywords where ISBNk=$ISBN_curr and Word='$Word_curr'";
	$res_key=mysqli_query($conn, $sql_key);

	//assign to variables
	while($res=mysqli_fetch_array($res_key)){
		$ISBN_curr=$res['ISBNk'];
		$Word_curr=$res['Word'];
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

	<h1 align="center"> The Bookworm Bookstore</h1> <br/>
	<h2 align="center"> Manager's Page: Book Keyword Update</h2><br/>

	<form action="UpdateKeyProccessor.php" method="post">
		<table>
			<tbody>
				<tr>
					<td>ISBN:</td>
					<td><?php echo $ISBN_curr;?></td>
				</tr>
				<tr>
					<td>Keyword:</td>
					<td><input type="text" name="Keyword" value="<?php echo $Word_curr;?>"></td>
				</tr>
			</tbody>
		</table>

		<input type="submit" value="Update">
	</form>

</body>
</html>
