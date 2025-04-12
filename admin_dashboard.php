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

    if ($account_category == "User") {
        header("location: dashboard.php");
    } else {

    }
}

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



    
    

<script src="js/script.js"></script>

    <div class="pageArea">
        <div class="greetingsTab">
            <h2><i class="fa-regular fa-circle-user"></i>
                <?php
                /* This sets the $time variable to the current hour in the 24 hour clock format */
                $time = date("H");
                /* Set the $timezone variable to become the current timezone */
                $timezone = date("e");
                /* If the time is less than 1200 hours, show good morning */
                if ($time < "12") {
                    echo "Good morning";
                } else
                    /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
                    if ($time >= "12" && $time < "17") {
                        echo "Good afternoon";
                    } else
                        /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
                        if ($time >= "17" && $time < "19") {
                            echo "Good evening";
                        } else
                            /* Finally, show good night if the time is greater than or equal to 1900 hours */
                            if ($time >= "19") {
                                echo "Good night";
                            }
                ?>
                <?php
                echo " $fname!</h2>
        <p>You've logged in as a <strong>$account_category</strong>. So, what are you doing today?</p>";
                ?>

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
                            <button type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i>
                                Search</button>
                        </form>
                    </div>

                    <div class="sideMenu">
                        <div class="menuTB"><a href="manage_books.php">Manage Books</a></div>
                        <div class="menuTB"><a href="manage_users.php">Manage Users</a></div>
                        <div class="menuTB"><a href="manage_borrowed.php">Borrowed Books</a></div>
                    </div>
                </div>
        </div>

        <div class="recentlyRead">
            <h2>Recently Read Books</h2>

            <?php
            $SQL = "SELECT * FROM books_tb WHERE recycle='False'";
            $result = mysqli_query($link, $SQL);
            while ($db_field = mysqli_fetch_assoc($result)) {


                $book_id = $db_field['book_id'];
                $book_title = $db_field['book_title'];
                $book_author = $db_field['book_author'];
                $book_genre = $db_field['book_genre'];

                $published_date = $db_field['published_date'];
                $cover_image = $db_field['cover_image'];
                $book_status = $db_field['book_status'];
                $uploaded_by = $db_field['uploaded_by'];

                if ($book_status == "Borrowed") {

                    echo "<a href='view_book.php?book_id=$book_id'><div class='bookThumbnail'>
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
                } else {

                    echo "<a href='view_book.php?book_id=$book_id'><div class='bookThumbnail'>
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






        <div class="recentlyRead">
            <h2>You May Like</h2>


            <?php
            $SQL = "SELECT * FROM books_tb WHERE recycle='False'";
            $result = mysqli_query($link, $SQL);
            while ($db_field = mysqli_fetch_assoc($result)) {


                $book_id = $db_field['book_id'];
                $book_title = $db_field['book_title'];
                $book_author = $db_field['book_author'];
                $book_genre = $db_field['book_genre'];

                $published_date = $db_field['published_date'];
                $cover_image = $db_field['cover_image'];
                $book_status = $db_field['book_status'];
                $uploaded_by = $db_field['uploaded_by'];

                if ($book_status == "Borrowed") {

                    echo "<a href='view_book.php?book_id=$book_id'><div class='bookThumbnail'>
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
                } else {

                    echo "<a href='view_book.php?book_id=$book_id'><div class='bookThumbnail'>
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
</body>

</html>