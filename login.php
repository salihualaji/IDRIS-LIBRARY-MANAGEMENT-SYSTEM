					
<?php
include('connection.php');

						if(isset($_POST['login']))
						{
							$email=$_POST['email'];
							$password=$_POST['password'];
							$password = md5($password);
						{
							$result = mysqli_query($link,"SELECT * FROM users WHERE email='$email' AND password='$password' AND recycle='False'");
							
							$row = mysqli_fetch_array($result);
							$count = mysqli_num_rows($result);				
								if ($count == 0) 
									{
										header("location:try_again.php");
									} 
								else if ($count > 0)
									{
										session_start();
										$_SESSION['id'] = $row['user_id'];
										header("location:dashboard.php");
									}
						}				
						}
?>