<?php
include"connection.php";


 if (getenv('HTTP_X_FORWARDED_FOR')) {
        $pipaddress = getenv('HTTP_X_FORWARDED_FOR');
        $ipaddress = getenv('REMOTE_ADDR');

    } else {
        $ipaddress = getenv('REMOTE_ADDR');
       
    }
	
	?>
    
    
    
    <?php

    
	$todays_date = date("l F j, Y");
	$month_visited = date("F");
	$year_visited = date("Y");
	
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/a71e118592.js" crossorigin="anonymous"></script>

    <title>User Login | E-Library System</title>
</head>
<body>


<div class="LoginHolder">
    <h1>E-Library System</h1>
    <p>Read, Borrow & Grow with our mind blowing books!</p>


    <?php

if (isset($_POST['signup'])) {

$fname = mysqli_real_escape_string($link, $_POST['fname']);
$email = mysqli_real_escape_string($link, $_POST['email']);
$account_category = mysqli_real_escape_string($link, $_POST['account_category']);

$password = mysqli_real_escape_string($link,$_POST['password']);


$confirm_password = mysqli_real_escape_string($link, $_POST['confirm_password']);
$date_registered = mysqli_real_escape_string($link, $_POST['date_registered']);
$ipaddress = mysqli_real_escape_string($link, $_POST['ipaddress']);

if($password=="$confirm_password"){

}
else
{
    die("<div class='failedNotify'>
    <i class='fa-solid fa-face-frown'></i> Password confirmation doesn't match, try again.
    </div>");
}

$password = md5($password);


            //We check if this user already exists
            $dn = mysqli_num_rows(mysqli_query($link, "SELECT user_id FROM users WHERE email='$email' AND recycle='False' "));
            if($dn==0)
            {
            }
            else
            {
                die("<div class='failedNotify'>You already have an account with us, pls Sign In.</div>");
            }

$SQL = "INSERT INTO users(fname, email, account_category, password, date_registered, ipaddress) VALUE('$fname', '$email', '$account_category', '$password', '$date_registered', '$ipaddress')";
$result = mysqli_query($link, $SQL);

if($result){

    echo"<div class='succesNotify'>
    <i class='fa-solid fa-check'></i> Account created successfully!
    </div>";
}
else
{
    echo"<div class='failedNotify'>
    <i class='fa-solid fa-check'></i> Signup failed! Try again later.
    </div>";
}

}
    ?>


    <form action="login.php" method="POST">
        <h2><i class="fa-solid fa-user-tie"></i> Member Login</h2>
        

        <div class="InputHolder">
            <i class="fa-solid fa-user-tie"></i>
            <select name="choosen_priviledge">
                <option>- Select Account Priviledge -</option>
                <option>Administrator</option>
                <option>User</option>
            </select>
        </div>
        
        
        <div class="InputHolder">
            <i class="fa-solid fa-envelope"></i>
            <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="InputHolder">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password"  id="password3" placeholder="Password" required>
        </div>

        <div class="specialBtn">
            <span class="stayLeft"><label><input type="checkbox" name="showPW" unchecked onclick="SwitchPW()"> Show Password</label></span>
            <span class="stayRight" onclick="showSignup()">New here? Sign up</span>
        </div>

        <div class="btnHolder">
            <button name="login" type="submit">Secure Login<i class="fa-solid fa-arrow-right"></i></button>
        </div>
    </form>        
        
    
</div>
    






<div class="signUpFOrm">
<h1>E-Library System</h1>
    <p>Read, Borrow & Grow with our mind blowing books!</p>

    

    <form action="index.php" method="POST">
        <h2><i class="fa-solid fa-user-tie"></i> Member Sign Up Form</h2>
        <div class="loginStatus">Carefully complete form below to create account!</div>

        <div class="InputHolder">
        <i class="fa-solid fa-user-tie"></i>
            <input type="text" name="fname"  id="fname" placeholder="Full name">
        </div>

        <div class="InputHolder">
            <i class="fa-solid fa-envelope"></i>
            <input type="email" name="email"   id="email" placeholder="Email">
        </div>

        <div class="InputHolder">
            <i class="fa-solid fa-folder-open"></i>
            <select name="account_category"  id="account_category" >
                <option>User</option>
                <option>Administrator</option>
            </select>
        </div>

        <div class="InputHolder">
            <i class="fa-solid fa-key"></i>
            <input type="password" name="password" placeholder="Create password" id="password" >
        </div>

        <div class="InputHolder">
            <i class="fa-solid fa-key"></i>
            <input type="password" name="confirm_password"  id="confirm_password" placeholder="Confirm password" >
        </div>

        <div class="specialBtn">
            <span class="stayLeft"><label><input type="checkbox" name="showPW" unchecked onclick="SwitchPW()"> Show Password</label></span>
            <span class="stayRight" onclick="showLogin()">Already have account? Login</span>
        </div>

        <div class="btnHolder">
            <button  name="signup"  type="submit">Create Account</button>
        </div>


        <input type="hidden" name="date_registered" value="<?php echo"$todays_date";?>"   id="date_registered" >
        <input type="hidden" name="ipaddress" value="<?php echo"$ipaddress";?>"  id="ipaddress" >

    </form>        
</div>





<script src="js/script.js"></script>
</body>
</html>