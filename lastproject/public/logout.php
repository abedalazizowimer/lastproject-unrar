<?php
session_start();
unset( $_SESSION['customerId']);
header("location:index.php");

?>