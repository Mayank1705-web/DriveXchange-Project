<?php

    $conn = new mysqli("localhost","root","","project",3306);

    $status = mysqli_query($conn,"insert into user(username,password, usertype, mailid)values('$_POST[username]','$_POST[password]','$_POST[usertype]','$_POST[mailid]')");

    if($status) {
        echo "<br> User signin Success";
    } else {
        echo "<br>Error in Signin</br>";
    }
    header("Location:home.html");
?>