<?php
    include "connection.php";
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fine</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style='background-color:#feb300;'>
    
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
                        <li><a href="logout.php">LOGOUT</a></li>
                        <li><a href="student.php">STUDENT_INFORMATION</a></li>
                        <li><a href="admin_fine.php">STUDENT_FINE</a></li>
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

                 <!--___________________search bar________________________-->
    <br>
	<div class="srch" style="float:right;padding-right:30px">
		<form class="navbar-form" method="post" name="form">
			
				<input class="form-control" type="text" name="search" placeholder="Enter student username..." required=""><br><br>
				<button style="background-color: #6db6b9e6; height:25px; width:100px;" type="submit" name="submit" >
                Search
				</button>
		</form><br><br>

        <form class="navbar-form" method="post" name="form">
			
				<input class="form-control" type="text" name="usn" placeholder="Enter starting digits of usn..." required=""><br><br>
				<button style="background-color: #6db6b9e6; height:25px; width:100px;" type="submit2" name="submit2" >
                Search
				</button>
		</form><br>

    <br><br><br>

		<form class="navbar-form" method="post" name="form1">
			
				<input class="form-control" type="text" name="username" placeholder="Enter student username..." required=""><br><br>
				<input class="form-control" type="text" name="bid" placeholder="Enter Book Id..." required=""><br><br>
				<button style="background-color: #6db6b9e6; height:25px; width:100px;" type="submit1" name="submit1" >
                PAID
				</button>
		</form><br><br><br>

        <form class="navbar-form" method="post" name="form1">
			
                <input class="form-control" type="text" name="usn" placeholder="Enter starting digits of usn..." required=""><br><br>
				<button style="background-color: #6db6b9e6; height:25px; width:300px;" type="del" name="del" >
                DELETE NON-MEMBERS if PAID
				</button>
		</form><br>
    </div>

        <?php
        if(isset($_SESSION['login_user']))
        {
        if(isset($_POST['submit1']))
        {
            mysqli_query($db,"UPDATE fines SET status='Paid' WHERE username='$_POST[username]' AND bid = '$_POST[bid]';");
        }

        if(isset($_POST['del']))
        {
            mysqli_query($db,"DELETE FROM fines WHERE status='Paid' and usn='$_POST[usn]';");
        }

        if(isset($_POST['submit'])||isset($_POST['submit2']))
            {
                if(isset($_POST['submit']))
                {
                $q=mysqli_query($db,"SELECT * from fines where username like '%$_POST[search]%' WHERE fine>0 ORDER BY fines.returned DESC;");
                }

                if(isset($_POST['submit1']))
                {
                $q=mysqli_query($db,"SELECT * from fines where usn like '%$_POST[usn]%' WHERE fine>0 ORDER BY fines.returned DESC;");
                }
    
                if(mysqli_num_rows($q)==0)
                {
                ?>
                    <script type = "text/javascript">
                        alert('Sorry! No student found. Try searching again');
                    </script>

                    <script type = "text/javascript">
                       
                        window.location="admin_fine.php"

                    </script>
                <?php
                }
                else
                {
                    echo "<table class='table table-bordered table-hover' style='margin-left:75px;'>";
                    echo "<tr style='height:55px;font-size:25px;text-align:centre;border-color:black;background-color: #fff5d7; '>";
                    echo "<th style='border: 3px solid #2d545e;padding: 0.5rem;color:orange;'>";  echo "Username";  echo "</th>";
                    echo "<th style='border: 3px solid #2d545e;padding: 0.5rem;color:orange;'>";  echo "USN";  echo "</th>";
                    echo "<th style='border: 3px solid #2d545e;padding: 0.5rem;color:orange;'>";  echo "Book_Id";  echo "</th>";
                    echo "<th style='border: 3px solid #2d545e;padding: 0.5rem;color:orange;'>";  echo "Returned";  echo "</th>";
                    echo "<th style='border: 3px solid #2d545e;padding: 0.5rem;color:orange;'>";  echo "Days_delayed";  echo "</th>";
                    echo "<th style='border: 3px solid #2d545e;padding: 0.5rem;color:orange;'>";  echo "Fine(₹)";  echo "</th>";
                    echo "<th style='border: 3px solid #2d545e;padding: 0.5rem;color:orange;'>";  echo "Status";  echo "</th>";
                    echo "</tr>";

                    while($row=mysqli_fetch_assoc($q))
                    {
                        echo "<tr style='background-color:#ff5e6c; height:50px;'>";
                        echo "<td style='border: 3px solid #2d545e;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:black;'>"; echo $row['username']; echo "</td>";
                        echo "<td style='border: 3px solid #2d545e;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:black;'>"; echo $row['usn']; echo "</td>";
                        echo "<td style='border: 3px solid #2d545e;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:black;'>"; echo $row['bid']; echo "</td>";
                        echo "<td style='border: 3px solid #2d545e;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:black;'>"; echo $row['returned']; echo "</td>";
                        echo "<td style='border: 3px solid #2d545e;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:black;'>"; echo $row['days']; echo "</td>";
                        echo "<td style='border: 3px solid #2d545e;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:black;'>"; echo $row['fine']; echo "</td>";
                        echo "<td style='border: 3px solid #2d545e;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:black;'>"; echo $row['status']; echo "</td>";
                        echo "</tr>"; 
                    }

                    echo "</table>";
                }
            }
            else
            {
            
                $res=mysqli_query($db,"SELECT * FROM fines WHERE fine>0 ORDER BY returned DESC;");

                echo "<table class='table table-bordered table-hover' style='margin-left:75px;'>";
                echo "<tr style='height:55px;font-size:25px;text-align:centre;border-color:black;background-color: #fff5d7; '>";
                echo "<th style='border: 3px solid #2d545e;padding: 0.5rem;color:orange;'>";  echo "Username";  echo "</th>";
                echo "<th style='border: 3px solid #2d545e;padding: 0.5rem;color:orange;'>";  echo "USN";  echo "</th>";
                echo "<th style='border: 3px solid #2d545e;padding: 0.5rem;color:orange;'>";  echo "Book_Id";  echo "</th>";
                echo "<th style='border: 3px solid #2d545e;padding: 0.5rem;color:orange;'>";  echo "Returned";  echo "</th>";
                echo "<th style='border: 3px solid #2d545e;padding: 0.5rem;color:orange;'>";  echo "Days_delayed";  echo "</th>";
                echo "<th style='border: 3px solid #2d545e;padding: 0.5rem;color:orange;'>";  echo "Fine(₹)";  echo "</th>";
                echo "<th style='border: 3px solid #2d545e;padding: 0.5rem;color:orange;'>";  echo "Status";  echo "</th>";
                echo "</tr>";

                while($row=mysqli_fetch_assoc($res))
                {
                    echo "<tr style='background-color:#ff5e6c; height:50px;'>";
                    echo "<td style='border: 3px solid #2d545e;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:black;'>"; echo $row['username']; echo "</td>";
                    echo "<td style='border: 3px solid #2d545e;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:black;'>"; echo $row['usn']; echo "</td>";
                    echo "<td style='border: 3px solid #2d545e;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:black;'>"; echo $row['bid']; echo "</td>";
                    echo "<td style='border: 3px solid #2d545e;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:black;'>"; echo $row['returned']; echo "</td>";
                    echo "<td style='border: 3px solid #2d545e;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:black;'>"; echo $row['days']; echo "</td>";
                    echo "<td style='border: 3px solid #2d545e;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:black;'>"; echo $row['fine']; echo "</td>";
                    echo "<td style='border: 3px solid #2d545e;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:black;'>"; echo $row['status']; echo "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            }
        }

        else{
            ?><h2 style="text-align:center; font-size:50px;">
                <?php
                echo "You need to login first!";
                ?></h2>

                <?php
        }

            ?>

        <br>
        <br>
        <br><br><br>
    
    </div>
</body>
</html>`    