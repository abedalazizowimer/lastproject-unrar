

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $('#searchall').keyup(function(){

            $.ajax({
                type: "GET",
                url: "getbrandandcar.php?keyword="+$(this).val(),
                success: function(data){ 
                    $("#suggesstion-box").show();
                    $("#suggesstion-box").html(data);
                    $("#search").css("background","#FFF");
                }
            });   }); });

    function selectCountry(val) {
        $("#searchall").val(val);
        $("#suggesstion-box").hide();
    }

</script>


<?php include "includes/header.php";?>
<?php require "includes/db.php";?>
<style>
    .product-f-image .product{
        height: 300px;
        width: 200px;
    }.brand{
         height: 300px;
         width: 200px;
     }
</style>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="img/1.jpg" style="width: 100%" alt="Los Angeles">
            </div>

            <div class="item">
                <img src="img/2.jpg" style="width: 100%" alt="Chicago">
            </div>

        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="promo-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="single-promo">
                        <i class="fa fa-refresh"></i>
                        <p>30 Days return</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="single-promo">
                        <i class="fa fa-truck"></i>
                        <p>Free shipping</p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="single-promo">
                        <i class="fa fa-gift"></i>
                        <p>New products</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End promo area -->
   <div class="container-fluid">

   </div>
    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container-fluid">

            <div class="row-fluid">
                <div class="col-md-3">
                    <div class="md-form mt-0" style="">
                        <form method="POST" action="../public/shopall.php" novalidate><h2> <input class="form-control filter" name="search" type="text" placeholder="Search in all shop" aria-label="Search" id="searchall">
                                <div id="suggesstion-box"></div></h2>
                            <button style="margin-top: 10px;" type="submit" class="btn btn-danger" name="searchbtn">Search</button>




                        </form></div>
                </div>
                <div class="col-md-9">
                    <div class="latest-product" >
                        <h2 class="section-title">Latest Products</h2>

                        <div class="product-carousel" >
                            <?php
                            $sql="SELECT name,car_id, carName, cars.image, date_OF_made,quantity,state, carDesc, price, cars.brand_id 
                              FROM cars inner join brand on cars.brand_id=brand.brand_id order by car_id desc LIMIT 10";
                            $result=mysqli_query($conn,$sql);
                            while ($car=mysqli_fetch_assoc($result)){
                             ?>
                            <div class="single-product">
                                <div class="product-f-image" >
                                    <img style=" height: 200px;" class="product" src="../admin/images/<?=$car['name']?>/<?=$car['image']?>"  alt="">
                                    <div class="product-hover">
                                        <a href="single-product.php?id=<?=$car['car_id']?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>

                                <h2><a href="single-product.php?id=<?=$car['car_id']?>"><?=$car['carName']?></a></h2>

                                <div class="product-carousel-price">
                                    <ins><?=$car['price']?>$</ins>
                                </div>
                            </div>
                                <?php }?>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->

    <div class="brands-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <h2 class="section-title">Brands</h2>
                        <div class="brand-list">
                            <?php
                            $sql="SELECT name,brand_id ,image from brand";
                            $result=mysqli_query($conn,$sql);
                            while ($brand=mysqli_fetch_assoc($result)){
                            ?>
                               <a href="http://localhost/lastproject/public/shop.php?id=<?=$brand['brand_id'];?>"><img class="brand" src="../admin/images/brands/<?=$brand['image']?>" alt=""></a>
                          <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End brands area -->

    <div class="product-widget-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">

                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Top Sellers</h2>
                        <?php
                        $sql="SELECT SUM(car_quantity) as summ ,orderdetail.car_id,name,carName,cars.image,state,carDesc,price from cars INNER JOIN orderdetail on cars.car_id=orderdetail.car_id inner join brand on cars.brand_id=brand.brand_id GROUP by carName ORDER by summ DESC limit 3";
                        $result=mysqli_query($conn,$sql);
                        while ($car=mysqli_fetch_assoc($result)){
                        ?>
                        <div class="single-wid-product">
                            <a href="single-product.php?id=<?=$car['car_id']?>"><img style="width: 200px;height: 150px" src="../admin/images/<?=$car['name']?>/<?=$car['image']?>" alt="" class="product-thumb"></a>
                            <h1><a href="single-product.php?id=<?=$car['car_id']?>"><?=$car['carName']?></a></h1>
                            <h3><?=$car['state']?></h3>
                            <h6><?=$car['carDesc']?></h6>

                            <div class="product-wid-price">
                                <ins><?=$car['price']?>$</ins>
                            </div>
                        </div>
                   <?php }?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Top New</h2>
                        <?php
                        $sql="SELECT car_id,name,carName,carName,cars.image,price,state,carDesc FROM cars inner join brand on cars.brand_id=brand.brand_id order by car_id DESC LIMIT 3";
                        $result=mysqli_query($conn,$sql);
                        while ($car=mysqli_fetch_assoc($result)){
                            ?>
                            <div class="single-wid-product">
                                <a href="single-product.php?id=<?=$car['car_id']?>"><img style="width: 200px;height: 150px"  src="../admin/images/<?=$car['name']?>/<?=$car['image']?>" alt="" class="product-thumb"></a>
                                <h1><a href="single-product.php?id=<?=$car['car_id']?>"><?=$car['carName']?></a></h1>
                                <h3><?=$car['state']?></h3>
                                <h6><?=$car['carDesc']?></h6>

                                <div class="product-wid-price">
                                    <ins><?=$car['price']?>$</ins>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End product widget area -->

<?php include "includes/footer.php";?>