<?php
$orderdate = date('y-m-d', strtotime("+7 days"));
$time = date('d/m/y h:i a', time());
include "includes/header.php";
unset( $_SESSION['url']);

require "includes/db.php";
if (!isset($_SESSION['customerId'])) {
    $_SESSION['url']=$_SERVER['REQUEST_URI'];
echo("<script>location.href = 'signin.php';</script>");
}

?>

    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shopping order</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">


        <div id="order_review" style="position: relative;">
            <table class="shop_table">
                <thead>
                <tr>
                    <th class="product-name">Product</th>
                    <th class="product-total">Total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $total = 0;
                $subTotal = 1;
                if (isset($carCart)) {
                foreach ($carCart as $singleCar) {
                $subTotal = $singleCar['price'] * $_SESSION['quantity'][$singleCar['car_id']];

                $total += $subTotal;
                $_SESSION['total'] = $total;
                ?>

                <tr class="cart_item">
                    <td class="product-name">
                        <?= $singleCar['carName'] ?> <strong class="product-quantity">× <?=$_SESSION['quantity'][$singleCar['car_id']];?></strong></td>
                    <td class="product-total">
                        <span class="amount"><?=$subTotal;?>.00$</span></td>
                </tr>
                <?php }
                } ?>
                </tbody>
                <tfoot>




                <tr class="order-total">
                    <th>Order Total</th>
                    <td><strong><span class="amount"><?= $_SESSION['total'] ?>.00$</span></strong></td>
                </tr>
<?php
if (isset($_POST['submit'])){
    $sql="INSERT INTO `orders`(`customer_id`, `delivered_date`, `checked_time`, `state`,total) VALUES ($_SESSION[customerId],'$orderdate','$time','active',$total)";
    mysqli_query($conn,$sql);
    if (!empty($carCart)) {

    foreach ($carCart as $singleCar) {
        $subTotal = $singleCar['price'] * $_SESSION['quantity'][$singleCar['car_id']];
    $sql="INSERT INTO `orderdetail`(id, `car_id`,  `car_quantity`, `car_subtotal`) VALUES ((SELECT `id` FROM `orders` WHERE customer_id=$_SESSION[customerId] and delivered_date='$orderdate'  and state='active' and total=$total),{$singleCar['car_id']},{$_SESSION['quantity'][$singleCar['car_id']]},$subTotal)";
mysqli_query($conn,$sql);
    }


    foreach ($carCart as $singleCar) {
        $newqty=$singleCar['quantity']-$_SESSION['quantity'][$singleCar['car_id']];
        $sql="UPDATE `cars` SET `quantity`=$newqty WHERE car_id= $singleCar[car_id]";
        mysqli_query($conn,$sql);
    }
    unset($_SESSION['quantity']);
    unset($_SESSION['car']);
    $_SESSION['total']=0;
}
echo("<script>location.href = 'order.php';</script>");
}

?>
                </tfoot>

            </table>

            <div class="form-row place-order" style="text-align: center;">
<form method="post">
                <input style="width: 100%;" type="submit" name="submit" data-value="Place order" value="Place order" id="place_order"
                       name="woocommerce_checkout_place_order" class="button alt">
</form>

            </div>
            <br>


            <div class="clear"></div>

        </div>
    </div>
    </form>

    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

<?php
include "includes/footer.php"; ?>