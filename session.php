<?php
include("connection.php");
session_start();
if (!isset($_SESSION['id'])){
header('location:sign_out.php');
}

$id = $_SESSION['id'];

$query=mysqli_query ($link, "SELECT * FROM users WHERE user_id ='$id' AND recycle='False'");
$row=mysqli_fetch_array($query);
$email=$row['email'];
$user_id=$row['user_id'];
?>