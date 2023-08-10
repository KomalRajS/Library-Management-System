<?php
    include "connection.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_login</title>
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
        <section>
                <nav class="login_img">

                </nav>
                <nav class="login_form">
                    <div class="login_writing">
                        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                        <img src="images/admin.png" >
                        <h1 style="font-family:Geneva;color:darkgray;text-align: center;">Admin&nbsp;Login Form</h1><br>
                        <form name="student_login" action="" method="post">
                            <img src="images/username.png"> &nbsp; <input class="form-control" type="text" name="username" placeholder="Username" required> <br> <br>
                            <img src="images/password.png"> &nbsp;<input type="password" name="password" placeholder="Password" required> <br> <br> <br>
                            &emsp; &emsp;&emsp; 
                            
                            <button style="font-family: Arial; font-weight: bolder;" type="submit" name="submit">Login</button>
                        </form>
                        <p style="color: orangered;">
                            <br>&emsp;&emsp;&emsp;&nbsp;
                            <a href="" style="color: orangered;">Forgot Password</a><br>  <br>
                            &emsp;&emsp;&emsp;&nbsp; New to website?   &nbsp;  &nbsp; 
                            <a href="admin_registration.php" style="color:orangered">  Sign Up</a>
                        </p>
                    </div>
                </nav>
           
        </section>
        <footer>

        </footer>
    </div>

    <?php
        $count = 0;
        if(isset($_POST['submit']))
        {
            echo "great";
            $res = mysqli_query($db,"SELECT * FROM admin WHERE username='$_POST[username]' && password='$_POST[password]';");
            $count = mysqli_num_rows($res);
        

        if($count == 0)
        {
            ?>
            
            <script type="text/javascript">
                alert("Invalid username or password!");
                window.location="admin_login.php"
            </script>


            <?php
        }
        else{
            $_SESSION['login_user'] = $_POST['username'];
            ?>
            <script type="text/javascript">
                window.location="admin_index.php"
            </script>

            <?php
        }
        }
    ?>

</body>
</html>