<html>
<!--
File name: ManagerBookDetails.php
Original Author: Patrick True
Edits made by: Leah Woodworth, Jared Rigdon
Purpose:	Displays the book info into textboxes, displays the keywords and subjects in a table and all the proper edit options to update
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
			<a href="ManagerPage.php">Back</a>
		</div>

	<?php   
	//get the requested book isbn 
	if(isset($_GET['ISBN'])){
		$ISBN = $_GET['ISBN'];
	}
	
	//connect to db
	$serverName = "delphi.cs.uky.edu"; 
	$userName = "lnwo224";
	$password = "password";
	$dbName = "lnwo224";
	
	$conn = mysqli_connect($serverName, $userName, $password, $dbName);
	
	if(!$conn){
		die("Connection Failed".mysqli_connect_error());
	}

	//retrieve the data
	$sql_dets = "SELECT * FROM books WHERE ISBN = $ISBN";
	$details = mysqli_query($conn, $sql_dets);
	
	//pass in the currently used isbn for use of review and cart addition
	session_start();
	$_SESSION["ISBN_current"]=$ISBN;
	
	//assigning the varaibles
	while($res=mysqli_fetch_array($details)){
		$ISBN=$res['ISBN'];
		$Title=$res["Title"];
		$Authors=$res["Authors"];
		$Subject=$res["Subject"];
		$Language=$res["Language"];
		$Publisher=$res["Publisher"];
		$Publish_Date=$res["Publish_Date"];
		$Quantity=$res["Quantity"];
		$Price=$res["Price"];
		$Summary=$res["Summary"];
	}

	mysqli_close($conn);
?>


<body>
	<!--displays the titles, textboxes and form to add new book-->
	<h1 align="center"> The Bookworm Bookstore</h1> <br/>
	<h2 align="center"> Manager's Page: Book Details</h2><br/>

	<form action="ManagerUpdateBookDetails.php"
	method="post">
	<table>
		<tbody>
		<tr>
		<td colspan="2"><h3 allign ="left">ISBN:	<?php echo $ISBN;?></h3></td>
		</tr>
		<tr>
		<td>Author(s):</td>
		<td><input type="text" name="Authors" value="<?php echo $Authors ?>">
		</tr>
		<tr>
		<td>Language:</td>
		<td><input type="text" name="Language" value="<?php echo $Language ?>"></td>
		</tr>
		<tr>
		<td>Title:</td>
		<td><input type="text" name="Title" value="<?php echo $Title ?>"></td>
		</tr>
		<tr>
		<td>Publisher:</td>
		<td><input type="text" name="Publisher" value="<?php echo $Publisher ?>"></td>
		</tr>
		<tr>
		<td>Publish Date:</td>
		<td><input type="text" name="PublishDate" value="<?php echo $Publish_Date ?>"></td>
		</tr>
		<tr>
		<td>Quantity:</td>
		<td><input type="text" name="Quantity" value="<?php echo $Quantity ?>"></td>
		</tr>
		<tr>
		<td>Price:</td>
		<td><input type="text" name="Price" value="<?php echo $Price ?>"></td>
		</tr>
		<td>Summary:</td>
		<td><input type="text" name="Summary" value="<?php echo $Summary ?>"></td>
		</tr>
		</tbody>
		</table>

		<input type="submit" value="Update"><br/><br/><br/>
		</form>

	<!--displays the book info into textboxes-->
	<table>
		<tbody>
			<tr>
			<td colspan="3"><h3 allign ="left">Keywords:</h3></td>
			</tr>

			<?php
			//display the keywords list with an option to update or delete keywords and a textbox at the bottom to add a new keyword
			$serverName = "delphi.cs.uky.edu"; 
			$userName = "lnwo224";
			$password = "password";
			$dbName = "lnwo224";
			
			$conn = mysqli_connect($serverName, $userName, $password, $dbName);
			
			if(!$conn){
				die("Connection Failed".mysqli_connect_error());
			}
			//execute the query for keywords
			$sql_key="SELECT * from keywords where ISBNk=$ISBN";
			$res_key=mysqli_query($conn, $sql_key);

			mysqli_close($conn);

			?>
			<!--displays the update and delete button for keywords-->
			<?php while($row1 = mysqli_fetch_assoc($res_key)):?>
				<tr>
					<td><?php echo $row1['Word'];?></td>
					<?php echo "<td><a href='KeywordUpdate.php?Key=".$row1['Word']."'>Update</a></td>";?>
					<?php echo "<td><a href='deletebutton.php?Key=".$row1['Word']."'>Delete</a></td>";?>
				</tr>
			<?php endwhile;?>
		</tbody>
	</table>

	<!--Display a text box to add keyword-->
	<form action="AddKeyword.php" method="post">
		Add a keyword: <input type="text" name="keyword"> </br>

		<input type="submit" value="Add">

	</form>

	<!--Display the subjects of the book-->
</br></br>
	<table>
		<tbody>
			<tr>
			<td colspan="3"><h3 allign ="left">Subject:</h3></td>
			</tr>

			<?php
			//display the keywords list with an option to update or delete keywords and a textbox at the bottom to add a new keyword
			$serverName = "delphi.cs.uky.edu"; 
			$userName = "lnwo224";
			$password = "password";
			$dbName = "lnwo224";
			
			$conn = mysqli_connect($serverName, $userName, $password, $dbName);
			
			if(!$conn){
				die("Connection Failed".mysqli_connect_error());
			}
			//execute the query to display the book subjects
			$sql_sub="SELECT * from subject as s where s.ISBNb=$ISBN";
			$res_sub=mysqli_query($conn, $sql_sub);
			mysqli_close();
			?>

			<!--displays the update and delete button for keywords-->
			<?php while($row1 = mysqli_fetch_assoc($res_sub)):?>
				<tr>
					<td><?php echo $row1['Subject'];?></td>
					<?php echo "<td><a href='SubjectUpdate.php?Subject=".$row1['Subject']."'>Update</a></td>";?>
					<?php echo "<td><a href='deletebutton.php?Subject=".$row1['Subject']."'>Delete</a></td>";?>
				</tr>
			<?php endwhile;?>
		</tbody>
	</table>

		<!--Display a text box to add a subject-->
	<form action="AddSubject.php" method="post">
		Add a keyword: <input type="text" name="subject"> </br>

		<input type="submit" value="Add">

	</form>
</body>
</html>