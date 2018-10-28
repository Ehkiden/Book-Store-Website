<html>
<!--
File name: ManagerPage.php
Original Author: Patrick True
Edits made by: Leah Woodworth, Jared Rigdon
Purpose:	Displays the textboxes and button to add new book and displays all the books in the database
-->
<style>
    body {background-color:lightblue;}
    div.a{
			position: absolute;
    		top: 10px;
    		left: 10px;
		}
	div.b{
			position: absolute;
			top: 10px;
			right: 10px;
		}
</style>
	<!--displays titles, and textboxes for the add new book form-->
	<body>
		<div class="b">
			<a href="ManagerUsersPage.php">User Management</a>
		</div>
		<div class="a">
			<a href="MainPage.php">Back</a>
		</div>

		<h1 align="center"> The Bookworm Bookstore</h1> <br/>
		<h2 align="center"> Manager's Page: Book Inventory</h2><br/>
		<h3> Add a new book:</h3>

		<form action="ManagerPageProcessor.php"
		method="post">
		
			<table>
				<tbody>
				<tr>
					<th>Title</th>
					<th>Author(s)</th>
					<th>Summary</th>
					<th>Language</th>
					<th>Publish Date</th>
					<th>Publisher</th>
					<th>Quantity</th>
					<th>Price</th>
					<th></th>

				</tr>
				<td><input type="text" name="Title"></td>
				<td><input type="text" name="Authors"></td>
				<td><input type="text" name="Summary"></td>
				<td><input type="text" name="Language"></td>
				<td><input type="text" name="PublishDate"></td>
				<td><input type="text" name="Publisher"></td>
				<td><input type="text" name="Quantity"></td>
				<td><input type="text" name="Price"></td>
				<td><input type="submit" value="Add Book"></td>
				</tbody>
			</table>

		<br/><br/>
		<h3> Current Books:</h3>

	<?php
		//connect to db
		$serverName = "server";
		$userName = "username";
		$password = "password";
		$dbName = "username";
		
		$conn = mysqli_connect($serverName, $userName, $password, $dbName);
		
		if(!$conn)
		{
			die("Connection Failed".mysqli_connect_error());
		}

		//query to get all the books
		$sql = "SELECT * FROM books";
		$results=mysqli_query($conn, $sql);
		mysqli_close($conn);
		?>

		<!--displays the details and delete link for each book-->
		<table>
		<?php while($row1 = mysqli_fetch_assoc($results)):?>
		<tr>
			<td> 
			ISBN: 
			<?php echo $row1['ISBN'];?><br/>
			Book Title: 
			<?php echo $row1['Title'];?><br/><br/>
				<?php echo "<td><a href='ManagerBookDetails.php?ISBN=".$row1['ISBN']."'>Book Details</a></td>";?>
				<?php echo "<td><a href='deletebutton.php?ISBN=".$row1['ISBN']."'>Delete</a></td>";?>
			</td>
		</tr>
		<?php endwhile;?>

		</table>
		</form>
	</body>
<html>
