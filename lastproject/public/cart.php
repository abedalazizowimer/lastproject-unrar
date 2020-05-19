<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".qty").change(function () {
            var vall = parseInt($(this).val());
            if (vall < parseInt($(this).attr("min")))
            {
                $(this).val($(this).attr("min"));
            }

            else if   (parseInt($(this).attr("max")) < vall)
            {
                $(this).val($(this).attr("max"));
            }
            var qty = $(this).val();
            var id = $(this).attr('idd');
            var price = $(this).attr('data-id');
            var cell = $(this).closest('tr');
            $.ajax({
                type: "GET",
                url: "cartTotal.php?qty=" + qty + "&price=" + price + "&id=" + id,
                success: function (data) {
                    cell.find('td:eq(5)').text(data);
                }
            })
        })
    });</script>

<?php require "includes/db.php"; ?>

<?php

if (isset($_POST['remove'])) {
    session_start();

    $sql = "select price from cars where car_id=$_POST[remove]";
    $result = mysqli_query($conn, $sql);
    $car = mysqli_fetch_assoc($result);
    if (!isset($_SESSION['total'])){$_SESSION['total']=0;}
    else{ $_SESSION['total'] = $_SESSION['total'] - ($car['price'] * $_SESSION['quantity'][$_POST['remove']]);}
    unset($_SESSION['car'][$_POST['remove']]);
    unset($_SESSION['quantity'][$_POST['remove']]);
    die(header("location:cart.php"));
}
include "includes/header.php";


?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shopping Cart</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->


<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="product-content-right">
                <div class="woocommerce">
                    <form method="post" action="#">
                        <table cellspacing="0" class="shop_table cart">
                            <thead>
                            <tr>
                                <th class="product-remove">&nbsp;</th>
                                <th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?PHP
                            $total = 0;
                            $subTotal = 1;
                            if (isset( $_SESSION['quantity'])){
                            if (isset($carCart)) {
                                foreach ($carCart as $singleCar) {

                                    $subTotal = $singleCar['price'] * $_SESSION['quantity'][$singleCar['car_id']];

                                    $total += $subTotal;
                                    $_SESSION['total'] = $total;
                                    ?>
                                    <tr class="cart_item">
                                    <td class="product-remove">
                                        <form method="post">
                                            <button title="Remove this item" class="btn btn-danger"
                                                    name="remove" href="#" value="<?= $singleCar['car_id'] ?>">×
                                            </button>
                                        </form>
                                    </td>

                                    <td class="product-thumbnail">
                                        <a href="single-product.html"><img width="145" height="145"
                                                                           alt="poster_1_up"
                                                                           class="shop_thumbnail"
                                                                           src="../admin/images/<?= $singleCar['name'] ?>/<?= $singleCar['image'] ?>"></a>
                                    </td>

                                    <td class="product-name">
                                        <a href="single-product.php?id=<?= $singleCar['car_id'] ?>"><?= $singleCar['carName'] ?></a>
                                    </td>

                                    <td class="product-price">
                                        <span class="ammount"><?= $singleCar['price'] ?></span><span>.00</span><span>$</span>
                                    </td>

                                    <td class="product-subtotal">

                                        <div class="quantity" style="width:100px;">
                                            <input type="number" style="width:100%;" idd="<?= $singleCar['car_id'] ?>"
                                                   data-id="<?= $singleCar['price'] ?>"
                                                   value="<?= $_SESSION['quantity'][$singleCar['car_id']] ?>"
                                                   class="input-text qty text" title="Qty"
                                                   max="<?= $singleCar['quantity'] ?>" value="" name="quantity" min="1"
                                                   required>
                                        </div>
                                    </td>

                                    <td class="product-subtotal">
                                        <span class="subtotal"><?= $subTotal ?></span><span>.00</span><span>$</span>
                                    </td>

                                    </tr><?PHP }}
                            } ?>


                            </tbody>
                        </table>
                    </form>
                    <div class="container-fluid">
                        <div class="cart-collaterals">
                            <div class="cart_totals " style="width: 100%">
                                <h2>Cart Totals</h2>

                                <table cellspacing="0">
                                    <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Cart Subtotal</th>
                                        <td><span>£</span><span
                                                    class="amountAll"><?= $total ?></span><span>.00</span></td>
                                    </tr>

                                    <tr class="shipping">
                                        <th>Shipping and Handling</th>
                                        <td>Free Shipping</td>
                                    </tr>

                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td><strong><span>£</span><span
                                                        class="amountAll"><?= $total ?></span><span>.00</span></strong>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                                <?php
                                if (empty($_SESSION['car'])) {


                                    ?>
                                    <a href="checkout.php" type="submit" value="" name="proceed"
                                       class="btn-success btn" disabled>Proceed to Checkout</a>
                                <?php } else {
                                    ?> <a href="checkout.php" type="submit" value="" name="proceed"
                                          class="btn-success btn">Proceed to Checkout</a>

                                <?php }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?php
include "includes/footer.php";

?>