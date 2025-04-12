<?php
session_start();
session_destroy();

 if (isset($_COOKIE["username"]) AND isset($_COOKIE["password"])){
  setcookie("user", '', time() - (3600));
  setcookie("pass", '', time() - (3600));
 }
?><?php
include"connection.php";
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Refresh" content="0.0001; URL=try_again.php" charset=utf-8" />
<title>Hi9ja | Share your story, Lifestyle, Jobs, Talents, Freelancers & Mutual talks!</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
}
</style>
</head>

<body>
<p>Processing...
  </p>
</p>
</body>
</html>