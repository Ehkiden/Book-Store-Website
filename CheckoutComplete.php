<?php
/*
File name: CheckoutComplete.php
Original Author: Jared Rigdon
Purpose:	Adds the new order to the account and displays a thank you page and link to return to the home page
*/
	//add everything to the the order table and the order_isbn table
	$serverName = "delphi.cs.uky.edu";
	$username = "lnwo224";
	$password = "password";
	$dbName = "lnwo224";

	$conn = mysqli_connect($serverName, $username, $password, $dbName);

	if(!$conn){
		die("Connection Failed".mysqli_connect_error());
	}
	
	session_start();

	//get the correct info from the checkout screen
	$billing=$_POST['Billing'];
	$street=$_POST['Street'];
	$card=$_POST['Card'];

	//get the current date
	$date=date("Y-m-d");


	//get the current UserID
	$username = $_SESSION["username"];
	$sql_user="SELECT UserID from users where UserName='$username'";
	$userid_r=mysqli_query($conn, $sql_user);
	while($res=mysqli_fetch_array($userid_r)){
		$userid=$res['UserID'];
	}

	//adds the total price to the order
	$sql_tot_price="SELECT SUM(Price) as price from books as b, cart as c where b.ISBN=c.ISBNc and UserIDc=$userid";
	$res_tot_price=mysqli_query($conn,$sql_tot_price);
	while($res_price=mysqli_fetch_array($res_tot_price)){
		$price=$res_price['price'];
	}
		
	//insert the new order with the order
	$sql_new_ord="INSERT INTO orders( UserID, Status, Billing, Shipping, Date, Cost, Card_Num) VALUES( $userid, 'In Process', '$billing','$street','$date','$price', $card)";
	$results_new_ord=mysqli_query($conn,$sql_new_ord);

//this will delete the correct quantity from the books table

	//retrieve the lastest orderID
	$sql_latest_ord="SELECT MAX(OrderID) as new_orderid from orders";
	$res_latest_ord=mysqli_query($conn,$sql_latest_ord);
	while($res_id=mysqli_fetch_array($res_latest_ord)){
		$orderid=$res_id['new_orderid'];		//set the order id
	}

	//find the number of books and thier qty that is in the current user's cart
	$sql_cart="SELECT ISBNc, Quantity FROM cart where UserIDc=$userid";
	$res_cart=mysqli_query($conn, $sql_cart);
	$num_of_rows_1=mysqli_num_rows($res_cart);
	
	//for each isbn in the cart, subtract that quantity amount from the book qty
	//	then assign the isbn to the orderid that was just created
	for($i=0; $i<$num_of_rows_1; $i++){
		$row1 = mysqli_fetch_assoc($res_cart);
		$ISBN_cur=$row1['ISBNc'];
		$Qty=$row1['Quantity'];

		//update the current book qty with the amount from the cart that was just checked out
		$sql_qty="UPDATE books as b SET b.Quantity = b.Quantity - (SELECT Quantity from cart where ISBNc=$ISBN_cur and UserIDc=$userid) where b.ISBN = $ISBN_cur";
		$res_qty=mysqli_query($conn,$sql_qty);
		//assign the current isbn to the order_isbn using the newly created orderid
		$sql_oi="INSERT INTO order_isbn(ISBNo,OrderID,Quant_ord) VALUES($ISBN_cur,$orderid,$Qty)";
		$res_oi=mysqli_query($conn,$sql_oi);
	}


	//delete all books and qty from the current user's cart
	$sql_clear_cart="DELETE FROM cart where UserIDc = $userid";
	$res_clear_cart=mysqli_query($conn,$sql_clear_cart);

	mysqli_close($conn);
	
?>
<html>
<!--displays the titles and link to main page-->
<head>
	<style>
		body {background-color:lightblue;}

	</style>
</head>
<body>
	<h1 align="center"> The Bookworm Bookstore</h1> <br/>
	<h2 align="center">Thank you for ordering with us!</h2>
	<a href="MainPage.php">Click here to return to the main page.</a>
</body>
</html>