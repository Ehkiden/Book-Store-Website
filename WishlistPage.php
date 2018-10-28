<html>
<!--
File name: WishlistPage.php
Original Author: Jared Rigdon
Purpose:	Displays the wish list of the users desired books
-->
<head>
	<style>
	    body {background-color:lightblue;}
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
</head>
<body>
	<!--displays the titles-->
	<h1 align="center"> The Bookworm Bookstore</h1> <br/>
	<h2 align="center">Your Wish List</h2>
 	
 	<div class="a">
		<a href="MainPage.php">Back</a>
	</div>
<?php
	//connect to db
	$serverName = "server";
	$userName = "username";
	$password = "password";
	$dbName = "username";
	
	$conn = mysqli_connect($serverName, $userName, $password, $dbName);
	
	if(!$conn){
		die("Connection Failed".mysqli_connect_error());
	}

	session_start();
	$username = $_SESSION["username"];
	//get the current UserID
	$sql_user="SELECT UserID from users where UserName='$username'";
	$userid_r=mysqli_query($conn, $sql_user);
	while($res=mysqli_fetch_array($userid_r)){
		$userid=$res['UserID'];
	}

	//including the isbn from wishlist to pass into the delet button
	$sql_wish="SELECT b.ISBN, b.Title, b.Summary, b.Quantity, b.Price FROM books as b, wishlist as w, users as u WHERE u.UserID='$userid' and b.ISBN=w.ISBNw and w.UserIDw=u.UserID";
	$results=mysqli_query($conn, $sql_wish);
	
	//display a message if the wishlist table is empty
	$num_of_rows = mysqli_num_rows($results);
	if($num_of_rows==0){
		echo "You have nothing in your cart.";
		break;
	}

	mysqli_close($conn);
?>

<!--displays all the book details in the db-->
<table>
	<tr>
		<th>ISBN</th>
		<th>Title</th>
		<th>Summary</th>
		<th>Quantity</th>
		<th>Price</th>
		<th></th>
		<th></th>
	</tr>

	<?php while($row1 = mysqli_fetch_assoc($results)):?>
		<tr>
			<td><?php echo $row1['ISBN'];?></td>
			<td><?php echo $row1['Title'];?></td>
			<td><?php echo $row1['Summary'];?></td>
			<td><?php echo $row1['Quantity'];?></td>
			<td><?php echo "$".$row1['Price'];?></td>
			<?php echo "<td><a href='CartProcessor.php?ISBN=".$row1['ISBN']."'>Add to Cart</a></td>";?>
			<?php echo "<td><a href='deletebutton.php?ISBNw=".$row1['ISBN']."'>Delete</a></td>";?>
		</tr>
	<?php endwhile;?>

</table>


</body>
</html>
