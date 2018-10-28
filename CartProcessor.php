<?php
/*
File name: CartProcessor.php
Original Author: Jared Rigdon
Edits made by: Leah Woodworth
Purpose:	Adds the book and the quantity to the users cart
			Checks if the quantity requested > quantity avaliable
*/
	//get the isbn of the book requested
	if(isset($_GET['ISBN'])){
		$ISBN = $_GET['ISBN'];
	}
	//connect to db
	$serverName = "server";
	$userName = "username";
	$password = "password";
	$dbName = "username";
	
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

	//assign the values of the book
	while($res=mysqli_fetch_array($details)){
		$ISBN=$res['ISBN'];
		$Title=$res["Title"];
		$Quantity_actual=$res["Quantity"];
		$Price=$res["Price"];
	}


	$_SESSION["db_quant"]=$Quantity_actual;
	mysqli_close($conn);
?>
<html>
	<style>
	    body {background-color:lightblue;}
	    div.ind{
	    	text-indent: 5em;
	    }
	    div.a{
			position: absolute;
    		top: 10px;
    		left: 10px;
		}
	 </style>

<body>	
	<div class="a">
			<a href="MainPage.php">Back</a>
	</div>

	<h1 align="center"> The Bookworm Bookstore</h1> <br/>
	<h2 align="center">Adding <?php echo $Title;?> to Cart</h2>

	ISBN:		<?php echo $ISBN;?></br>
	Quantity:	<?php echo $Quantity_actual;?></br>
	Price:		<?php echo $Price;?></br></br>

	<!--Display the Quantity textbox and submit button then check for is int-->
	<form action="AddtoCart.php" method="post">
			How many do you wish to order: <input type="text" name="quantity"> Qty</br>
			<input type="submit" value="Add to Cart">
	</form>
<?php
	
	//add the error message to the session
	$msg = $_SESSION["msg"];
	//display the error message
	echo $msg;
	$_SESSION["msg"]="";
	mysqli_close($conn);


?>
</body>
</html>
