<?php
include"connection.php";

session_start();
if(!isset($_SESSION['SESS_USERNAME']) || !isset($_SESSION['SESS_PASSWORD'])){
header("location:take_him_out.php");
} 

 if (getenv('HTTP_X_FORWARDED_FOR')) {
        $pipaddress = getenv('HTTP_X_FORWARDED_FOR');
        $ipaddress = getenv('REMOTE_ADDR');

    } else {
        $ipaddress = getenv('REMOTE_ADDR');
       
    }
	
	
	$username = $_SESSION['SESS_USERNAME'];
				
	  $SQL = "SELECT * FROM users_tb WHERE username = '$username'";
$result = mysqli_query($link, $SQL);
		while ($db_field = mysqli_fetch_assoc($result)) {
			$user_id = $db_field['user_id'];
			
		}
$today = date("F d, Y - H:i:a");


header("location: take_him_out.php");
?>