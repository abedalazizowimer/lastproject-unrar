<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>

    $(document).ready(function () {
        $(".edit").click(function () {
            var id = $(this).attr('data-id');
            var carName = $(this).attr('data-name');
            var cat_name = $(this).attr('cat-name');
            var cat_id = $(this).attr('cat-id');
            var date_OF_made = $(this).attr('data-date');
            var quantity = $(this).attr('data-quantity');
            var state = $(this).attr('data-state');
            var desc = $(this).attr('data-desc');
            var price = $(this).attr('data-price');
            $("#ubdate_Car_type").val(carName);
            $("#ubdate_date_of_made").val(date_OF_made);
            $("#ubdate_quantity").val(quantity);
            $("#ubdate_description").val(desc);
            $("#ubdate_price").val(price);
            $("#carId").val(id);
            $('#brand option[value="' + cat_id + '/' + cat_name + '"]').remove();
            $("#state option[value='" + state + "']").remove();
            $(".state").append('<option  value="' + state + '" selected>' + state + '</option>');
            $(".brand").append('<option  value="' + cat_id + '/' + cat_name + '" selected>' + cat_name + '</option>');
            var i;
            for (i = 2021; i > 1950; i--) {
                if (i == date_OF_made) {
                    $("#ubdate_date_of_made").append("<option selected value=" + i + " >" + i + "</option>");
                } else {
                    $("#ubdate_date_of_made").append("<option value=" + i + ">" + i + "</option>");
                }
            }

        });
        var i;
        for (i = 2021; i > 1950; i--) {
            $("#date_of_made").append("<option value=" + i + ">" + i + "</option>");
        }
        $(function () {
        });
        $("#button").click(function () {
            var id = [];
            $.each($(".select:checked"), function () {
                id.push($(this).val());
            });
            var request;
            if (id[0] == null) {
                alert("please select the row");
            }
            var i = id.length;
            while (i != 0) {
                i--;
                request = $.ajax({
                    type: "GET",
                    url: "delete.php?delete=" + id[i],
                    success: function (data) {
                    }
                });

            }
            request.then(function () {
                location.reload(true);
            })

        });

        $("#SelectAll").change(function () {

            if (this.checked) {
                $(".select").each(function () {
                    this.checked = true;
                });
            } else {
                $(".select").each(function () {
                    this.checked = false;
                });
            }
        });
    });
</script>
<?PHP
require "../includes/db.php";

if (isset($_POST['add'])) {
    $cartype = $_POST['Car_type'];
    $date_of_made = $_POST['date_of_made'];
    $quantity = $_POST['quantity'];
    $state = $_POST['state'];
    $brandId = $_POST['brand'];
    $price = $_POST['price'];
    $brand = explode("/", $brandId);
    $img = $_FILES['img']['name'];
    $tmp = $_FILES['img']['tmp_name'];
    $path = "images/$brand[1]/";
    $desc = $_POST['description'];
    move_uploaded_file($tmp, $path . $img);
    $sql = "INSERT INTO cars( carName,price,image,date_OF_made,quantity,state,brand_id,carDesc) 
                    VALUES ('$cartype',$price,'$img',$date_of_made,$quantity,'$state',$brand[0],'$desc')";
    mysqli_query($conn, $sql);
    header("location:cars.php");
}
?>
<?php
if (isset($_POST['ubdate'])) {
    $cartype = $_POST['ubdate_Car_type'];
    $date_of_made = $_POST['ubdate_date_of_made'];
    $quantity = $_POST['ubdate_quantity'];
    $state = $_POST['ubdate_state'];
    $brandId = $_POST['ubdate_brand'];
    $price = $_POST['ubdate_price'];
    $brand = explode("/", $brandId);
    $img = $_FILES['ubdate_img']['name'];
    $tmp = $_FILES['ubdate_img']['tmp_name'];
    $path = "images/$brand[1]/";
    $desc = $_POST['ubdate_description'];
    if ( $_FILES['ubdate_img']['error'] == 0) {
        move_uploaded_file($tmp, $path . $img);

        $sql = "UPDATE cars SET carName='$cartype',
                    image='$img',date_OF_made=$date_of_made,price=$price,quantity=$quantity,
                    state='$state',carDesc='$desc',brand_id=$brand[0] WHERE car_id=$_POST[carId] ";
        mysqli_query($conn, $sql);
    } else {
        $sql = "UPDATE cars SET carName='$cartype',
                  date_OF_made=$date_of_made,price=$price,quantity=$quantity,
                    state='$state',carDesc='$desc',brand_id=$brand[0] WHERE car_id=$_POST[carId] ";
       mysqli_query($conn, $sql);
    }
    header("location:cars.php");

}


?>
<?php include("../includes/header.php");
?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            VERTICAL LAYOUT
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form method="post" enctype="multipart/form-data">
                            <label for="Car_type">Car type</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="Car_type" class="form-control"
                                           placeholder="Enter the car type" name="Car_type" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="my-1 mr-2" for="date_of_made">Date of made</label>
                                <select class="custom-select my-1 mr-sm-2" id="date_of_made" name="date_of_made"
                                        required="required">

                                </select></div>
                            <div class="form-group">
                                <label class="my-1 mr-2" for="price">price</label>
                                <input type="number" step="0.02" id="price" class="form-control"
                                       placeholder="Enter the price" name="price" required="required">
                                </select></div>
                            <label for="quantity">quantity</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="quantity" class="form-control" placeholder="quantity"
                                           name="quantity" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line"><b>description</b>

                                    <textarea name="description" cols="30" rows="5" class="form-control no-resize"
                                              required="" id="description" aria-required="true"></textarea>
                                    <div class="form-group">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        <input type="file" class="custom-file-input" id="customFile" name="img">
                                    </div>
                                    <div class="form-group">
                                        <label class="custom-file-label" for="used">states</label>
                                        <input type="radio" id="used" class="filled-in" name="state" value="used"
                                               required="required">
                                        <label for="used">used</label>
                                        <input type="radio" id="new" class="filled-in" name="state" value="new">
                                        <label for="new">New</label>
                                    </div>

                                    <div class="form-group">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Brand name</label>

                                        <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref1"
                                                name="brand" required="required">
                                            <?php
                                            $sql = "SELECT  brand_id,name FROM brand";
                                            $result = mysqli_query($conn, $sql);
                                            while ($admin = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <option value="<?= $admin['brand_id'] ?>/<?= $admin['name'] ?>"><?= $admin['name'] ?></option>
                                            <?php } ?>
                                        </select></div>
                                    <input type="submit" class="btn btn-primary m-t-15 waves-effect" name="add"
                                           value="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Available cars
                        </h2>

                    </div>
                    <div class="body table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Date of made</th>
                                <th>quantity</th>
                                <th>state</th>
                                <th>desc</th>
                                <th>image</th>
                                <th>price</th>
                                <th></th>
                            </tr>
                            </thead>
                            <div class="row">

                                <div id="after">
                                    <input type="checkbox" class="" id="SelectAll" name="select" value="">
                                    <label for="SelectAll">Select all</label></td>
                                    <button type="button" id="button" class="btn btn-danger"
                                            style="margin-left: 950px;position: relative;">delete
                                    </button>

                                </div>
                            </div>
                            <tbody>
                            <?php
                            $sql = "SELECT brand.brand_id,price,car_id,carName, cars.image, date_OF_made, quantity, state,brand.name,carDesc FROM
                                  cars INNER JOIN brand on cars.brand_id=brand.brand_id order by name";
                            $result = mysqli_query($conn, $sql);
                            $i = 0;
                            while ($admin = mysqli_fetch_assoc($result)) {
                                $i++;
                                ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td style="width: 90px"><input type="checkbox" class="select" id="<?= $admin['car_id']; ?>"
                                               name="select" value="<?= $admin['car_id']; ?>">
                                        <label for="<?= $admin['car_id']; ?>"><?= $admin['carName']; ?></label></td>
                                    <td><?= $admin['name']; ?></td>
                       
                                    <td><?= $admin['date_OF_made']; ?></td>
                                    <td><?= $admin['quantity']; ?></td>
                                    <td><?= $admin['state']; ?></td>
                                    <td><?= $admin['carDesc']; ?></td>
                                    <td><img width=100px height=100px src="images/<?=$admin['name'];?>/<?=$admin['image'];?>"> </td>
                                    <td><?= $admin['price']; ?></td>
                                    <td><a data-toggle="modal" data-target="#exampleModalCenter" id="edit"
                                           data-id="<?= $admin['car_id']; ?>" data-name="<?= $admin['carName']; ?>"
                                           cat-name="<?= $admin['name']; ?>" cat-id="<?= $admin['brand_id']; ?>"
                                           data-date="<?= $admin['date_OF_made']; ?>"
                                           data-quantity="<?= $admin['quantity']; ?>" data-price="<?= $admin['price']; ?>"
                                           data-state="<?= $admin['state']; ?>" data-desc="<?= $admin['carDesc']; ?>"
                                           class="btn btn-primary edit">edit</a></td>
                                </tr>
                            <?php } ?>
                            <td></td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit cars</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        <label for="Car_type">Car type</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="ubdate_Car_type" class="form-control"
                                       placeholder="Enter the car type" name="ubdate_Car_type" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="my-1 mr-2" for="ubdate_date_of_made">Date of made</label>
                            <select class="custom-select my-1 mr-sm-2" id="ubdate_date_of_made"
                                    name="ubdate_date_of_made" required="required">
                            </select></div>
                        <label for="quantity">quantity</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" id="ubdate_quantity" class="form-control" placeholder="quantity"
                                       name="ubdate_quantity" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="my-1 mr-2" for="ubdate_price">price</label>
                            <input type="double" id="ubdate_price" class="form-control" placeholder="ubdate_price"
                                   name="ubdate_price" required="required">

                            </select></div>
                        <div class="form-group">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            <input type="file" class="custom-file-input" id="customFile" name="ubdate_img">
                        </div>
                        <div class="form-group">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">state</label>

                            <select class="custom-select my-1 mr-sm-2 state" id="state" name="ubdate_state"
                                    required="required">
                                <option value="used">used</option>
                                <option value="new">new</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <b>description</b>
                                <textarea name="ubdate_description" cols="30" rows="5" class="form-control no-resize"
                                          required="" id="ubdate_description" aria-required="true"></textarea>
                                <input type="hidden" id='carId' name="carId">
                                <div class="form-group">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Brand name</label>

                                    <select class="custom-select my-1 mr-sm-2 brand" id="brand" name="ubdate_brand"
                                            required="required">
                                        <?php
                                        $sql = "SELECT  brand_id,name FROM brand";
                                        $result = mysqli_query($conn, $sql);
                                        while ($admin = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <option value="<?= $admin['brand_id'] ?>/<?= $admin['name'] ?>"><?= $admin['name'] ?></option>
                                        <?php } ?>
                                    </select></div>
                                <input type="submit" class="btn btn-primary m-t-15 waves-effect" name="ubdate"
                                       value="submit">
                    </form>
                </div>
            </div>
        </div>
        <?php include("../includes/footer.php"); ?>
