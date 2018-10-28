<html>
<body>
<?php
/*
File name: AddtoCart.php
Original Author: Jared Rigdon
Purpose:	Adds the book and the request quantity into the cart table in the db
*/
	//connect to db
	$serverName = "server"; 
	$userName = "username";
	$password = "password";
	$dbName = "username";
	
	$conn = mysqli_connect($serverName, $userName, $password, $dbName);
	
	if(!$conn){
		die("Connection Failed".mysqli_connect_error());
	}

	//need to make sure quantity isnt null or not an int
	session_start();
	$ISBN=$_SESSION["ISBN_current"];
	$quantity=$_POST['quantity'];
	$username = $_SESSION["username"];
	$db_quant = $_SESSION["db_quant"];
	//echo "current db quantity is: ".$db_quant;

	//get the current UserID
	$sql_user="SELECT UserID from users where UserName='$username'";
	$userid_r=mysqli_query($conn, $sql_user);
	while($res=mysqli_fetch_array($userid_r)){
		$userid=$res['UserID'];
	}

	//query to check if the book is already in the cart
	$sql1 = "SELECT c.ISBNc FROM cart AS c WHERE UserIDc='$userid'";
	$results1 = mysqli_query($conn, $sql1);
	$curr_cart_isbn=0;
	while($row = mysqli_fetch_assoc($results1)){
		$cart_isbn = $row["ISBNc"];
		if($ISBN == $cart_isbn){
			$curr_cart_isbn = $cart_isbn;
			break;
		}
	}
	$msg = "";
	//if the book isnt in the cart, add the required data, else add just the quantity to the cart
	if($curr_cart_isbn != 0){
		$sql2 = "SELECT Quantity FROM cart WHERE UserIDc='$userid' and ISBNc='$curr_cart_isbn'";
		$results2 = mysqli_query($conn, $sql2);

		while($row = mysqli_fetch_assoc($results2)){
			$cart_quant = $row["Quantity"];
		}

		$new_quant = $cart_quant + $quantity;

		if($new_quant > $db_quant){
			$msg = "Not enough quantity.";
			$_SESSION["msg"]=$msg;
			header("Location: ./CartProcessor.php?ISBN=$curr_cart_isbn");
			break;
		}

		//queries to override the old quantity with the new quantity
		$sql3 = "DELETE FROM cart WHERE UserIDc='$userid' and ISBNc='$curr_cart_isbn' and Quantity='$cart_quant'";
		$results3 = mysqli_query($conn, $sql3);

		$sql4 = "INSERT INTO cart(UserIDc,ISBNc,Quantity) VALUES('$userid', '$curr_cart_isbn', '$new_quant')";
		$results4 = mysqli_query($conn, $sql4);
		
		header("Location: ./CartView.php");
		

	}

	else{
		//if the requested qty is more than the actual qty, the display a message and redirect
		if($quantity > $db_quant){
			$msg = "Not enough books in stock.";
			$_SESSION["msg"]=$msg;
			header("Location: ./CartProcessor.php?ISBN=$ISBN");
			break;
		}
	
		//add the order to the cart
		$sql="INSERT INTO cart(UserIDc,ISBNc,Quantity) VALUES($userid, $ISBN, $quantity)";
		
		//if successful then redirect to CartView.php
		if (mysqli_query($conn,$sql)){
			header("Location: ./CartView.php");
		}
		else{
			echo "Some error occurred when trying to insert book into cart db table.";
		}
	}
	mysqli_close($conn);	//close db


?>
</body>
</html>
