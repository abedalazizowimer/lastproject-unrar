
<?php require "includes/db.php";?>

<?php

include "includes/header.php";
if(!isset($_SESSION['customerId'])){
  echo("<script>location.href = 'login.php';</script>");
}
?>

<?PHP
if(!isset($_GET['id'])){
?>
<div class="container">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Order id</th>
            <th scope="col">Customer name</th>
            <th scope="col">Delivered date</th>
            <th scope="col">Checked time</th>
            <th scope="col">Total price</th>

        </tr>
        </thead>
        <tbody>
        <?php
        $sql="SELECT `id`,customer_name,orders.customer_id, `delivered_date`, `checked_time`,  `total` 
      FROM `orders` inner join `customer` on orders.customer_id= customer.customer_id where orders.customer_id=$_SESSION[customerId]";
        $result = mysqli_query($conn,$sql);
        $i=0;
        while ($order=mysqli_fetch_assoc($result)){
            $i++;
        ?>
        <tr>
            <th scope="row"><?=$i;?></th>
            <td><?=$order['id'];?></td>
            <td><?=$order['customer_name'];?></td>
            <td><?=$order['delivered_date'];?></td>
            <td><?=$order['checked_time'];?></td>
            <td><?=$order['total'];?></td>
            <td><a class="btn btn-primary" href="order.php?id=<?=$order['id'];?>">see details</a></td>
        </tr>
       <?PHP }
       ?>
        </tbody>
    </table>

  </tr>

</div><?php }

      else if(isset($_GET['id'])){
      ?>

          <div class="container">
              <table class="table">
                  <thead>
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">Car Name</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Sub total</th>
                      <th><a class="btn btn-primary" href="order.php">back</a></th>

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

              </tr>

          </div>
      <?php }
       ?>
<div class="section-half" style="margin-top: 500px"></div>
<?php include "includes/footer.php";?>


