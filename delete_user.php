<?php
include "connection.php";

$user_id = $_REQUEST['user_id'];


if ($update = mysqli_query($link, "UPDATE users SET recycle='True' WHERE user_id='$user_id'")) {

    header("location: manage_users.php");
}


?>