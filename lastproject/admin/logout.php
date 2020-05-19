<?php
session_start();
unset( $_SESSION['id']);
header("location:../A_login/index.php");
?>