<html>
<!--
File name: SearchProcessor.php
Original Author: Jared Rigdon
Edits made by: Leah Woodworth, Patrick True
Purpose:	Displays the book info that fall within the search criteria
-->
	<style>
		body {background-color:lightblue;}
		h1 {font-style:bold;}
		table{
				border-collapse: collapse;
				width: 75%;
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
<body>
	<!--displays the back button and titles-->
	<div class="a">
			<a href="MainPage.php">Back</a>
		</div>

	<h1 align="center"> The Bookworm Bookstore</h1> <br/>
	<h2 align="center">Your Search Results</h2>

</br></br>
<?php
	//connect to database
	$serverName = "server";
	$userName = "username";
	$password = "password";
	$dbName = "username";
	
	$conn = mysqli_connect($serverName, $userName, $password, $dbName);
	
	if(!$conn){
		die("Connection Failed".mysqli_connect_error());
	}

	$search=$_POST['input1'];	//assigning the user input data
	$criteria=$_POST['select'];	//assigning the user selected criteria
	$min=$_POST['input2'];	//price min
	$max=$_POST['input3'];	//price max
	$pub_min=$_POST['input4'];	//date min
	$pub_max=$_POST['input5'];	//date max

	//defaults the Price and Publish date min and max values if they are empty
	if($min == ""){
		$min = 0;
	}
	if($max == ""){
		$max = 10000000000000;
	}
	if($pub_min == ""){
		$pub_min = '0000-00-00';
	}
	if($pub_max == ""){
		$pub_max = '9999-12-29';
	}

	session_start();

	//uses the passed in values to search via various ways
	//if the user selects search by keyword

	//note:this will always keep the original sql search even if the user goes to the main page and enter new info, this is solved by setting the session sql value to an empty string

	//check if the sql query has been saved to the session before
	if ($_SESSION['sql'] != ""){
	//set the default sorting to ISBN ascending, change if reloaded
		$sql=$_SESSION['sql'];
		if ($_GET['sorting']=='isbn') {
			$sql .=" ORDER BY ISBN";
		}
		elseif ($_GET['sorting']=='title') {
			$sql .=" ORDER BY Title";
		}
		elseif ($_GET['sorting']=='author') {
			$sql .=" ORDER BY Authors";
		}
		elseif ($_GET['sorting']=='date') {
			$sql .=" ORDER BY Publish_Date";
		}
		elseif ($_GET['sorting']=='language') {
			$sql .=" ORDER BY Language";
		}
		elseif ($_GET['sorting']=='price') {
			$sql .=" ORDER BY Price";
		}

		//$results=mysqli_query($conn, $sql);

	}
	else{
		if($criteria=="Word"){
		//search the keywords table
		$sql = "SELECT * FROM books as b WHERE b.ISBN IN(SELECT ISBNk FROM keywords WHERE $criteria LIKE '%$search%') and Price between $min and $max and Publish_Date between '$pub_min' and '$pub_max'";
		//$results=mysqli_query($conn, $sql);
		}
		//seach by subject
		else if($criteria=="Subject"){
			$sql = "SELECT * FROM books as b WHERE b.ISBN IN(SELECT ISBNb FROM subject WHERE $criteria LIKE '%$search%') and Price between $min and $max and Publish_Date between '$pub_min' and '$pub_max'";
			//$results=mysqli_query($conn, $sql);
		}
		//seach by title or authors 
		else{
			$sql = "SELECT * from books where $criteria like '%$search%' and Price between $min and $max and Publish_Date between '$pub_min' and '$pub_max'";
			//$results=mysqli_query($conn, $sql);
		}

		//store the sql into session since this will always execute first

		$_SESSION['sql']=$sql;
	}
	
	
	$results=mysqli_query($conn, $sql);
	//if nothing is returned then show no results
	$num_rows = mysqli_num_rows($results);
	if($num_rows == 0){
		echo "No search results";
		break;
	}

	 mysqli_close($conn);
?>
<!--display the sorting options-->
<table>
	<tr>
		<th colspan="6">Order By:</th>
	</tr>
	<tr>
		<th><a href="SearchProcessor.php?sorting=isbn">ISBN</a></th>
		<th><a href="SearchProcessor.php?sorting=title">Title</a></th>
		<th><a href="SearchProcessor.php?sorting=author">Author</a></th>
		<th><a href="SearchProcessor.php?sorting=date">Publish Date</a></th>
		<th><a href="SearchProcessor.php?sorting=language">Language</a></th>
		<th><a href="SearchProcessor.php?sorting=price">Price</a></th>
	</tr>
</table>
</br></br>
<!--display the search results-->
<table>
	<tr>
		<th>ISBN</th>
		<th>Title</th>
		<th>Author(s)</th>
		<th>Publish Date</th>
		<th>Language</th>
		<th>Price</th>
		<th></th>
		<th></th>
		<th></th>
	</tr>

	<?php while($row1 = mysqli_fetch_assoc($results)):?>
		<tr>
			<td><?php echo $row1['ISBN'];?></td>
			<td><?php echo $row1['Title'];?></td>
			<td><?php echo $row1['Authors'];?></td>
			<td><?php echo $row1["Publish_Date"];?></td>
			<td><?php echo $row1["Language"];?></td>
			<td><?php echo "$".$row1['Price'];?></td>
			<?php echo "<td><a href='BookDetails.php?ISBN=".$row1['ISBN']."'>Book Details</a></td>";?>
			<?php echo "<td><a href='CartProcessor.php?ISBN=".$row1['ISBN']."'>Add to Cart</a></td>";?>
			<?php echo "<td><a href='WishlistProcessor.php?ISBN=".$row1['ISBN']."'>Add to Wishlist</a></td>";?>
		</tr>
	<?php endwhile;?>

</table>

</body>
</html>
