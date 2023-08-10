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
        <section style="height:708px;">
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
</div>

    <?php
        if(isset($_SESSION['login_user']))
        {
            
            $ret = '<p style="color:yellow;background-color:green;">Returned</p>';

            $res = mysqli_query($db,"SELECT * FROM issue_book WHERE username='$_SESSION[login_user]' AND approve = '$ret';");
            
            $day = 0;
            $books = 0;

            while($row=mysqli_fetch_assoc($res))
            {
                $d = strtotime($row['return_date']);
                $c = strtotime(date("Y-m-d"));
                $diff = $c+1-$d;

                if($diff>0)
                {
                    
                    $books = $books + 1;
                    $day = $day + floor($diff/(60*60*24));   //days
                    
                    
                }
            }
            $fine = $day*1;
            $_SESSION['fine'] = $fine;

        
        $var = 0;
        $result = mysqli_query($db,"SELECT * FROM fines WHERE username='$_SESSION[login_user]' AND status = 'not paid';");
            while($row = mysqli_fetch_assoc($result))
            {
                $var = $var + $row['fine'];
            }
            $actual_fine = $var + $fine;
        ?>
        <nav class="signup_left"><br><br><br><br><br><br><br><br><br><br>
                    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<img src="images/fine.jpg" height="100px" width="200px"><br><br>
                    <div class="signup_left_writing">
                        <h1 style="text-align: center;font-family:sans-serif;font-weight: bolder;font-size: 50px;">Delay Fine Information</h1><br>
                    </div>
                </nav>
                <nav class="signup_form">
                    <div class="addbook_writing" style="opacity:1;">
                       <br><br><br><br><br><br><br>
                       <h2 style="font-size: 25px;">Number of books overdued : <?php echo "$books"; ?></h2><br><br><br><br>
                       <h2 style="font-size: 25px;">Number of days delayed : <?php echo "$day"; ?></h2><br><br><br><br>
                       <h2 style="font-size: 30px;">Total fine : ₹<?php echo "$_SESSION[fine]"; ?></h2>
                        
                    </div>
                </nav>
                <?php
        }

        else{
            ?><h2 style="text-align:center; font-size:50px;color:white;">
                <?php
                echo "You need to login first!";
                ?></h2>

                <?php
        }
        ?>
    </section>
    <footer>

    </footer>
    </div>
</body>
</html>