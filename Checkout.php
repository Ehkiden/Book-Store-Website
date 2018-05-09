<html>
<!--
File name: Checkout.php
Original Author: Jared Rigdon
Purpose:	Displays the checkout details and textboxes for the required user input
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
	<!--displays the titles and buttons-->
	<div class="a">
		<a href="MainPage.php">Back</a>
	</div>

	<h1 align="center"> The Bookworm Bookstore</h1> <br/>
	<h2 align="center">Check Out</h2>

</br></br>
Listed below is your books that you plan to order.
</br></br>

	<?php
	//display the order details, then display a check out option below and use another php function to compute and display a thank you message
	//autofill the options that can be filled
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

	//query to display all books and quantity ordered
	$sql_cart="SELECT b.ISBN, b.Title, c.Quantity, b.Price FROM books as b, cart as c, users as u WHERE u.UserID=$userid and c.UserIDc=u.UserID and b.ISBN=c.ISBNc";

	$results=mysqli_query($conn, $sql_cart);

	mysqli_close($conn);
	?>
	
<!--displays the book details-->	
<table>
	<tr>
		<th>ISBN</th>
		<th>Title</th>
		<th>Quantity Requested</th>
		<th>Price</th>
	</tr>

	<?php while($row1 = mysqli_fetch_assoc($results)):?>
		<tr>
			<td><?php echo $row1['ISBN'];?></td>
			<td><?php echo $row1['Title'];?></td>
			<td><?php echo $row1['Quantity'];?></td>
			<td><?php echo "$".$row1['Price'];?></td>
		</tr>
	<?php endwhile;?>
</table>

</br>

	<!--the CheckoutComplete.php file will place the proper info into order history and delete the correct amount from quantity-->
	</br>
	<form action="CheckoutComplete.php" method="post">

		<table>
			<tbody>
			<tr>
				<td colspan="2">Please enter the following information:</td>
			</tr>
			<tr>
			<td>Billing Adress:</td>
			<td><input type="text" name="Billing"></td>
			</tr>
			<tr>
				<td>Shipping Address:</td>
				<td><input type="text" name="Street"></td>
			</tr>
			<tr>
				<td>Card Number:</td>
				<td><input type="text" name="Card"></td>
			</tr>
			</tbody>
		</table>
		Ready to Check Out? 
		<input type="submit" value="Checkout">
	
	</form>

</body>
</html>