<?php
session_start();
if($_FILES["file-input"]["name"] != '') {
    require "../includes/db.php";
    $location = './images/admin_image/' . $_FILES["file-input"]["name"];
   if( move_uploaded_file($_FILES["file-input"]["tmp_name"], $location)){
    $sql = "UPDATE admins SET image='{$_FILES['file-input']['name']}' where id=$_SESSION[id]";
    if (mysqli_query($conn, $sql)) {
        echo $_FILES['file-input']['name'];
    } else {
        echo "$sql";
    }}
}?>
