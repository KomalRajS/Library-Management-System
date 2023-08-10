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
<body style="background-color: #eb1736;">
    
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

  <a href="admin_books.php">Books</a>
  <a href="add.php">Add Books</a>
  <a href="admin_request.php">Book Request</a>
  <a href="admin_issue.php">Issue Information</a>
  <a href="admin_expire.php">Expired/Returned List</a>
</div>

<div id="main">
  
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>


<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "300px";
  document.getElementById("main").style.marginLeft = "300px";
  document.body.style.backgroundColor = "rgb(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "#fff68f";
}
</script>
	<!--___________________search bar________________________-->

    <br>
	<div class="srch" style=" width:760px; margin-left:300px; margin-top:50px; background-color:black; opacity:0.8; color:gold; font-size:20px">
		<form class="navbar-form" method="post" name="form1">
			<br><br>
                <h2 style="margin-left:200px;";>Approve the request?</h2>
				<input class="form-control" style="margin-left:200px; height:50px; width:340px;" type="text" name="approve" placeholder="Type Yes..." required=""><br><br>
                <h2 style="margin-left:200px;";>Issue Date</h2>
				<input class="form-control" style="margin-left:200px; height:50px; width:340px;" type="date" name="issue_date" placeholder="search books.." required=""><br><br>
                <h2 style="margin-left:200px;";>Return Date</h2>
				<input class="form-control" style="margin-left:200px; height:50px; width:340px;" type="date" name="return_date" placeholder="search books.." required=""><br><br>
				
                <button style="background-color: darkblue; margin-left:200px; height:45px; width:100px; color:azure;" type="submit" name="submit" >
                SUBMIT
				</button>

		</form><br><br>
    
	</div>
 
            <br><br><br>
            <?php
                if(isset($_POST['submit']))
                {
                    mysqli_query($db,"UPDATE issue_book SET approve = '$_POST[approve]', issue = '$_POST[issue_date]', return_date = '$_POST[return_date]' where username = '$_SESSION[username]' and bid = '$_SESSION[bid]';");
                
                    mysqli_query($db,"UPDATE book SET quantity = quantity-1 WHERE bid = '$_SESSION[bid]';");
                  

                    $res = mysqli_query($db,"SELECT quantity FROM book WHERE bid = '$_SESSION[bid]';");
                    while($row=mysqli_fetch_assoc($res))
                    {
                        if($row['quantity'] == 0)
                        {
                            mysqli_query($db,"UPDATE book SET status = 'Not Available' WHERE bid='$_SESSION[bid]';");
                        }
                    }

                    ?>
                        <script type='text/javascript'>
                            alert('Approved successfully!!!');
                            window.location="admin_request.php"
                        </script>
                    <?php
                }
            ?>

        
    
    </div>
</body>
</html>