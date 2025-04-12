<?php
include("session.php");
include"connection.php";

$id = $_SESSION['id'];

$SQL = "SELECT * FROM users WHERE user_id = '$id'";
$result = mysqli_query($link, $SQL);
  while ($db_field = mysqli_fetch_assoc($result)) {

      
      $loggedin_user_id = $db_field['user_id'];
      $fname = $db_field['fname'];
      $email = $db_field['email'];
      $account_category = $db_field['account_category'];
      
      $date_registered = $db_field['date_registered'];
      $ipaddress = $db_field['ipaddress'];
  }


  
	$todays_date = date("l F j, Y");
	$month_visited = date("F");
	$year_visited = date("Y");
    $this_time = date("h:i:a");






$book_id = $_REQUEST['book_id'];


if($update=mysqli_query($link, "UPDATE books_tb SET book_status='Available' WHERE book_id='$book_id'")) {
	
}

if($update=mysqli_query($link, "UPDATE borrowed_books SET date_returned='$todays_date ~ $this_time', borrow_status='Returned' WHERE book_id='$book_id'")) {
	
	header("location: my_borrowed_books.php");
}


?>