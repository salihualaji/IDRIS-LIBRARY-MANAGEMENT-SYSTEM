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
        <h2><i class="fa-solid fa-book"></i> Manage Books</h2>
        <p>Below is list of all registered books in the library.</p>

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















    <?php

        
$SQL = "SELECT * FROM books_tb WHERE book_id='$book_id' AND recycle='False'";
$result = mysqli_query($link, $SQL);
$number = 1;
while($db_field = mysqli_fetch_assoc($result)){

    
    $book_id = $db_field['book_id'];
    $book_title = $db_field['book_title'];
    $book_author = $db_field['book_author'];
    $book_genre = $db_field['book_genre'];
    $book_brief = $db_field['book_brief'];
    
    $published_date = $db_field['published_date'];
    $cover_image = $db_field['cover_image'];
    $book_status = $db_field['book_status'];
    $uploaded_by = $db_field['uploaded_by'];



}

?>



    
    <div class='hangingPreview3'>
    <div class="closeScrn3"><a href="manage_books.php"><i class="fa-solid fa-circle-xmark"></i></a></div>


    
    <?php
            echo"<div class='coverHolder'>
                <img src='book_cover/$cover_image' alt='$book_title'>
            </div>";
    ?>

    <div class='bookbriefHolder'>
    <h2>+Add New</h2>



    <?php
	
if (isset($_POST['save'])) {
	
		

                $book_title = mysqli_real_escape_string($link, $_POST['book_title']);
                $book_author = mysqli_real_escape_string($link, $_POST['book_author']); 
                $book_genre = mysqli_real_escape_string($link, $_POST['book_genre']); 
                $book_brief = mysqli_real_escape_string($link, $_POST['book_brief']); 

                
                $published_date = mysqli_real_escape_string($link, $_POST['published_date']); 

                
    if($update=mysqli_query($link, "UPDATE books_tb SET book_title='$book_title', book_brief='$book_brief', book_author='$book_author', book_genre='$book_genre', published_date='$published_date' WHERE book_id='$book_id' AND recycle='False'")) {
              
                if($result){
               
                    echo"<div class='borrSuccess'>
                    <i class='fa-solid fa-check'></i> Changes saved successfully!<br>
                    </div><div class='gobackButn'><i class='fa-solid fa-arrow-left'></i><a href='books.php'> Go back to book shelf</a></div>";
                }
                else
                {
                    echo"<div class='borrFailed'>
                        <i class='fa-solid fa-check'></i> Failed to save changes, try again later!
                    </div>";
                }

               
            }
        }
    
	?>
        



        <div class="formHolder">
            <h2>Update Book Details</h2>
            <form action="<?php echo"edit_book_record.php"; ?>" method="POST">
                <label>Book Title</label>
                <input type="text" name="book_title" placeholder="As it appears on the coverimage" value="<?php echo"$book_title";?>" required>
          
                
                <label>Book Brief</label>
                <textarea name="book_brief" ><?php echo"$book_brief";?></textarea>

                <label>Book Author</label>
                <input type="text" name="book_author" placeholder="As it appears on the coverimage"  value="<?php echo"$book_author";?>"  required>

                <select name="book_genre" required>
                        <?php echo"<option value='0'>$book_genre</option>"; ?>
                        <option>History</option>
                        <option>Fiction</option>
                        <option>Science Fiction</option>
                        <option>Comic</option>
                        <option>Inspirational</option>
                        <option>Skill Acquisition</option>
                        <option>Agriculture</option>
                        <option>Self Development</option>
                    </select>

                    
                <label>Publish date</label>
                <input type="TEXT" name="published_date"  value="<?php echo"$published_date";?>"  required>

                <div class="agreeHolder">
                    <label><input type="checkbox" name="agree" checked required> I accept the terms of services guiding this e-library system</label>
                </div>

                
        <input type="hidden" name="book_id" value="<?php echo"$book_id";?>"  id="book_id" >

        

                <button name="save" type="submit">Save Changes <i class="fa-solid fa-cloud-arrow-up"></i></button>
            </form>

            
        </div>
    </div>


    </div>






























    <div class="recentlyRead">

    <?php
    
    $available_books=mysqli_query($link, "SELECT * FROM books_tb WHERE recycle='False'")or die(mysql_error());
    $book_count = mysqli_num_rows($available_books);

        if($book_count > 1){
            echo"<h2>$book_count Registered Books</h2>"; 
        }
        else
        {
            echo"<h2>$book_count Registered Book</h2>"; 
        }

        ?>


<div class="holdTable">
    <table>
        <th >SN</th>
        <th>Book Name</th>
        <th>Author</th>
        <th>Genre</th>
        <th>Status</th>
        <th>Published date</th>
        <th colspan="3">Control Panel</th>
<?php

$SQL = "SELECT * FROM books_tb WHERE recycle='False'";
$result = mysqli_query($link, $SQL);
$number = 1;
while($db_field = mysqli_fetch_assoc($result)){

    
    $book_id = $db_field['book_id'];
    $book_title = $db_field['book_title'];
    $book_author = $db_field['book_author'];
    $book_genre = $db_field['book_genre'];
    
    $published_date = $db_field['published_date'];
    $cover_image = $db_field['cover_image'];
    $book_status = $db_field['book_status'];
    $uploaded_by = $db_field['uploaded_by'];
    $ipaddress = $db_field['ipaddress'];

    


        echo"<tr>
        <td>$number.</td>";
        $number = $number + 1;

        echo"<td><a href='view_book.php?book_id=$book_id' target='_blank'><img src='book_cover/$cover_image'> <h2>$book_title</h2></a></td>
        <td width='220'>$book_author</td>
        <td>$book_genre</td>
        <td width='200'>$book_status</td>
        <td width='200'>$published_date</td>
        <td><a href='replace_cover_photo.php?book_id=$book_id'><i class='fa-regular fa-image'></i></a></td>
        <td><a href='edit_book_record.php?book_id=$book_id'><i class='fa-solid fa-pen-to-square'></i></a></td>
        <td><a href='delete_book.php?book_id=$book_id'><i class='fa-regular fa-trash-can'></i></a></td>
        </tr>";

}


?>

    </table>
    </div>
    </div>





    </div>


</div>



<a href="add_book.php">
    <div class="addNewBook">
        <i class="fa-solid fa-plus"></i>
    </div>
</a>


<script src="js/script.js"></script>    
</body>
</html>