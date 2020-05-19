<?php

include "includes/header.php";
if(!isset($_GET['id'])){
    ob_start();

    header("location:index.php");
}?>

<?php require "includes/db.php"; ?>

<style type="text/css">
    .img{
width: 500px;
    height: 300px;  
}

</style>
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container-fluid">
            <div class="row-fluid">

                <div class="col-md-12">
                    <?php
                    $sql = "SELECT name,`car_id`, `carName`, cars.image, `date_OF_made`, `quantity`, `state`, `carDesc`, `price`,
                            cars.brand_id FROM `cars` inner join brand on cars.brand_id = brand.brand_id WHERE car_id=$_GET[id]";
                    $result = mysqli_query($conn, $sql);
                    $cars = mysqli_fetch_assoc($result);
                    $cat_id=$cars['brand_id'];

                    if(isset($_SESSION['quantity'][$cars['car_id']])) {
                        $quantity = ($cars['quantity'] - $_SESSION['quantity'][$cars['car_id']]);
                    }
                    ?>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="product-images">
                                    <div class="product-main-img">
                                        <img src="../admin/images/<?= $cars['name'] ?>/<?= $cars['image'] ?>" alt="" class="img">
                                    </div>
                                    

                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name"><?= $cars['carName'] ?></h2>
                                    <div class="product-inner-price">
                                        <ins><?= $cars['price'] ?>$</ins>
                                    </div>
                                    <h4>state :<?= $cars['state'] ?></h4>
                                    <span>quantity:<?php if(isset($_SESSION['quantity'][$cars['car_id']]) and $_SESSION['quantity'][$cars['car_id']]!=0){
                                    if($quantity!=0)
                                    {
                                        echo $quantity;
                                    }
                                    else echo "<span class= text-danger>out of stock </span>";
                                    }
                    else{
                        if ( $cars['quantity']==0) {
                           echo "  0<h3 class = text-danger >out of stock</h3>";
                        }
                        else{
                        echo $cars['quantity'];}
                 }?></span>

                                    <form  method="post" class="cart">
                                        <div class="quantity" style="width:100px;">
                                            <input type="number" style="width:100%;" class="input-text qty text" title="Qty" max="<?php if(isset($_SESSION['quantity'][$cars['car_id']])){echo $quantity;}else{echo $cars['quantity'];}?>" value=""   name="quantity" min="1" required>
                                        </div>
                                                <button class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70"
                                                        rel="nofollow"  name="add_to_cart_button" value="<?= $cars['car_id'] ?>">Add to cart</button>
                                            </div>
                                    </form>
                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <h2>Product Description</h2>  
                                                <p><?= $cars['carDesc'] ?></p>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                                <h2>Reviews</h2>
                                                <div class="submit-review">
                                                    <p><label for="name">Name</label> <input name="name" type="text"></p>
                                                    <p><label for="email">Email</label> <input name="email" type="email"></p>
                                                    <div class="rating-chooser">
                                                        <p>Your rating</p>

                                                        <div class="rating-wrap-post">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <p><label for="review">Your review</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                                    <p><input type="submit" value="Submit"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>


                        <div class="related-products-wrapper">
                            <h2 class="related-products-title">Related Products</h2>
                            <div class="related-products-carousel">
                                <?php
                                $sql = "SELECT name,`car_id`, `carName`, cars.image, `date_OF_made`, `quantity`, `state`, `carDesc`, `price`,
                            cars.brand_id FROM `cars` inner join brand on cars.brand_id = brand.brand_id WHERE cars.brand_id=$cat_id and car_id != $_GET[id]";
                                $result = mysqli_query($conn, $sql);
                             while( $car = mysqli_fetch_assoc($result)){

                                ?>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img style="width:500px;height: 300px;" src="../admin/images/<?=$car['name']?>/<?=$car['image']?>" alt="">
                                        <div class="product-hover">
                                            <a href="single-product.php?id=<?=$car['car_id']?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>

                                    <h2><a href="single-product.php?id=<?=$car['car_id']?>"><?=$car['carName']?></a></h2>

                                    <div class="product-carousel-price">
                                        <ins><?=$car['price']?>$</ins>
                                    </div>
                                </div><?php } ?>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
<?php

include "includes/footer.php";?>