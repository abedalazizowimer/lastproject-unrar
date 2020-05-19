
<?php
require "../includes/db.php";
//ubdate image
if (isset($_POST['saveimage'])) {
    $img = $_FILES['newimage']['name'];
    $tmp = $_FILES['newimage']['tmp_name'];
    $path = 'images/brands/';
    if (move_uploaded_file($tmp, $path . $img)) {
        $sql = "UPDATE brand SET image='$img' WHERE brand_id=$_POST[idubdate]";
        mysqli_query($conn, $sql);
        header("location:brand.php");
    }
}
//delete the brand
if (isset($_GET['id'])) {
    $sql = "DELETE FROM brand WHERE brand_id= $_GET[id]";
    mysqli_query($conn, $sql);
    header("location:brand.php");
}
//add new brand
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $c = GETCWD();
    mkdir($c . "/images/$name", 0777);
    $img = $_FILES['img']['name'];
    $tmp = $_FILES['img']['tmp_name'];
    $path = 'images/brands/';
    $sql = "INSERT INTO brand( name, image) VALUES ('$name','$img')";
    if (move_uploaded_file($tmp, $path . $img)) {
        mysqli_query($conn, $sql);
        header("location:brand.php");
    }
}
include "../includes/header.php";
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


<script type="text/javascript">
    $(document).ready(function () {
        // modale change the image
        $(".waves-effect").click(function () {
            var id = $(this).attr('data-id');
            var name = $(this).attr("data-name");
            var image = $(this).attr("data-image");
            $('#image_upload_preview').attr('src', "images/brands/" + image);

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#image_upload_preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#inputFile").change(function () {
                readURL(this);
                $("#saveimage").prop("disabled", false);
                $(".id1").val(id);
            });
        });

        $("#saveimage").click(function () {
            $('#image_upload_preview').attr('src', "images/brands/" + image);
        });
        //check the name for insert
        $("#name").change(function () {
            var name = $("#name").val();
            $.ajax({
                type: "GET",
                url: "check.php?brand=" + name,
                success: function (data) {
                    if (data != "") {
                        $("#email1").html("<div class='badge bg-red' >brand name excist</div>");
                        $("#save").prop("disabled", true);
                    } else {
                        $("#email1").html("<div class='badge bg-green' >Accepted</div>");
                        $("#save").prop("disabled", false);
                    }
                }
            })
        });
        
        //ubdate the name and check with ajax
        $(".brandname").dblclick(function () {
            $("#cat").remove();
              var element = $(this);
            var id = $(this).attr('data-id');
            var cell = $(this).closest('tr');
            var name = cell.find('td:eq(0)').text();
            $(this).prepend("<input style=position:absolute;width:200px type=text class=form-control name=name id=cat value=" + name + " >\n");

            $(document).click(function (e) {
                if ($(e.target).closest('#cat').length === 0) {
                    element.html(name);
                }
            });
            $("#cat").change(function ()
             {
                 brand = $("#cat").val();
                if (brand != "") 
                {
                  $.ajax({
                    type: "GET",
                    url: "check.php?brand=" + brand,
                    success: function (data) {
                        if (data != "") {
                            alert("brand name excist");
                        } else {
                            $.ajax({
                                type: "GET",
                                url: "ubdatebrand.php?brand=" + brand + "&id=" + id + "&oldname=" + name,
                                success: function (data) {
                                        $("#cat").remove();//remove textbox
                                        
                                        element.html(data);
                                    } 
                                })
                        }
                    }
                })
              }
              else {
                    element.html(name);
                }
            })
        });
    });
</script>
<?php

$sql = "SELECT brand_id,name,image FROM brand";
$result = mysqli_query($conn, $sql);
?>
<section class="content">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Add new admin</h2>
                </div>
                <div class="body">
                    <form id="form_validation" method="POST" enctype="multipart/form-data">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="name" id="name" required>
                                <label class="form-label">Name</label>

                            </div>
                            <div id="email1"></div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label>Brand image</label> <input type="file" class="custom-file-input" name="img"
                                                                  required>
                            </div>
                        </div>
                        <button class="btn btn-primary waves-effect" type="submit" name="submit" id="save" disabled>
                            SUBMIT
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="body table-responsive">
        <table class="table table-condensed" >
            <thead>
            <tr class="bg-blue">
                <th>#</th>
                <th>Name</th>
                <th>image</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            $i = 0;
            while ($brand = mysqli_fetch_assoc($result)){
            $i++; ?>
            </thead>
            <tbody >
            <tr class="bg-gray">
                <th scope="row"><?= $i; ?></th>
                <td class="brandname" data-id="<?= $brand['brand_id']; ?>"><?= $brand['name']; ?>
                </td>
                <td>
                    <img src="images/brands/<?= $brand['image']; ?>" style="width:108px;height: 60px;"><br>
                    <button class="btn btn-primary  waves-effect"
                            data-id=<?= $brand['brand_id']; ?> data-image="<?= $brand['image']; ?>" data-toggle="modal"
                            data-target="#exampleModalCenter" id="edit">change picture
                    </button>
                </td>
                <td></td>
                <td><a class="btn btn-danger  waves-effect" href="brand.php?id=<?= $brand['brand_id']; ?>">delete</a>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    </div></section>
<div style="text-align: center" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit brand picture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="form_validation" method="post" enctype="multipart/form-data">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label>Image</label>
                            <input type="hidden" class="id1" name="idubdate">
                            <input type='file' id="inputFile" name="newimage"/>
                            <img style="height: 200px;width: 200px;" id="image_upload_preview"
                                 src="http://placehold.it/200x200" alt="your image"/>
                        </div>
                    </div>
                    <div class="form-group form-float">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input class="btn btn-primary waves-effect" type="submit" name="saveimage" value="save"
                               id="saveimage" disabled></input>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?PHP include "../includes/footer.php"; ?>
