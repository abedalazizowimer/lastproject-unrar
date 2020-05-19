<?php
require "includes/db.php";
if(!empty($_GET["keyword"])) {
    $query ="SELECT name,carName FROM brand inner join cars on brand.brand_id=cars.brand_id WHERE carName like '%" . $_GET["keyword"] . "%' or name like 
            '%" . $_GET["keyword"] . "%' ORDER BY name LIMIT 0,9";
    $result = mysqli_query($conn,$query);
        ?>
        <ul id="country-list">
            <?php
            while( $admin=mysqli_fetch_assoc($result)) {
                ?>
                <li onClick="selectCountry('<?php echo $admin["carName"]; ?>');"><?php echo $admin["name"]." : ". $admin["carName"]; ?></li>
            <?php } ?>
           
        </ul>
    <?php }  ?>