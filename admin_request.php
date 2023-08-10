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
<body style="background-color: #0A1828;">
    
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
                        <li><a href="student.php">STUDENT_INFORMATION</a></li>
                        <li><a href="admin_fine.php">STUDENT_FINE</a></li>
                        <li><a href="admin_login.php">ADMIN_LOGIN</a></li>
                        <li><a href="admin_feedback.php">FEEDBACK</a></li>
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


  <a href="admin_books.php"> Books </a>
  <a href="add.php">Add Books </a>
  <a href="admin_request.php">Request Information</a>
  <a href="admin_issue.php">Issue Information</a>
  <a href="admin_expire.php">Expired/Returned List</a>
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

        <!--___________________search bar________________________-->
        <br>

	<div class="srch" style="float:right;padding-right:30px;">
		<form class="navbar-form" method="post" name="form1">
			
				<input class="form-control" type="text" name="username" placeholder="student_username..." required=""> <br><br>
				<input class="form-control" type="text" name="bid" placeholder="book_Id.." required=""> <br><br>
				<button style="background-color: #6db6b9e6; height:25px; width:200px;color: #fff5d7;" type="submit" name="submit" >
                Proceed to Approve
				</button>
		</form><br><br>
    </div>

    <?php
        if(isset($_SESSION['login_user']))
        {
            $q = mysqli_query($db,"SELECT student.username,usn,firstname, book.bid,name,authors,edition,status FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN book ON book.bid=issue_book.bid WHERE issue_book.approve='';");
            if(mysqli_num_rows($q)==0)
            {   
                ?><h2 style="text-align:center; font-size:50px;color:white;">
                <?php
                echo "There's no pending request!";
                ?></h2>

                <?php
            }
            else{
                echo "<table class='table table-bordered table-hover' style='margin-left:75px;'>";
                echo "<tr style='height:55px;font-size:30px;text-align:centre;border-color:black; background-color:#0049B7'>";
                echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Username";  echo "</th>";
                echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "USN";  echo "</th>";
                echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Name";  echo "</th>";
                echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Book_ID";  echo "</th>";
                echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Book_Name";  echo "</th>";
                echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Authors";  echo "</th>";
                echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Edition";  echo "</th>";
                echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Status";  echo "</th>";
                echo "</tr>";

                while($row=mysqli_fetch_assoc($q))
                {
                    echo "<tr style='background-color:#0C1A1A; ; height:50px;'>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;font-size:20px;'>"; echo $row['username']; echo "</td>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;font-size:20px;'>"; echo $row['usn']; echo "</td>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;font-size:20px;'>"; echo $row['firstname']; echo "</td>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;font-size:20px;'>"; echo $row['bid']; echo "</td>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;font-size:20px;'>"; echo $row['name']; echo "</td>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;font-size:20px;'>"; echo $row['authors']; echo "</td>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;font-size:20px;'>"; echo $row['edition']; echo "</td>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;font-size:20px;'>"; echo $row['status']; echo "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            }
           
            if(isset($_POST['submit']))
            {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['bid'] = $_POST['bid'];
                
                $res = mysqli_query($db,"SELECT quantity FROM book WHERE bid = '$_SESSION[bid]';");
                    while($row=mysqli_fetch_assoc($res))
                    {
                        if($row['quantity'] == 0)
                        {
                            ?>
                            <script type='text/javascript'>
                                alert('Sorry, the book is not available!!!');
                                window.location="admin_request.php"
                            </script>
                            <?php
                        }

                        else{

                    
                    
                            ?>
                            <script type="text/javascript">
                                window.location="approve.php";
                            </script>
                            <?php
                        }
                    }
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

    </div>
</body>
</html>