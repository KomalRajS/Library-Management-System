<?php
    session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="wrapper">
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
                        <li><a href="index.php">HOME</a></li>
                        <li><a href="books.php">BOOKS</a></li>
                        <li><a href="logout.php">LOGOUT</a></li>
                        <li><a href="feedback.php">FEEDBACK</a></li>
                    </ul>
                </nav>
                <?php
                }

                else{?>
                    <nav>
                    <ul>
                        <li><a href="index.php">HOME</a></li>
                        <li><a href="books.php">BOOKS</a></li>
                        <li><a href="student_login.php">STUDENT_LOGIN</a></li>
                        <li><a href="admin_login.php">ADMIN_LOGIN</a></li>
                        <li><a href="feedback.php">FEEDBACK</a></li>
                    </ul>
                    </nav>
                <?php   
                }
            ?>
            
        </header>
        <section>
            <div class="index_section">
                <br><br><br><br><br><br>
                <div class="box">
                     <br><br>
                     <h1 style="text-align: center;font-size: 20px;color:#fbfcfb;">Welcome  To  The</h1>
                     <div class="heading"><h1 style="text-align: center;font-size: 30px; font-family:'Times New Roman';color:#fbfcfb;">Advanced  Library</h1><br><br></div>
                     <h1 style="text-align: center;font-size: 20px;">Opens at : 9:00 AM</h1><br>
                     <h1 style="text-align: center;font-size: 20px;">Closes at : 9:00 PM</h1><br>
                </div>
                <br><br><br><br><br><br><br>
            </div>    
        </section>
        <footer>

        </footer>
    </div>
</body>
</html>