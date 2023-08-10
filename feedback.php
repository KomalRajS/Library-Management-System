<?php
    include "connection.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
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
        <section style="background-color:#ffde22;"> 
            <h1 style="text-align:center; font-family:cursive;font-size:30px">Drop down your suggestions and questions!</h1>
            <br><br>
    
            <div style="background-color:#ff414e; height:300px; width: 900px; margin-left: 215px; margin-right:215px;">
                <form name="student_login" action="" method="post">
                    <br><br>
                    &emsp; &emsp;&emsp; &nbsp; <input type="text" name="username" placeholder="Username" required style=" opacity:0.7; background-color:white; font-family:cursive;"> <br> <br>
                    &emsp; &emsp;&emsp; &nbsp; <input type="email" name="email" placeholder="Email Id" required style=" opacity:0.7; background-color:white; font-family:cursive;"> <br> <br> 
                    &emsp; &emsp;&emsp; &nbsp;<input type="text" name="comment" placeholder="Write something..." required style="height:100px; width:775px; font-size:20px; opacity:0.7; background-color:white; font-family:cursive;"> <br> <br> <br>

                    &emsp; &emsp;&emsp; &nbsp;
                            
                    <button style="font-family:'Gill Sans'; background-color: blue; color: white; font-weight: bolder;font-size:x-large; height:30px; width:150px;" type="submit" name="submit">Submit</button>
                </form>
            </div>
            

        </section>
        <footer>

        </footer>
    </div>

    <?php
        if(isset($_POST['submit']))
        {
            echo "great";
            $sql = "INSERT INTO feedback VALUES('$_POST[username]','$_POST[email]','$_POST[comment]','');";
            mysqli_query($db,$sql);
                
        }
    ?>

</body>
</html>