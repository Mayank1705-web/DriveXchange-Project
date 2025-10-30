<?php
    session_start();
    $_SESSION ['login_status'] = false;
    $conn = new mysqli("localhost","root","","project",3306);
    $sql_result= mysqli_query($conn, "select * from user where username = '$_POST[username]' and password = '$_POST[password]'");
    $dbrow = mysqli_fetch_array($sql_result);
    if (mysqli_num_rows($sql_result)>0) {
        echo "Login Successful";
        $_SESSION['login_status'] = true;
        if ($dbrow["usertype"]=="Seller") {
            header("Location:../Seller/home.php");
        } else if ($dbrow["usertype"]=="Buyer") {
            header("Location:../Buyer/home.php");
        }
    } else {
        echo "Invalid Credentials";
    }
?>