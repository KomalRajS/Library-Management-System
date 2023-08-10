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

  <a href="books.php">Books</a>
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
        <!--___________________search bar________________________-->
    <br>
	<div class="srch" style="float:right;padding-right:30px;">
		<form class="navbar-form" method="post" name="form1">
			
				<input class="form-control" type="text" name="search" placeholder="search books.." required="">
				<button style="background-color: #6db6b9e6; height:25px; width:100px;" type="submit" name="submit" >
                Search
				</button>
		</form><br>
    <!--___________________request bar_____________________-->
    
        <form class="navbar-form" method="post" name="form2">
			
				<input class="form-control" type="text" name="bid" placeholder="Enter the book Id..." required="">
				<button style="background-color: #6db6b9e6; height:25px; width:100px;" type="submit1" name="submit1" >
                Request
				</button><br><br>
		</form>
	</div>
             
            <?php
            if(isset($_POST['submit']))
            {
                $q=mysqli_query($db,"SELECT * from book where name like '%$_POST[search]%' ");
    
                if(mysqli_num_rows($q)==0)
                {
                ?>
                    <script type = "text/javascript">
                        alert('Sorry! No book found. Try searching again');
                       // window.location="books.php"

                    </script>

                    <script type = "text/javascript">
                       // alert('Sorry! No book found. Try searching again');
                        window.location="books.php"

                    </script>
                <?php
                }
                else
                {
                    echo "<table class='table table-bordered table-hover' style='margin-left:75px;'>";
                    echo "<tr style='height:55px;font-size:30px;text-align:centre;border-color:black;background-color:#0049B7; '>";
                    echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Book_ID";  echo "</th>";
                    echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Book_Name";  echo "</th>";
                    echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Authors";  echo "</th>";
                    echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Edition";  echo "</th>";
                    echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Status";  echo "</th>";
                    echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Quantity";  echo "</th>";
                    echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Department";  echo "</th>";
                    echo "</tr>";

                    while($row=mysqli_fetch_assoc($q))
                    {
                        echo "<tr style='background-color:#0C1A1A; height:50px;'>";
                        echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;'>"; echo $row['bid']; echo "</tud>";
                        echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;'>"; echo $row['name']; echo "</tud>";
                        echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;'>"; echo $row['authors']; echo "</tud>";
                        echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;'>"; echo $row['edition']; echo "</tud>";
                        echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;'>"; echo $row['status']; echo "</tud>";
                        echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;'>"; echo $row['quantity']; echo "</tud>";
                        echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;'>"; echo $row['department']; echo "</tud>";
                        echo "</tr>";
                    }

                    echo "</table>";
                }
            }
            else
            {
                $res=mysqli_query($db,"SELECT * FROM book ORDER BY book.bid ASC;");

                echo "<table class='table table-bordered table-hover' style='margin-left:75px;'>";
                echo "<tr style='height:55px;font-size:30px;text-align:centre;border-color:black;background-color:#0049B7; '>";
                echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Book_ID";  echo "</th>";
                echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Book_Name";  echo "</th>";
                echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Authors";  echo "</th>";
                echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Edition";  echo "</th>";
                echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Status";  echo "</th>";
                echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Quantity";  echo "</th>";
                echo "<th style='border: 3px solid #000;padding: 0.5rem;color:#EFFAFD;'>";  echo "Department";  echo "</th>";
                echo "</tr>";

                while($row=mysqli_fetch_assoc($res))
                {
                    echo "<tr style='background-color:#0C1A1A; height:50px;'>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;'>"; echo $row['bid']; echo "</tud>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;'>"; echo $row['name']; echo "</tud>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;'>"; echo $row['authors']; echo "</tud>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;'>"; echo $row['edition']; echo "</tud>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;'>"; echo $row['status']; echo "</tud>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;'>"; echo $row['quantity']; echo "</tud>";
                    echo "<td style='border: 3px solid #000;padding: 0.5rem;color:#6ACFC7;'>"; echo $row['department']; echo "</tud>";
                    echo "</tr>";
                }
                echo "</table>";
            }

                

                if(isset($_POST['submit1']))
                {
                    if(isset($_SESSION['login_user']))
                    {
                        $d = "SELECT * FROM book WHERE bid = '$_POST[bid]';";
                        $res=mysqli_query($db,$d);
                        if($row=mysqli_num_rows($res))
                        {
                            mysqli_query($db,"INSERT INTO issue_book  VALUES('$_SESSION[login_user]','$_POST[bid]','','','');");
                        ?>
                        <script type="text/javascript">
                           
                           alert('Book Requested!');
                           window.location = "books.php"
                           
                       </script>
                        <?php
                        }

                        else
                        {
                        ?>
                        <script type="text/javascript">
                        alert("Book not found!")
                        window.location="books.php"
                        </script>
                        <?php
                        }
                    }

                    else{
                        ?>
                        <script type="text/javascript">
                           
                            alert('You need to login first!');
                            window.location = "books.php"
                            
                        </script>
    
                        
                        <?php
                    }
                }

                

            ?>

        
    
    </div>
</body>
</html>