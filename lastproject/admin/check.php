<?php
require "../includes/db.php";
if (isset($_GET['email'])){
$sql = "select email from admins where email = '$_GET[email]'";
$result=mysqli_query($conn,$sql);
if($check=mysqli_fetch_assoc($result)){
echo "$check[email]";}}
if (isset($_GET['brand'])){
    $sql = "SELECT  name FROM brand WHERE name= '$_GET[brand]'";
    $result=mysqli_query($conn,$sql);
    if($check=mysqli_fetch_assoc($result)){
        echo "$check[brand]";
    }
}
?>