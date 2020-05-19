<?PHP include "includes/db.php";?>

<?php
session_start();
if(isset($_POST['submit'])){
    $name=$_POST['billing_name'];
    $email=$_POST['E-mail'];
    $mobile=$_POST['mobile'];
    $address=$_POST['address'];
    $account_password=$_POST['account_password'];
    $sql="INSERT INTO `customer`( `customer_name`, `customer_email`, `mobile`, `address`, `password`) VALUES ('$name','$email','$mobile','$address','$account_password')";
    mysqli_query($conn,$sql);
    $sql="SELECT `customer_id` FROM `customer` WHERE `customer_name`='$name' and `customer_email`='$email' and `mobile`='$mobile' and `address`='$address' and `password`='$account_password' ";
    $result=mysqli_query($conn,$sql);
    $admin=mysqli_fetch_assoc($result);
    if(isset($admin['customer_id']))
    {
        $_SESSION['customerId']=$admin['customer_id'];
        ob_start();
        if (isset($_SESSION['url'])) {
          header("location:".$_SESSION['url']);
        }
        else{
             header("location:index.php");
        }
       
    }
}
?>
<?php
if(isset($_POST['login']))
{
    $name=$_POST['username'];
    $password=$_POST['password'];
    $sql="SELECT `customer_id` FROM `customer` WHERE `customer_email`='$name' and `password`='$password' ";
    $result=mysqli_query($conn,$sql);
    $admin=mysqli_fetch_assoc($result);
    if(isset($admin['customer_id']))
    {
        $_SESSION['customerId']=$admin['customer_id'];
        ob_start();
     if (isset($_SESSION['url'])) {
          header("location:".$_SESSION['url']);
        }
        else{
             header("location:index.php");
        }
    }
    else{        ob_start();
        header("location:http://localhost/lastproject/public/signin.php?error=user not found");

    }
}
?>