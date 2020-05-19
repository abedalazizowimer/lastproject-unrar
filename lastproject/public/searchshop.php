
<?php
session_start();


require "includes/db.php";

$sql = "SELECT name,`car_id`, `carName`, cars.image, `date_OF_made`, `quantity`, `state`, `carDesc`, `price`,
            cars.brand_id FROM `cars` inner join brand on cars.brand_id = brand.brand_id WHERE car_id IS NOT NULL ";
if(isset($_POST['id'])){
if ($_POST['id']!="undefined") {
    $sql .= "and carName like '%$_POST[search]%' and cars.brand_id = $_POST[id]";
}}else if ($_POST['search'] != "") {
    $sql .= "and (  carName like '%$_POST[search]%' or name like '%$_POST[search]%')";
}
 if ($_POST['maximum_price'] != "" and $_POST['maximum_price']!=1) {
    $sql .= " and (price <= $_POST[maximum_price])";
}
 if (isset($_POST['state'][0])) {
    $sql .= " and state = '{$_POST['state'][0]}'";
}
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {
    echo "<h1>no result found</h1>";
} else {
    while ($cars = mysqli_fetch_assoc($result)) {
if(isset($_SESSION['quantity'][$cars['car_id']])) {
    $quantity = ($cars['quantity'] - $_SESSION['quantity'][$cars['car_id']]);
}
        ?>
        <div class="row-fluid">
            <div class="col-md-4 col-sm-6">
                <div class="single-shop-product">
                    <div class="product-upper">
                        <img style="width: 100%;height: 250px;"
                             src="../admin/images/<?= $cars['name'] ?>/<?= $cars['image'] ?>" alt="">
                    </div>
                    <h2><a href="single-product.php?id=<?= $cars['car_id'] ?>"><?= $cars['carName'] ?></a></h2>
                    <div class="product-carousel-price">
                        <ins><?= $cars['price'] ?>.00 $</ins>
                    </div>
                    <span>quantity:<?php
                     if(isset($_SESSION['quantity'][$cars['car_id']]))
                     { 
                        if($quantity!=0)
                                    {
                                        echo "0".$quantity;
                                    }
                                    else echo "<span class= text-danger>out of stock </span>";
                     }
                                
                    else{
                        if ( $cars['quantity']==0) {
                           echo "<span class = text-danger >out of stock</span>";
                        }
                        else{
                        echo $cars['quantity'];}
                 }?></span>



                </div>
            </div>
        </div>
    <?php }
} ?></div></div></div>
