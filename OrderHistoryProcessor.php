<html>
<!--
File name: OrderHistoryProcessor.php
Original Author: Leah Woodworth
Purpose:	Displays the order history info acording to the user that is logged in.
-->
	<style>
	    body {background-color:lightblue;}
	    div.ind{
	    	text-indent: 5em;
	    }
	    table{
				border-collapse: collapse;
				width: 100%;
			}
			td, th{
				border: 1px solid black;
				text-align: left;
				padding: 8px;
			}
		div.a{
			position: absolute;
    		top: 10px;
    		left: 10px;
		}
	

	 </style>

<body>	
	<!--displays the titles and back button-->
	<h1 align="center"> The Bookworm Bookstore</h1> <br/>
	<h2 align="center">Your Order History</h2>

	<div class="a">
		<a href="MainPage.php">Back</a>
	</div>

	<?php
		//connect to the database
		$serverName = "delphi.cs.uky.edu";
		$username = "lnwo224";
		$password = "password";
		$dbName = "lnwo224";

		$conn = mysqli_connect($serverName, $username, $password, $dbName);

		if(!$conn){
			die("Connection Failed".mysqli_connect_error());
		}

		session_start();

		//NEED TO BE SIGNED IN AS A USER TO SEE ORDER HISTORY
		//assigns the variable username to the current user
		$username = $_SESSION["username"];
		//query to find the all the required order details 
		$sql1 = "SELECT o.OrderID, o.Status, o.Billing, o.Shipping, o.Date, o.Cost, o.Card_Num FROM orders AS o, users AS u WHERE u.UserID=o.UserID and u.UserName='$username'";
		$results1 = mysqli_query($conn, $sql1);
		$num_of_rows_1 = mysqli_num_rows($results1);

		//if there is no order history
		if($num_of_rows_1==0){
			echo "You have no order history.";
			break;
		}

		?>
		<!--display the order history table along with books and quantity-->
		<table>
		<tr>
			<th>OrderID</th>
			<th>Status</th>
			<th>Billing Address</th>
			<th>Shipping Address</th>
			<th>Date</th>
			<th>Cost</th>
			<th>Card Number</th>
			<th>Title</th>
			<th>Quantity</th>
		</tr>

		<?php
		//for each row found from the query 
		for($i=0; $i<$num_of_rows_1; $i++){
			$row1 = mysqli_fetch_assoc($results1);
			
			//assign the variables the values of the current row
			$OrderID = $row1["OrderID"];
			$Status = $row1["Status"];
			$Billing = $row1["Billing"];
			$Shipping = $row1["Shipping"];
			$Date = $row1["Date"];
			$Cost = $row1["Cost"];
			$Card_Num = $row1["Card_Num"];

			//query to get the book title and quantity ordered for the current orderid
			$sql2 = "SELECT b.Title, oi.Quant_ord FROM books AS b, order_isbn AS oi WHERE oi.ISBNo=b.ISBN and oi.OrderID='$OrderID'";
			$results2 = mysqli_query($conn, $sql2);
			$num_of_rows_2 = mysqli_num_rows($results2);
			$num_of_books = $num_of_rows_2 + 1;
			echo "<tr>";

			//display the info
			if($num_of_rows_2 >1){
				echo "<td rowspan=".$num_of_books.">".$OrderID."</td>";
				echo "<td rowspan=".$num_of_books.">".$Status."</td>";
				echo "<td rowspan=".$num_of_books.">".$Billing."</td>";
				echo "<td rowspan=".$num_of_books.">".$Shipping."</td>";
				echo "<td rowspan=".$num_of_books.">".$Date."</td>";
				echo "<td rowspan=".$num_of_books.">".$Cost."</td>";
				echo "<td rowspan=".$num_of_books.">".$Card_Num."</td>";
			}
			else{
				echo "<td>".$OrderID."</td>";
				echo "<td>".$Status."</td>";
				echo "<td>".$Billing."</td>";
				echo "<td>".$Shipping."</td>";
				echo "<td>".$Date."</td>";
				echo "<td>".$Cost."</td>";
				echo "<td>".$Card_Num."</td>";
			}
	
			//display the book titles and quantity
			for($j=0; $j<$num_of_rows_2; $j++){

				$row2 = mysqli_fetch_assoc($results2); 
				$Title = $row2["Title"];
				$Quantity = $row2["Quant_ord"];
						
				if($num_of_rows_2==1){
					echo "<td>".$Title."</td><td>".$Quantity."</td>";
				}
				else{
					echo "<tr><td>".$Title."</td><td>".$Quantity."</td></tr>";
				}
			}
			
			//take care of any incorrect row sizing
			if($i==$num_of_rows_1-1){
				//do nothing
			}
			else{
				echo "<tr><td colspan=9></td></tr>";
			}
			echo "</tr>";
		}
		//close the connection
		mysqli_close($conn);	
		?>
	</table>
</body>
</html>
