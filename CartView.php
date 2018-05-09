<html>
<!--
File name: CartView.php
Original Author: Jared Rigdon
Purpose:	Displays the users cart details
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
	<!--displays the head titles-->
	<h1 align="center"> The Bookworm Bookstore</h1> <br/>
	<h2 align="center">Your Cart</h2>

	<div class="a">
		<a href="MainPage.php">Back</a>
	</div>

<?php
	//connect to the db
	$serverName = "delphi.cs.uky.edu";
	$username = "lnwo224";
	$password = "password";
	$dbName = "lnwo224";

	$conn = mysqli_connect($serverName, $username, $password, $dbName);

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
	//echo "userid is: ".$userid;

	//query to display all books and quantity ordered
	$sql_cart="SELECT b.ISBN, b.Title, c.Quantity, b.Price FROM books as b, cart as c, users as u WHERE u.UserID='$userid' and b.ISBN=c.ISBNc and c.UserIDc=u.UserID";	//works in manual

	$results=mysqli_query($conn, $sql_cart);
	$num_of_rows = mysqli_num_rows($results);
	if($num_of_rows==0){
		echo "You have nothing in your cart.";
		break;
	}

	mysqli_close($conn);
?>

<!--print out the results in a table format
	could add a delete button but its not required
-->
<table>
	<tr>
		<th>ISBN</th>
		<th>Title</th>
		<th>Quantity Requested</th>
		<th>Price</th>
		<th></th>
	</tr>

	<?php while($row1 = mysqli_fetch_assoc($results)):?>
		<tr>
			<td><?php echo $row1['ISBN'];?></td>
			<td><?php echo $row1['Title'];?></td>
			<td><?php echo $row1['Quantity'];?></td>
			<td><?php echo "$".$row1['Price'];?></td>
			<?php echo "<td><a href='deletebutton.php?ISBNc=".$row1['ISBN']."'>Delete</a></td>";?>
		</tr>
	<?php endwhile;?>

</table>

</br></br></br>
	<!--display the checkout button-->
	<form action="Checkout.php" method="post">
		Ready to check out? <input type="submit" value="Checkout">
	</form>
	
</body>
</html>