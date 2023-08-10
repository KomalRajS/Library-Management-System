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
<body style='background-color:#0A1828;'>
    
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
	<div class="srch" style="float:right;padding-right:30px;">
		<form class="navbar-form" method="post" name="form1">
			
				<input class="form-control" type="text" name="search" placeholder="Enter student username..." required="">
				<button style="background-color: #6db6b9e6; height:25px; width:100px;" type="submit" name="submit" >
                Search
				</button>
		</form><br>

        <form class="navbar-form" method="post" name="form2">
			
				<input class="form-control" type="text" name="usn" placeholder="Enter the starting digits of usn..." required="">
				<button style="background-color: #6db6b9e6; height:25px; width:100px;" type="submit1" name="submit1" >
                Delete
				</button>
		</form><br>
    </div>

        <?php
        if(isset($_POST['submit1']))
        {
            if(isset($_SESSION['login_user']))
            {
                $d = "SELECT * FROM student WHERE usn like '%$_POST[usn]%';";
                $res=mysqli_query($db,$d);
                if($row=mysqli_num_rows($res))
                {
                    $del = "DELETE FROM student WHERE usn like '%$_POST[usn]%';";
                    mysqli_query($db,$del);

                ?>
                    <script type="text/javascript">
                        alert("Student/s deleted successfully!")
                        window.location="student.php"
                    </script>
                <?php
                }

                else
                {
                ?>
                    <script type="text/javascript">
                        alert("Student/s not found!")
                        window.location="student.php"
                    </script>
                <?php
                }
            }
            else{
                ?>
                    <script type="text/javascript">
                        alert("You need to login first!");
                        window.location="student.php"
                    </script>
                <?php
            }
        }
        if(isset($_POST['submit']))
            {
                $q=mysqli_query($db,"SELECT * from student where username like '%$_POST[search]%' ");
    
                if(mysqli_num_rows($q)==0)
                {
                ?>
                    <script type = "text/javascript">
                        alert('Sorry! No student found. Try searching again');
                    </script>

                    <script type = "text/javascript">
                       
                        window.location="student.php"

                    </script>
                <?php
                }
                else
                {
                    echo "<table class='table table-bordered table-hover' style='margin-left:75px;'>";
                    echo "<tr style='height:55px;font-size:30px;text-align:centre;border-color:black;background-color:#ffa500; '>";
                    echo "<th style='border: 3px solid #00303F;padding: 0.5rem;color:#003366;'>";  echo "First_Name";  echo "</th>";
                    echo "<th style='border: 3px solid #00303F;padding: 0.5rem;color:#003366;'>";  echo "Last_Name";  echo "</th>";
                    echo "<th style='border: 3px solid #00303F;padding: 0.5rem;color:#003366;'>";  echo "Username";  echo "</th>";
                    echo "<th style='border: 3px solid #00303F;padding: 0.5rem;color:#003366;'>";  echo "USN";  echo "</th>";
                    echo "<th style='border: 3px solid #00303F;padding: 0.5rem;color:#003366;'>";  echo "Phone_Number";  echo "</th>";
                    echo "<th style='border: 3px solid #00303F;padding: 0.5rem;color:#003366;'>";  echo "Email-Id";  echo "</th>";
                    echo "</tr>";

                    while($row=mysqli_fetch_assoc($q))
                    {
                        echo "<tr style='background-color:#00303F; height:50px;'>";
                        echo "<td style='border: 3px solid #000;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:#6ACFC7;'>"; echo $row['firstname']; echo "</td>";
                        echo "<td style='border: 3px solid #000;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:#6ACFC7;'>"; echo $row['lastname']; echo "</td>";
                        echo "<td style='border: 3px solid #000;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:#6ACFC7;'>"; echo $row['username']; echo "</td>";
                        echo "<td style='border: 3px solid #000;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:#6ACFC7;'>"; echo $row['usn']; echo "</td>";
                        echo "<td style='border: 3px solid #000;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:#6ACFC7;'>"; echo $row['phone_number']; echo "</td>";
                        echo "<td style='border: 3px solid #000;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:#6ACFC7;'>"; echo $row['email']; echo "</td>";
                        echo "</tr>"; 
                    }

                    echo "</table>";
                }
            }
            else
            {
            
                $res=mysqli_query($db,"SELECT firstname, lastname, username, usn, phone_number, email FROM student;");

                echo "<table class='table table-bordered table-hover' style='margin-left:75px;'>";
                echo "<tr style='height:55px;font-size:30px;text-align:centre;border-color:black;background-color:#ffa500; '>";
                echo "<th style='border: 3px solid #00303F;padding: 0.5rem;color:#003366;'>";  echo "First_Name";  echo "</th>";
                echo "<th style='border: 3px solid #00303F;padding: 0.5rem;color:#003366;'>";  echo "Last_Name";  echo "</th>";
                echo "<th style='border: 3px solid #00303F;padding: 0.5rem;color:#003366;'>";  echo "Username";  echo "</th>";
                echo "<th style='border: 3px solid #00303F;padding: 0.5rem;color:#003366;'>";  echo "USN";  echo "</th>";
                echo "<th style='border: 3px solid #00303F;padding: 0.5rem;color:#003366;'>";  echo "Phone_Number";  echo "</th>";
                echo "<th style='border: 3px solid #00303F;padding: 0.5rem;color:#003366;'>";  echo "Email-Id";  echo "</th>";
                echo "</tr>";

                while($row=mysqli_fetch_assoc($res))
                {
                    echo "<tr style='background-color:#00303F; height:50px;'>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:#6ACFC7;'>"; echo $row['firstname']; echo "</td>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:#6ACFC7;'>"; echo $row['lastname']; echo "</td>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:#6ACFC7;'>"; echo $row['username']; echo "</td>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:#6ACFC7;'>"; echo $row['usn']; echo "</td>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:#6ACFC7;'>"; echo $row['phone_number']; echo "</td>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem; font-family:sans-serif;font-size:20px;color:#6ACFC7;'>"; echo $row['email']; echo "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            }

            ?>

        
    
    </div>
</body>
</html>