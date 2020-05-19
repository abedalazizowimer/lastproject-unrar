<?php
require "../includes/db.php";
$sql = "DELETE FROM cars WHERE car_id= $_GET[delete]";
$result=mysqli_query($conn,$sql);
echo $sql;
?>