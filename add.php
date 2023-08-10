<?php
    include "connection.php";
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add_Books</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
    <div class="wrapper" style="height: 860px;" >
        <header>
            <div class="logo">
                <img src="images/logo.png">
                <h1 style="color: white;">LIBRARY MANAGEMENT SYSTEM</h1>
            </div>
            <?php
                if(isset($_SESSION['login_user']))
                {?>
                
                <nav>
                    <ul>
                        <li style="color:white"><?php echo($_SESSION['login_user']); ?> |</li>
                        <li><a href="admin_index.php">HOME</a></li>
                        <li><a href="admin_books.php">BOOKS</a></li>
                        <li><a href="student.php">STUDENT_INFORMATION</a></li>
                        <li><a href="admin_fine.php">STUDENT_FINE</a></li>
                        <li><a href="logout.php">LOGOUT</a></li>
                        <li><a href="admin_feedback.php">FEEDBACK</a></li>
                    </ul>
                </nav>
                <?php
                }

                else{?>
                    <nav>
                    <ul>
                        <li><a href="admin_index.php">HOME</a></li>
                        <li><a href="admin_books.php">BOOKS</a></li>
                        <li><a href="admin_login.php">ADMIN_LOGIN</a></li>
                        <li><a href="student.php">STUDENT_INFORMATION</a></li>
                        <li><a href="admin_fine.php">STUDENT_FINE</a></li>
                        <li><a href="admin_feedback.php">FEEDBACK</a></li>
                    </ul>
                    </nav>
                <?php   
                }
            ?>

            
        </header>
       
        <div id ="mySidenav"class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
           
            <div style="color: white; margin-left: 60px; font-size: 20px;">

                <?php
                    if(isset($_SESSION['login_user']))
                    {  
                        echo "Welcome ".$_SESSION['login_user']; 
                    }
                ?>
            </div>
            <br><br>

            <a href="admin_books.php">Books</a>
            <a href="add.php">Add Books</a>
            <a href="admin_request.php">Book Request</a>
            <a href="admin_issue">Issue Information</a>
            <a href="admin_expire.php">Expired/Returned List</a>
            
            </div> 

            <div id="main">
  
                <span style="font-size:30px;cursor:pointer;" onclick="openNav()">&#9776;</span>


                <script>
                        function openNav() {
                        document.getElementById("mySidenav").style.width = "300px";
                        document.getElementById("main").style.marginLeft = "300px";
                        document.body.style.backgroundColor = "rgb(0,0,0,0.4)";
                        }

                function closeNav() {
                        document.getElementById("mySidenav").style.width = "0";
                        document.getElementById("main").style.marginLeft= "0";
                        document.body.style.backgroundColor = "#0A1828";
                        }
                </script>
            </div>
            
            <section style="height:628px;">
            <div class="addbook_bg">
                <nav class="signup_left"><br><br><br><br><br><br><br><br><br><br>
                    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<img src="images/addbook.png" height="100px" width="200px"><br><br>
                    <div class="signup_left_writing">
                        <h1 style="text-align: center;font-family:sans-serif;font-weight: bolder;font-size: 50px;">Add books</h1><br>
                    </div>
                </nav>
                <nav class="signup_form">
                    <div class="addbook_writing" style="opacity:1;">
                       
                        <form name="signup" action="" method="post">
                            BOOK ID<br>
                            <input type="text" name="bid" placeholder="Book ID" required > <br> <br>
                            BOOK NAME<br> 
                            <input type="text" name="name" placeholder="Book Name" required> <br> <br>
                            AUTHORS<br> 
                            <input type="text" name="authors" placeholder="Authors" required> <br> <br>
                            EDITION<br> 
                            <input type="text" name="edition" placeholder="Edition" required> <br> <br>
                            STATUS<br> 
                            <input type="text" name="status" placeholder="Status" required> <br> <br>
                            QUANTITY<br> 
                            <input type="text" name="quantity" placeholder="Quantity" required> <br> <br>
                            DEPARTMENT<br>  
                            <input type="text" name="department" placeholder="Department" required> <br> <br>  
                           
                            
                            <button style="font-family: Arial; font-weight: bolder;color: white;background-color: darkgreen; height:25px; width:100px;" type="submit" name="submit">ADD</button>
                        </form>
                        <p style="font-size: medium;">
                            <br><br>
    
                        </p>
                    </div>
                </nav>
            </div>
        </section>
        
        <?php

            if(isset($_POST['submit']))
            {
                if(isset($_SESSION['login_user']))
                {
                    $sql = "INSERT INTO book VALUES('$_POST[bid]','$_POST[name]','$_POST[authors]','$_POST[edition]','$_POST[status]','$_POST[quantity]','$_POST[department]')"; 
                    mysqli_query($db,$sql);

                    ?>
                    <script type="text/javascript">
                        alert("Book added successfully");
                    </script>

                    <?php
                }

                else{
                ?>
                    <script type="text/javascript">
                        alert("You need to login!");
                    </script>
                <?php

                }
            }

        ?>


        <footer>

        </footer>
   

</body>
</html>