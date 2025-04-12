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

        $book_id = $_REQUEST['book_id'];
            

    
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
                <div class="menuTB"><a href="#">Manage Books</a></div>
                <div class="menuTB"><a href="#">Manage Users</a></div>
                <div class="menuTB"><a href="#">Books I Borrowed</a></div>
            </div>
        </div>
    </div>


    <div class='hangingPreview2'>
    <div class='closeScrn2' onclick="closeM();"><i class='fa-solid fa-circle-xmark'></i></div>
    
    <?php
    $SQL = "SELECT * FROM books_tb WHERE book_id='$book_id' AND recycle='False'";
    $result = mysqli_query($link, $SQL);
    while($db_field = mysqli_fetch_assoc($result)){
    
        
        $book_id = $db_field['book_id'];
        $book_title = $db_field['book_title'];
        $book_brief = $db_field['book_brief'];
        $book_author = $db_field['book_author'];
        $book_genre = $db_field['book_genre'];
        
        $published_date = $db_field['published_date'];
        $cover_image = $db_field['cover_image'];
        $book_status = $db_field['book_status'];
        $uploaded_by = $db_field['uploaded_by'];



    }

    ?>






<!--- BORROW THIS BOOK --->





<?php

echo"<div class='coverHolder'>
        <img src='book_cover/$cover_image'>
    </div>

    <div class='bookbriefHolder'>
        <h2>$book_title</h2>
        <p><span><i class='fa-solid fa-user-pen'></i> Author:</span> $book_author</p>";
?>


<!--- BORROW BOOK FORM STARTS HERE---->
<?php

    
if (isset($_POST['borrow'])) {

    $borrowed_by_name = mysqli_real_escape_string($link, $_POST['borrowed_by_name']);
    $borrowed_by_id = mysqli_real_escape_string($link, $_POST['borrowed_by_id']);
    $borrow_date = mysqli_real_escape_string($link, $_POST['borrow_date']);
    $ipaddress = mysqli_real_escape_string($link, $_POST['ipaddress']);

    
    $returning_date = mysqli_real_escape_string($link, $_POST['returning_date']);
    
    $book_title = mysqli_real_escape_string($link, $_POST['book_title']);
    $book_id = mysqli_real_escape_string($link, $_POST['book_id']);
    $returning_date = mysqli_real_escape_string($link, $_POST['returning_date']);


    //Confirm that user is not trying to submit request twice
    $dn = mysqli_num_rows(mysqli_query($link, "SELECT request_id FROM borrowed_books WHERE book_title='$book_title' AND borrowed_by_id='$borrowed_by_id' AND borrow_status='Borrowed' AND recycle='False' "));
    if($dn==0)
    {
    }
    else
    {
        die("<div class='borrFailed'>You already borrowed this book. Please note that we eagerly hope you handle it with care and return it on date you stated. </div>   <div class='gobackButn'><i class='fa-solid fa-arrow-left'></i><a href='books.php'> Go back to book shelf</a></div>");
    }



    $SQL = "INSERT INTO borrowed_books(book_id, book_title, date_borrowed, returning_date, borrowed_by_id, borrowed_by_name, ipaddress) VALUE('$book_id', '$book_title', '$borrow_date', '$returning_date', '$borrowed_by_id', '$borrowed_by_name', '$ipaddress')";
    $result = mysqli_query($link, $SQL);

    if($result){
    echo"<div class='borrSuccess'>
        <i class='fa-solid fa-check'></i> You have borrowed this book titled <br><strong><em>$book_title</em></strong>.
    </div>";

    
    if($update=mysqli_query($link, "UPDATE books_tb SET book_status='Borrowed' WHERE book_id='$book_id' AND recycle='False'")) {
                             
    }
    }
    else
    {
        echo"<div class='borrFailed'>
            <i class='fa-solid fa-check'></i> Failed to send request!
        </div>";
    }


}
?>

        <div class="formHolder">
            <h2>Complete Form Below to Borrow This Book</h2>
            <form action="<?php 
            
                
    if (isset($_POST['borrow'])) {
        $book_id = $_POST['book_id'];

            $link = "borrow_book.php?book_id=$book_id";
            echo"$link";

    }
            ?>" method="POST">
                <label>Your name (As it appears on your ID)</label>
                <input type="text" name="borrowed_by_name" placeholder="Your full name as it appears on your ID" value="<?php echo"$fname";?>" readonly>

                <label>When would you like to borrow this book?</label>
                <input type="date" name="borrow_date" >
                
                <label>When are you returning this book?</label>
                <input type="date" name="returning_date" >

                <div class="agreeHolder">
                    <label><input type="checkbox" name="agree" required> I agree to be penalized if I failed to return this book on date indicated above</label>
                </div>

                
        <input type="hidden" name="ipaddress" value="<?php echo"$ipaddress";?>"  id="ipaddress" >
        <input type="hidden" name="borrowed_by_id" value="<?php echo"$loggedin_user_id";?>"   id="date_registered" >

        <input type="hidden" name="book_title" value="<?php echo"$book_title";?>"   id="book_title" >
        <input type="hidden" name="book_id" value="<?php echo"$book_id";?>"   id="book_id" >
        

                <button name="borrow" type="submit">Send Request <i class="fa-solid fa-paper-plane"></i></button>
            </form>

            <div class="gobackButn"><i class="fa-solid fa-arrow-left"></i><a href="books.php"> Go back to book shelf</a></div>
        </div>
    </div>
</div>

<!--- BORROW BOOK FORM ENDS HERE---->




























    <div class="recentlyRead">

    <?php
    
    
    
    echo"<h2>Similar books you may like to read</h2>
    <hr>";

   

        ?>
       
<?php
    $SQL = "SELECT * FROM books_tb WHERE book_title LIKE '$book_title' OR book_author LIKE '$book_author' OR book_genre LIKE '$book_genre' AND recycle='False'";
    $result = mysqli_query($link, $SQL);
    while($db_field = mysqli_fetch_assoc($result)){
    
        
        $book_id = $db_field['book_id'];
        $book_title = $db_field['book_title'];
        $book_author = $db_field['book_author'];
        $book_genre = $db_field['book_genre'];
        
        $published_date = $db_field['published_date'];
        $cover_image = $db_field['cover_image'];
        $book_status = $db_field['book_status'];
        $uploaded_by = $db_field['uploaded_by'];

        if($book_status=="Borrowed"){

            echo"<a href='view_book.php?book_id=$book_id'><div class='bookThumbnail'>
            <div class='bookCover'>
                <img src='book_cover/$cover_image'>
            </div>
            <div class='detailPage'>
                <h2>$book_title</h2>
                <p><i class='fa-solid fa-user-pen'></i> Author: <span>$book_author</span></p>
                <p><i class='fa-regular fa-clock'></i> Published year: <span>$published_date</span></p>
                <div class='borrowed'><i class='fa-solid fa-book-open-reader'></i> $book_status</div>
            </div>
            </div></a>";
        }
        else
        {

            echo"<a href='view_book.php?book_id=$book_id'><div class='bookThumbnail'>
            <div class='bookCover'>
                <img src='book_cover/$cover_image'>
            </div>
            <div class='detailPage'>
                <h2>$book_title</h2>
                <p><i class='fa-solid fa-user-pen'></i> Author: <span>$book_author</span></p>
                <p><i class='fa-regular fa-clock'></i> Published year: <span>$published_date</span></p>
                <div class='bookstatus'><i class='fa-solid fa-book-open-reader'></i> $book_status</div>
            </div>
            </div></a>";
        }


    
}

?>
    </div>







</div>
    

<script src="js/script.js"></script>

<script src="js/script.js"></script>
</body>
</html>