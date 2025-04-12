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



















        <div class='hangingPreview3'>
            <div class="closeScrn3"><a href="manage_books.php"><i class="fa-solid fa-circle-xmark"></i></a></div>


            <div class='coverHolder'>
                <img src="#" alt="" id="output">
            </div>

            <div class='bookbriefHolder'>
                <h2>+Add New</h2>



                <?php
                if (isset($_FILES['image']['tmp_name'])) {

                    $file = $_FILES['image']['tmp_name'];
                    $image = $_FILES["image"]["name"];
                    $image_name = addslashes($_FILES['image']['name']);
                    $size = $_FILES["image"]["size"];
                    $error = $_FILES["image"]["error"];

                    $allowedExts = array("gif", "jpeg", "jpg", "png", "webp", "JPG", "JPEG", "PNG", "AVIF", "WEBP");
                    $temp = explode(".", $_FILES["image"]["name"]);
                    $extension = end($temp);
                    if (
                        (($_FILES["image"]["type"] == "image/gif")
                            || ($_FILES["image"]["type"] == "image/jpeg")
                            || ($_FILES["image"]["type"] == "image/JPG")
                            || ($_FILES["image"]["type"] == "image/JPEG")
                            || ($_FILES["image"]["type"] == "image/webp")
                            || ($_FILES["image"]["type"] == "image/jpg")
                            || ($_FILES["image"]["type"] == "image/pjpeg")
                            || ($_FILES["image"]["type"] == "image/x-png")
                            || ($_FILES["image"]["type"] == "image/png"))
                        && ($_FILES["image"]["size"] < 40000000)
                        && in_array($extension, $allowedExts)
                    ) {
                    } else {
                        die("Invalid image format!");
                    }

                    if ($error > 0) {
                        die("Error uploading file! Code $error.");
                    } else {
                        if ($size > 1000000000) //conditions for the file
                        {
                            die("Format is not allowed or file size is too big!");
                        } else {
                            $temp = explode(".", $_FILES["image"]["name"]);

                            $today_date = date("d-m-Y");
                            $this_time = date("H:i:a");


                            $newfilename = round(microtime(true)) . '.' . end($temp);
                            $img_name = "Bookcover_$newfilename";
                            move_uploaded_file($_FILES["image"]["tmp_name"], "book_cover/" . $img_name);
                            $location = $_FILES["image"]["name"];


                        }

                        $book_title = mysqli_real_escape_string($link, $_POST['book_title']);
                        $book_author = mysqli_real_escape_string($link, $_POST['book_author']);
                        $book_genre = mysqli_real_escape_string($link, $_POST['book_genre']);
                        $book_isbn = mysqli_real_escape_string($link, $_POST['book_isbn']);
                        $book_quantity = mysqli_real_escape_string($link, $_POST['book_quantity']);
                        $book_brief = mysqli_real_escape_string($link, $_POST['book_brief']);


                        $published_date = mysqli_real_escape_string($link, $_POST['published_date']);
                        $ipaddress = mysqli_real_escape_string($link, $_POST['ipaddress']);
                        $uploaded_by = mysqli_real_escape_string($link, $_POST['uploaded_by']);




                        $SQL = "INSERT INTO books_tb(book_title, book_brief, book_author, book_genre, book_isbn, book_quantity, published_date, cover_image, uploaded_by, ipaddress) VALUE('$book_title', '$book_brief', '$book_author', '$book_genre', '$book_isbn', '$book_quantity', '$published_date', '$img_name', '$uploaded_by', '$ipaddress')";
                        $result = mysqli_query($link, $SQL);

                        if ($result) {

                            echo "<div class='borrSuccess'>
                    <i class='fa-solid fa-check'></i> Book uploaded successfully! Fill up the form if you would you like to upload more.<br>
                    </div><div class='gobackButn'><i class='fa-solid fa-arrow-left'></i><a href='books.php'> Go back to book shelf</a></div>";
                        } else {
                            echo "<div class='borrFailed'>
                        <i class='fa-solid fa-check'></i> Book registration failed, try again later!
                    </div>";
                        }


                    }
                }

                ?>


                <div class="formHolder">
                    <h2>+ Register New Book to Library</h2>
                    <form action="<?php echo "add_book.php"; ?>" method="POST" enctype="multipart/form-data">
                        <label>Book Title</label>
                        <input type="text" name="book_title" placeholder="As it appears on the coverimage" required>

                        <label>Book Cover Image</label>
                        <input type="file" name="image" id="image" runat="server" accept="image/*"
                            onchange="loadFile(event)" required>
                        <script>
                            var loadFile = function (event) {
                                var output = document.getElementById('output');
                                output.src = URL.createObjectURL(event.target.files[0]);
                            };
                        </script>


                        <label>Book Brief</label>
                        <textarea name="book_brief"></textarea>

                        <label>Book Author</label>
                        <div class="squizedBox">
                            <input type="text" name="book_author" placeholder="As it appears on the coverimage"
                                required>
                            <input type="date" name="published_date" required>
                        </div>

                        <select name="book_genre" required>
                            <option value="0">- Select book genre -</option>
                            <option>History</option>
                            <option>Fiction</option>
                            <option>Science Fiction</option>
                            <option>Comic</option>
                            <option>Inspirational</option>
                            <option>Skill Acquisition</option>
                            <option>Agriculture</option>
                            <option>Self Development</option>
                        </select>



                        <label>Other Details</label>
                        <div class="squizedBox">
                            <input type="text" name="book_isbn" placeholder="Book ISBN" required>
                            <input type="text" name="book_quantity" placeholder="Quantity available" required>
                        </div>



                        <div class="agreeHolder">
                            <label><input type="checkbox" name="agree" required> I accept the terms of services guiding
                                this e-library system</label>
                        </div>


                        <input type="hidden" name="ipaddress" value="<?php echo "$ipaddress"; ?>" id="ipaddress">
                        <input type="hidden" name="uploaded_by" value="<?php echo "$loggedin_user_id"; ?>"
                            id="uploaded_by">



                        <button name="image" type="submit">Save Record <i
                                class="fa-solid fa-cloud-arrow-up"></i></button>
                    </form>


                </div>
            </div>


        </div>






























        <div class="recentlyRead">

            <?php

            $available_books = mysqli_query($link, "SELECT * FROM books_tb WHERE recycle='False'") or die(mysql_error());
            $book_count = mysqli_num_rows($available_books);

            if ($book_count > 1) {
                echo "<h2>$book_count Registered Books</h2>";
            } else {
                echo "<h2>$book_count Registered Book</h2>";
            }

            ?>


            <div class="holdTable">
                <table>
                    <th>SN</th>
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
                    while ($db_field = mysqli_fetch_assoc($result)) {


                        $book_id = $db_field['book_id'];
                        $book_title = $db_field['book_title'];
                        $book_author = $db_field['book_author'];
                        $book_genre = $db_field['book_genre'];

                        $published_date = $db_field['published_date'];
                        $cover_image = $db_field['cover_image'];
                        $book_status = $db_field['book_status'];
                        $uploaded_by = $db_field['uploaded_by'];




                        echo "<tr>
        <td>$number.</td>";
                        $number = $number + 1;

                        echo "<td><a href='view_book.php?book_id=$book_id' target='_blank'><img src='book_cover/$cover_image'> <h2>$book_title</h2></a></td>
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

</body>

</html>