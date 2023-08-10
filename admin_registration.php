<?php

    include "connection.php";
  

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="wrapper" style="height: 860px;">
        <header>
            <div class="logo">
                <img src="images/logo.png">
                <h1 style="color: white;">LIBRARY MANAGEMENT SYSTEM</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="admin_index.php">HOME</a></li>
                    <li><a href="admin_books.php">BOOKS</a></li>
                    <li><a href="student_login.php">STUDENT_LOGIN</a></li>
                    <li><a href="admin_login.php">ADMIN_LOGIN</a></li>
                    <li><a href="admin_feedback.php">FEEDBACK</a></li>
                </ul>
            </nav>
        </header>
        <section style="height: 628px;">
            <div class="signup_bg">
                <nav class="signup_left"><br><br><br>
                    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<img src="images/signupicon.png" ><br><br>
                    <div class="signup_left_writing">
                        <h1 style="text-align: center;font-family:sans-serif;font-weight: bolder;font-size: 50px;">Sign Up</h1><br><br><br>
                        <h2 style="text-align: center;font-family:cursive;font-weight: 500;font-size: 30px;">Start your journey Today</h2>
                    </div>
                    </nav>
                <nav class="signup_form">
                    <div class="signup_writing">
                       
                        <form name="signup" action="" method="post">
                            <input type="text" name="firstname" placeholder="*First Name" required > <br> <br>
                            <input type="text" name="lastname" placeholder="Last Name"> <br> <br>
                            <input type="text" name="username" placeholder="*Username" required> <br> <br>
                            <input type="password" name="password" placeholder="*Password" required> <br> <br>

                            <input type="text" name="phone_number" placeholder="*Contact Number" required> <br> <br> 
                            <input type="email" name="email" placeholder="*E-mail Id" required> <br> <br> <br>
                            
                            <button style="font-family: Arial; font-weight: bolder;color: darkblue;" type="submit" name="submit">Sign-Up</button>
                        </form>
                        <p style="font-size: medium;">
                            <br><br>
                            * Compulsory to enter
                        </p>
                    </div>
                </nav>
            </div>
        </section>
        


        <footer>

        </footer>
    </div>
    <div>
    <?php

        $count = 0;
        $res = mysqli_query($db,"SELECT username FROM admin ");
        while($row = mysqli_fetch_assoc($res))
        {
            if($row['username']==$_POST['username'])
            {
                $count=$count+1;
            }
        }

        
        if(isset($_POST['submit']))
        {
        if($count==0)
        {
            
                echo "great";
                mysqli_query($db,"INSERT INTO admin VALUES('$_POST[firstname]','$_POST[lastname]','$_POST[username]','$_POST[password]','','$_POST[phone_number]','$_POST[email]');");
            

        ?>

            <script type="text/javascript">
              alert("Registration successful!")
              window.location="admin_login.php"
            </script>

            <?php
        }
        else{
            ?>
            <script type="text/javascript">
                alert("Username already exists!")
                window.location="admin_registration.php"
            </script>
        
       
            <?php
        }
    }
    ?>
    </div>

</body>
</html>