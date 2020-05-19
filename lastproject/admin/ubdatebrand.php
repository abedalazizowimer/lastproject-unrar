<?php
session_start();
    require "../includes/db.php";
        $sql = "UPDATE brand SET name='$_GET[brand]' WHERE brand_id=$_GET[id]";
$c = GETCWD();
rename($c . "/images/$_GET[oldname]",$c . "/images/$_GET[brand]");

if (mysqli_query($conn, $sql)) {
            echo $_GET['brand'];
        }
        else {
            echo "fail";
        }
?>
