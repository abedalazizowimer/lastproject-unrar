<?PHP include "includes/header.php";
if(empty($_SESSION['customerId'])) {
    ob_start();
  echo("<script>location.href = 'login.php';</script>");
}?>
<button class="btn btn-primary" id="editbtn" style="width: 20%;margin-bottom: 20px">edit</button>
<form method="post"> <button type="" value="<?=$_SESSION['customerId'];?>" class="btn btn-danger" name="delete" id="delete" style="width: 20%;margin-bottom: 30px">delete</button></form>
<?PHP include "includes/db.php";?>

<?php
if(isset($_POST['submit'])){

    $name=$_POST['name'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $address=$_POST['address'];
    $sql="UPDATE `customer` SET `customer_name`='$name',`customer_email`='$email',`mobile`='$mobile',`address`='$address',`password`='$password' WHERE customer_id=$_SESSION[customerId]";
    mysqli_query($conn,$sql);
    ob_start();

    header("location:profile.php");
}
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#Email").change(function () {
            var email = $("#Email").val();
            if (email != "") {
                $.ajax({
                    type: "GET",
                    url: "checkemail.php?email=" + email,
                    success: function (data) {
                        if (data != "") {
                            $("#email1").html("<div class='badge bg-red' >email exist</div>");
                            $("#save").prop("disabled", true);
                        } else {
                            $("#email1").html("<div class='badge bg-green' >Accepted</div>");
                            $("#save").prop("disabled", false);
                        }
                    }
                })
            }
        });
        $("#editbtn").click(function () {
            $("#edit").css("visibility","visible");
        })

        $("#delete").click(function () {
            var id = $("#delete").val();

            $.ajax({
                type: "GET",
                url: "deleteprofile.php?id="+id,
                success: function (data) {location.href = 'login.php';

                }
            })        })
    });</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 300px;
            margin: auto;
            text-align: center;
            font-family: arial;
        }

        .title {
            color: grey;
            font-size: 18px;
            margin-top: 60px;
            margin-bottom: 60px;
        }

        button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

p{ margin-top: 60px;
    margin-bottom: 60px;}
        a {
            text-decoration: none;
            font-size: 22px;
            color: black;
        }

        button:hover, a:hover {
            opacity: 0.7;
        }
    </style>


<div class="container">

    <div class="row">

        <?php
        $sql="SELECT customer_name, `customer_email`, `mobile`, `address`, `password` FROM `customer` WHERE `customer_id`={$_SESSION['customerId']}";
        $result=mysqli_query($conn,$sql);
        $customer=mysqli_fetch_assoc($result);
        ?>

        <div class="col-md-6" style="padding-left: 60px">

        <h1><?=$customer['customer_name']?></h1>
            <p class="title"><?=$customer['customer_email']?></p>
            <p class="title"><?=$customer['mobile']?></p>
            <p class="title"><?=$customer['address']?></p>
</div>

        <div class="col-md-6">
            <DIV id="edit" style="visibility:hidden ">
            <form method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">NAME</label>
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?=$customer['customer_name']?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">E-MAIL</label>
                    <input type="email" class="form-control" name="email" id="Email" aria-describedby="emailHelp" placeholder="Enter email" value="<?=$customer['customer_email']?>">
                </div>                                <div id="email1"></div>

                <div class="form-group">
                    <label for="exampleInputEmail1">MOBILE</label>
                    <input type="text" class="form-control" name="mobile" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?=$customer['mobile']?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">ADDRESS</label>
                    <input type="text" class="form-control" name="address" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?=$customer['address']?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value="<?=$customer['password']?>">
                </div>
                <button type="submit" name="submit" class="btn btn-primary" value="Submit">Submit</button><br>
                <button type="cancel" name="cancel" class="btn btn-danger" value="Cancel">Cancel</button>
            </form></DIV>
        </div>
        </div></div>


<?PHP include "includes/footer.php";?>
