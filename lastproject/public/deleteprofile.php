<?PHP include "includes/db.php";?>
<?php
session_start();
$sql="DELETE FROM `customer` WHERE `customer_id`=$_GET[id]";
mysqli_query($conn,$sql);
unset($_SESSION['customerId']);
?>