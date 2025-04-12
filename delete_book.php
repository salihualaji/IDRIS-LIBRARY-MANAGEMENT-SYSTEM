<?php
include"connection.php";

$book_id = $_REQUEST['book_id'];


if($update=mysqli_query($link, "UPDATE books_tb SET recycle='True' WHERE book_id='$book_id'")) {
	
	header("location: manage_books.php");
}


?>