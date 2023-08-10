<?php
    include "connection.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student_login</title>
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
                        <li><a href="admin_login.php">ADMIN_LOGIN</a></li>
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
                <nav class="login_img">

                </nav>
                <nav class="login_form">
                    <div class="login_writing">
                        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                        <img src="images/student.png" >
                        <h1 style="font-family:Geneva;color:coral;text-align: center;">Student&nbsp;Login Form</h1><br>
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
                            <a href="registration.php" style="color:orangered">  Sign Up</a>
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
            $res = mysqli_query($db,"SELECT * FROM student WHERE username='$_POST[username]' && password='$_POST[password]';");
            $count = mysqli_num_rows($res);
        

        if($count == 0)
        {
            ?>
            
            <script type="text/javascript">
                alert("Invalid username or password!");
                window.location="student_login.php"
            </script>


            <?php
        }
        else{
            $_SESSION['login_user'] = $_POST['username'];
            ?>
            <script type="text/javascript">
                window.location="index.php"
                
            </script>

            <?php
        }
        }
    ?>

</body>
</html>