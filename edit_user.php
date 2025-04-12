<?php
include("session.php");

if (getenv('HTTP_X_FORWARDED_FOR')) {
    $pipaddress = getenv('HTTP_X_FORWARDED_FOR');
    $ipaddress = getenv('REMOTE_ADDR');

} else {
    $ipaddress = getenv('REMOTE_ADDR');

}

?>
<?PHP

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
$user_id = $_REQUEST['user_id'];

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


    <title>Dashboard | Online Library System</title>
</head>

<body>


    <!--- Site Navitation Started here--->

    <div class="navigationBar">
        <div class="logoArea">
            <h2><a href="dashboard.php"><i class="fa-solid fa-book-open-reader"></i> E-Library <span>System</span></a>
            </h2>
        </div>

        <div class="menuArea">
            <ul>
                <li><a href="dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
                <li><a href="books.php"><i class="fa-solid fa-book"></i> Books</a></li>
                <li><a href="my_borrowed_books.php"><i class="fa-regular fa-circle-user"></i> Loans</a></li>
                <li><a href="sign_out.php"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a></li>
            </ul>
        </div>

        <div class="mobileMenu" onclick="showMobilemenu()">
            <i class="fa-solid fa-bars"></i>
        </div>

        <div class="closeMenu" onclick="closeMobilemenu()">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>


    <div class="mobileMenuTray">
        <ul>
            <li><a href="dashboard.php"> Dashboard <i class="fa-solid fa-house"></i></a></li>
            <li><a href="books.php"> Books <i class="fa-solid fa-book"></i></a></li>
            <li><a href="my_borrowed_books.php"> Loans <i class="fa-regular fa-circle-user"></i></a></li>
            <li><a href="sign_out.php"> Log Out <i class="fa-solid fa-right-from-bracket"></i></a></li>
        </ul>
    </div>

    <!--- Navigation ended here--->



    <div class="pageArea">
        <div class="greetingsTab">
            <h2><i class="fa-solid fa-book"></i> Manage Users</h2>
            <p>Below is list of all registered users in the library.</p>

            <div class="shortMenu">
                <div class="formArea">
                    <form action="search_book.php" method="GET">
                        <input type="text" name="keyword_title" placeholder="Search by book title">
                        <input type="text" name="keyword_author" placeholder="Search by author">
                        <select name="keyword_genre">
                            <option>Search by genre</option>
                            <option>History</option>
                            <option>Fiction</option>
                            <option>Comic</option>
                        </select>
                        <button type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
                    </form>
                </div>

                <div class="sideMenu">
                    <div class="menuTB"><a href="manage_books.php">Manage Books</a></div>
                    <div class="menuTB"><a href="manage_users.php">Manage Users</a></div>
                    <div class="menuTB"><a href="manage_borrowed.php">Borrowed Books</a></div>
                </div>
            </div>
        </div>


















        <div class='hangingPreview4'>
            <div class="closeScrn3"><a href="manage_users.php"><i class="fa-solid fa-circle-xmark"></i></a></div>



            <div class='bookbriefHolder'>
                <h2>Edit Account</h2>



                <?php

                if (isset($_POST['save'])) {





                    $fname = mysqli_real_escape_string($link, $_POST['fname']);
                    $email = mysqli_real_escape_string($link, $_POST['email']);
                    $account_category = mysqli_real_escape_string($link, $_POST['account_category']);

                    $password = mysqli_real_escape_string($link, $_POST['password']);


                    $confirm_password = mysqli_real_escape_string($link, $_POST['confirm_password']);
                    $date_registered = mysqli_real_escape_string($link, $_POST['date_registered']);
                    $ipaddress = mysqli_real_escape_string($link, $_POST['ipaddress']);

                    if ($password == "$confirm_password") {

                    } else {
                        die("<div class='failedNotify'>
                        <i class='fa-solid fa-face-frown'></i> Password confirmation doesn't match, try again.
                        </div>");
                    }


                    if ($update = mysqli_query($link, "UPDATE users SET fname='$fname', email='$email', account_category='$account_category', password='$password', date_registered='$date_registered' WHERE user_id='$user_id' AND recycle='False'")) {

                        if ($result) {

                            echo "<div class='borrSuccess'>
                    <i class='fa-solid fa-check'></i> Changes saved successfully!<br>
                    </div><div class='gobackButn'><i class='fa-solid fa-arrow-left'></i><a href='manage_users.php'> Go back</a></div>";
                        } else {
                            echo "<div class='borrFailed'>
                        <i class='fa-solid fa-check'></i> Failed to save changes, try again later!
                    </div>";
                        }


                    }
                }

                ?>

                <?php



                $SQL = "SELECT * FROM users WHERE user_id = '$user_id' AND recycle='False'";
                $result = mysqli_query($link, $SQL);
                $number = 1;
                while ($db_field = mysqli_fetch_assoc($result)) {


                    $user_id = $db_field['user_id'];
                    $fname = $db_field['fname'];
                    $email = $db_field['email'];
                    $account_category = $db_field['account_category'];

                    $date_registered = $db_field['date_registered'];
                    $ipaddress = $db_field['ipaddress'];


                }

                ?>



                <div class="formHolder2">

                    <form action="<?php echo "edit_user.php?user_id=$user_id"; ?>" method="POST">

                        <div class="loginStatus">Carefully complete form below to user account!</div>

                        <div class="InputHolder">
                            <i class="fa-solid fa-user-tie"></i>
                            <input type="text" name="fname" id="fname" placeholder="Full name"
                                value="<?php echo "$fname"; ?>">
                        </div>

                        <div class="InputHolder">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="email" name="email" id="email" placeholder="Email"
                                value="<?php echo "$email"; ?>">
                        </div>

                        <div class="InputHolder">
                            <i class="fa-solid fa-folder-open"></i>
                            <select name="account_category" id="account_category">
                                <?php echo "<option>$account_category</option>"; ?>
                                <option>User</option>
                                <option>Administrator</option>
                            </select>
                        </div>

                        <div class="InputHolder">
                            <i class="fa-solid fa-key"></i>
                            <input type="password" name="password" placeholder="Create password" id="password" required>
                        </div>

                        <div class="InputHolder">
                            <i class="fa-solid fa-key"></i>
                            <input type="password" name="confirm_password" id="confirm_password"
                                placeholder="Confirm password" required>
                        </div>

                        <div class="specialBtn">
                            <span class="stayLeft"><label><input type="checkbox" name="showPW" unchecked
                                        onclick="SwitchPW()"> Show Password</label></span>

                        </div>

                        <div class="btnHolder">
                            <button name="save" type="submit">Save Changes</button>
                        </div>


                        <input type="hidden" name="date_registered" value="<?php echo "$todays_date"; ?>"
                            id="date_registered">
                        <input type="hidden" name="ipaddress" value="<?php echo "$ipaddress"; ?>" id="ipaddress">
                    </form>


                </div>
            </div>


        </div>






























        <div class="recentlyRead">

            <?php

            $reg_users = mysqli_query($link, "SELECT * FROM users WHERE recycle='False'") or die(mysql_error());
            $users_count = mysqli_num_rows($reg_users);

            if ($users_count > 1) {
                echo "<h2>$users_count Registered users so far</h2>";
            } else {
                echo "<h2>Only one registered user</h2>";
            }

            ?>


            <div class="holdTable">
                <table>
                    <th>SN</th>
                    <th>Full name</th>
                    <th>Email ID</th>
                    <th>Account type</th>
                    <th>Date registered</th>
                    <th>IP Address</th>
                    <th colspan="3">Control Panel</th>
                    <?php

                    $SQL = "SELECT * FROM users WHERE recycle='False'";
                    $result = mysqli_query($link, $SQL);
                    $number = 1;
                    while ($db_field = mysqli_fetch_assoc($result)) {


                        $user_id = $db_field['user_id'];
                        $fname = $db_field['fname'];
                        $email = $db_field['email'];
                        $account_category = $db_field['account_category'];

                        $date_registered = $db_field['date_registered'];
                        $ipaddress = $db_field['ipaddress'];




                        echo "<tr>
        <td>$number.</td>";
                        $number = $number + 1;

                        echo "<td> $fname </td>
        <td width='220'>$email</td>
        <td>$account_category</td>
        <td width='200'>$date_registered</td>
        <td width='200'>$ipaddress</td>
        <td><a href='edit_user.php?user_id=$user_id'><i class='fa-solid fa-pen-to-square'></i></a></td>
        <td><a href='delete_user.php?user_id=$user_id'><i class='fa-regular fa-trash-can'></i></a></td>
        </tr>";

                    }


                    ?>

                </table>
            </div>
        </div>





    </div>


    </div>



    <a href="index.php" target="_blank">
        <div class="addNewBook">
            <i class="fa-solid fa-plus"></i>
        </div>
    </a>


    <script src="js/script.js"></script>
</body>

</html>