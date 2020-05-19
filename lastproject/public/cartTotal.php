<?php
session_start();
$subTotal = $_GET['price'] * $_GET['qty'];
unset($_SESSION['quantity'][$_GET['id']]);
$_SESSION['quantity'][$_GET['id']]=$_GET['qty'];
echo $subTotal;

?>