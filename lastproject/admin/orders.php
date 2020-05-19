<?php require "../includes/db.php";?>
<?php
// id for order

if(isset($_GET['idd']))
{
    $sql="DELETE  FROM `orders` where id=$_GET[idd] ";
    mysqli_query($conn,$sql);
    header("location:orders.php");
}

?>
<?php include "../includes/header.php";?>

<section class="content">
    <div class="container-fluid" style="background-color: white">
<div class="header">
                        <h3>
                            Orders information
                        </h3>

                    </div>
    <?PHP

if(!isset($_GET['id'])){
    ?>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Customer name</th>
            <th scope="col">Delivered date</th>
            <th scope="col">Address</th>
            <th scope="col">Checked time</th>
            <th scope="col">Total price</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql="SELECT `id`,address,customer_name,orders.customer_id, `delivered_date`, `checked_time`,  `total` 
      FROM `orders` inner join `customer` on orders.customer_id= customer.customer_id";
        $result = mysqli_query($conn,$sql);
        $i=0;
        while ($order=mysqli_fetch_assoc($result)){
            $i++;
            ?>
            <tr>
                <th scope="row"><?=$i;?></th>
                <td><?=$order['customer_name'];?></td>
                <td><?=$order['delivered_date'];?></td>
                <td><?=$order['address'];?></td>
                <td><?=$order['checked_time'];?></td>
                <td><?=$order['total'];?></td>
                <td><a class="btn btn-primary" href="orders.php?id=<?=$order['id'];?>">see details</a></td>
                <td><a class="btn btn-danger" href="orders.php?idd=<?=$order['id'];?>">delete</a></td>
            </tr>
        <?PHP }
        ?>
        </tbody>
    </table>



    <?php }

else if(isset($_GET['id'])){

    ?>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Car Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Sub total</th>
                <th><a class="btn btn-primary" href="orders.php">back</a></th>

            </tr>
            </thead>
            <tbody>
            <?php
            $sql="SELECT `order_id`, `id`,carName, orderdetail.car_id, `car_quantity`, `car_subtotal` FROM `orderdetail` 
                       inner join `cars` on cars.car_id= orderdetail.car_id where id=$_GET[id]";
            $result = mysqli_query($conn,$sql);
            $i=0;
            while ($order=mysqli_fetch_assoc($result)){
                $i++;
                ?>
                <tr>
                    <th scope="row"><?=$i;?></th>
                    <td><?=$order['carName'];?></td>
                    <td><?=$order['car_quantity'];?></td>
                    <td><?=$order['car_subtotal'];?></td>
                </tr>
            <?PHP }
            ?>
            </tbody>
        </table>
<?php }
    ?>

  </div>
</section>
<div class="section-half" style="margin-top: 500px"></div>
<?php include "../includes/footer.php";?>


