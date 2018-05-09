<?php   
/*
File name: BookDetails.php
Original Author: Jared Rigdon
Purpose:	Displays the book info selected from the SearchProcessor.php
			Display the ratings associated with this book
*/

	//set the isbn to be displayed
	//check if we get ISBN from the search processor or from add review processor
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
	//assigning the varaibles
	
	//pass in the currently used isbn for use of review and cart addition
	session_start();
	$_SESSION["ISBN_current"]=$ISBN;

	//assign the values to the variables
	while($res=mysqli_fetch_array($details)){
		$ISBN=$res['ISBN'];
		$Title=$res["Title"];
		$Authors=$res["Authors"];
		$Language=$res["Language"];
		$Publisher=$res["Publisher"];
		$Publish_Date=$res["Publish_Date"];
		$Quantity=$res["Quantity"];
		$Price=$res["Price"];
		$Summary=$res["Summary"];
	}
	//close the connection
	mysqli_close($conn);
?>

<html>
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
		<a href="MainPage.php">Back</a>
	</div>
	<h1 align="center"> The Bookworm Bookstore</h1> <br/>
	<h2 align="center">Book Details</h2>

	<!--Display all the book information-->
	<h3 allign ="left">Title:	<?php echo $Title;?></h3>
	<br/>
	Author(s):	<?php echo $Authors;?></br>
	Subject:	


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

	//query to get the subjects for the book
	$sql_sub="SELECT Subject from subject as s where s.ISBNb=$ISBN";
	$res_sub=mysqli_query($conn, $sql_sub);
	while($res_sub_parse=mysqli_fetch_array($res_sub)){
		echo $Subject=$res_sub_parse['Subject'].", ";
	}
	mysql_close($conn);
?>
	<!--display the book info-->
	</br>
	Language:	<?php echo $Language;?></br></br>
	ISBN:		<?php echo $ISBN;?></br>
	Publisher:	<?php echo $Publisher;?></br>
	Publisher Date:	<?php echo $Publish_Date;?></br></br>
	Quantity:	<?php echo $Quantity;?></br>
	Price:		<?php echo $Price;?></br></br>
	Summary:</br> 	<?php echo $Summary;?>
	</br></br></br></br>

	<?php
	//display the ratings tied to this book
	//connect to db
	$serverName = "delphi.cs.uky.edu"; 
	$userName = "lnwo224";
	$password = "password";
	$dbName = "lnwo224";
	
	$conn = mysqli_connect($serverName, $userName, $password, $dbName);
	
	if(!$conn){
		die("Connection Failed".mysqli_connect_error());
	}

	//get all of the rating info for the current isbn
	$sql="SELECT u.UserName, r.Score, r.Review FROM ratings as r, users as u WHERE r.UserIDr=u.UserID and ISBNr=$ISBN";
	$rate=mysqli_query($conn, $sql);

	mysqli_close($conn);	//close the connection
	?>

	<!--display the table for the ratings-->
	<table>
	<tr>
		<th>Username</th>
		<th>Score</th>
		<th>Review</th>
	</tr>

	<?php while($row1 = mysqli_fetch_assoc($rate)):?>
		<tr>
			<td><?php echo $row1['UserName'];?></td>
			<td><?php echo $row1['Score']."/5";?></td>
			<td><?php echo $row1['Review'];?></td>
		</tr>
	<?php endwhile;?>

</table></br></br>

<!--add in a text box titled review and a drop list of 1 to 5 and the submit button-->
<form action="AddReviewProccessor.php" method="post">
	Score and Write a Review for this Book</br>
	Score:
	<SELECT name="score">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
	</SELECT> 
	<br/>	

	Review:	<input type="text" name="input"> <br/>

	<input type="submit" value="Submit">
</form>


</body>
</html>