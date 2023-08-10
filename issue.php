<?php
    include "connection.php";
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="background-color:#0A1828;">
    
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
        <div id ="mySidenav"class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="books_list"><h1 style="text-align: center; font-size:60px; color:darkred;font-family:cursive;">List of books </h1></div>
            <div style="color: white; margin-left: 60px; font-size: 20px;">

                <?php
                    if(isset($_SESSION['login_user']))
                    {  
                        echo "Welcome ".$_SESSION['login_user']; 
                    }
                ?>
            </div>
            <br><br>


  <a href="books.php"> Books </a>
  <a href="issue.php">Issue Information</a>
  <a href="student_fine.php">Fine Information</a>
</div>

<div id="main">
  
  <span style="font-size:30px;cursor:pointer;color:antiquewhite;" onclick="openNav()">&#9776;</span>


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

    <?php
        if(isset($_SESSION['login_user']))
        {
            $q = mysqli_query($db,"SELECT * FROM issue_book where username='$_SESSION[login_user]';");
            if(mysqli_num_rows($q)==0)
            {   
                ?><h2 style="text-align:center; font-size:50px;color:white;">
                <?php
                echo "There's no book requested!";
                ?></h2>

                <?php
            }

            else{
                echo "<table class='table table-bordered table-hover' style='margin-left:75px;'>";
                echo "<tr style='height:55px;font-size:30px;text-align:centre;border-color:black;background-color:#0049B7; '>";
                echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Book_ID";  echo "</th>";
                echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Approve_Status";  echo "</th>";
                echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Issue_Date";  echo "</th>";
                echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Return_Date";  echo "</th>";
                echo "</tr>";

                while($row=mysqli_fetch_assoc($q))
                {
                    echo "<tr style='background-color:#0C1A1A; height:50px;'>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;'>"; echo $row['bid']; echo "</td>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;'>"; echo $row['approve']; echo "</td>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;'>"; echo $row['issue']; echo "</td>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;'>"; echo $row['return_date']; echo "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            }
            
        }

        else{
            ?><h2 style="text-align:center; font-size:50px;color:white;">
                <?php
                echo "You need to login first!";
                ?></h2>

                <?php

        }
    ?>

    </div>
</body>
</html>