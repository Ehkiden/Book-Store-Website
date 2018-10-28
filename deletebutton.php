<html>
<body>
<?php
/*
File name: deletebutton.php
Original Author: Jared Rigdon
Edits made by:	Patrick True
Purpose:	Deletes the desired rows from the database based on the passed in input
*/

//donnect to db
$serverName = "server";
$userName = "username";
$password = "password";
$dbName = "username";
session_start();

$conn = mysqli_connect($serverName, $userName, $password, $dbName);

if(!$conn){
	die("Connection Failed".mysqli_connect_error());
}

//check if deleting book, keyword, or subject
//isbn will always be passed in
session_start();
	$username = $_SESSION["username"];
	//get the current UserID
	$sql_user="SELECT UserID from users where UserName='$username'";
	$userid_r=mysqli_query($conn, $sql_user);
	while($res=mysqli_fetch_array($userid_r)){
		$userid=$res['UserID'];
	}

//if deleting from wish list
if(isset($_GET["ISBNw"]))
{
	$ISBNw = $_GET['ISBNw'];
	$sql_del_wish="DELETE FROM wishlist WHERE ISBNw=$ISBNw and UserIDw = $userid";
	if(mysqli_query($conn, $sql_del_wish)){
		header("Location: ./WishlistPage.php");
	}
	mysqli_close($conn);
}

//delete from the user cart
if(isset($_GET["ISBNc"]))
{
	$ISBNc = $_GET['ISBNc'];
	$sql_del_cart="DELETE FROM cart WHERE ISBNc=$ISBNc and UserIDc = $userid";
	if(mysqli_query($conn, $sql_del_cart)){
		header("Location: ./CartView.php");
	}
	mysqli_close($conn);
}

//if the isbn is passed in, then delete book
if(isset($_GET['ISBN']))
{
	//delete the subjects and keywords first
	$ISBN = $_GET['ISBN'];
	$sql_del_sub="DELETE FROM subject WHERE ISBNb='$ISBN'";
	if(mysqli_query($conn, $sql_del_sub)){
		$sql_del_key="DELETE FROM keywords WHERE ISBNk='$ISBN'";
		if(mysqli_query($conn, $sql_del_key)){
			$sql_del_cart="DELETE from cart where ISBNc=$ISBN";
			if(mysqli_query($conn, $sql_del_cart)){
				$sql_del_ord_isbn="DELETE from order_isbn where ISBNo=$ISBN";
				if(mysqli_query($conn, $sql_del_ord_isbn)){
					$sql_del_review="DELETE from ratings where ISBNr=$ISBN";
					if(mysqli_query($conn, $sql_del_review)){
						$sql_del_book="DELETE FROM books WHERE ISBN=$ISBN";
						if(mysqli_query($conn,$sql_del_book)){
							header("Location: ./ManagerPage.php");
						}
					}
				}	
			}
		}
	}
	mysqli_close($conn);
}

//if the keyword is passed in, then delete keyword
if(isset($_GET["Key"]))
{
	$ISBN=$_SESSION['ISBN_current'];
	$word=$_GET['Key'];
	$sql_del_key="DELETE FROM keywords WHERE ISBNk='$ISBN' AND Word='$word'";
	//$results=mysqli_query($conn, $sql_del_key);
	if(mysqli_query($conn, $sql_del_key)){
		header("Location: ./ManagerBookDetails.php?ISBN=$ISBN");
	}
	mysqli_close($conn);
}

//if the subject is passed in, the delete subject
if(isset($_GET["Subject"]))
{
	$ISBN=$_SESSION['ISBN_current'];
	$subject=$_GET['Subject'];
	$sql_del_sub="DELETE FROM subject WHERE ISBNb='$ISBN' AND Subject='$subject'";
	//$results=mysqli_query($conn, $sql_del_sub);
	if(mysqli_query($conn, $sql_del_sub)){
		header("Location: ./ManagerBookDetails.php?ISBN=$ISBN");

	}
	mysqli_close($conn);
}

//if the UserID is passed in, the delete user
if(isset($_GET["UserID"]))
{
	$UserID = $_GET['UserID'];
	$sql_del_user = "DELETE FROM users WHERE UserID = '$UserID'";
	if(mysqli_query($conn, $sql_del_user))
	{
		header("Location: ./ManagerUsersPage.php");
	}
	mysqli_close($conn);
}

?>

</body>
</html>
