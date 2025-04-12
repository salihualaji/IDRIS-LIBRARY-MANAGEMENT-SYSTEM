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
            

        $keyword_title = $_GET['keyword_title'];
        $keyword_genre = $_GET['keyword_genre'];
        $keyword_author = $_GET['keyword_author'];
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
                    <input type="text" name="keyword_title" placeholder="Search by book title" value="<?php echo"$keyword_title";?>">
                    <input type="text" name="keyword_author" placeholder="Search by author"  value="<?php echo"$keyword_author";?>">
                    <select name="keyword_genre">
                        <?php echo"<option selected>$keyword_genre</option>";?>
                        <option>History</option>
                        <option>Fiction</option>
                        <option>Comic</option>
                    </select>
                    <button type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
                </form>
            </div>

            
        </div>
    </div>

    <div class="recentlyRead">

    <?php
    
    $search_query=mysqli_query($link, "SELECT * FROM books_tb WHERE  book_title LIKE '$keyword_title' OR book_author LIKE '$keyword_author' OR book_genre LIKE '$keyword_genre' AND recycle='False'")or die(mysql_error());
    $search_count = mysqli_num_rows($search_query);

        
if($search_count > 1){
    
    echo"<h2>$search_count books found matching $keyword_title ~ $keyword_author</h2>
    <hr>";
}
else
{
    
    echo"<h2>$search_count book found matching $keyword_title ~ $keyword_author</h2>
    <hr>";
}
   

        ?>
       
<?php
    $SQL = "SELECT * FROM books_tb WHERE book_title LIKE '$keyword_title' OR book_author LIKE '$keyword_author' OR book_genre LIKE '$keyword_genre' AND recycle='False'";
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

?>
    </div>







</div>
    

<script src="js/script.js"></script>
</body>
</html>