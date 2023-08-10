<?php

    $db = mysqli_connect("localhost","root","","library");     //server_name,username,password,database

    if(!$db)
    {
        die("Connection failed : ".mysqli_connect_error());
    }

    

?>