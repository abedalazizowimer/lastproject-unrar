<?php
require "../includes/db.php";
if (isset($_GET['email'])){
    $sql = "SELECT `customer_email` FROM `customer` WHERE customer_email = '$_GET[email]'";
    $result=mysqli_query($conn,$sql);
    if($check=mysqli_fetch_assoc($result)){
        echo "$check[customer_email]";}
}
?>