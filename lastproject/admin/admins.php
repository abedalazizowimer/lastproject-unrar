<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#email").change(function () {
            var email = $("#email").val();
            if (email != "") {
                $.ajax({
                    type: "GET",
                    url: "check.php?email=" + email,
                    success: function (data) {
                        if (data != "") {
                            $("#email1").html("<div class='badge bg-red' >email exist</div>");
                            $("#save").prop("disabled", true);
                        } else {
                            $("#email1").html("<div class='badge bg-green' >Accepted</div>");
                            $("#save").prop("disabled", false);
                        }
                    }
                })
            }
        });
    });
</script>

<?PHP
require "../includes/db.php";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $name = $_POST['name'];
    $img = $_FILES['img']['name'];
    $tmp = $_FILES['img']['tmp_name'];
    $path = 'images/admin_image/';
    if (move_uploaded_file($tmp, $path . $img)) {
        $sql = " INSERT INTO admins( name, email, password, image) VALUES ('$name','$email','$pass','$img')";
        mysqli_query($conn, $sql);
        header("location:admins.php");
    }
}
if (isset($_GET['id'])) {
    $sql = "DELETE FROM admins WHERE id= $_GET[id]";
    mysqli_query($conn, $sql);
    header("location:admins.php");
}
include "../includes/header.php";
$sql = "SELECT id, name , email,  image FROM admins     ";
$result = mysqli_query($conn, $sql);
?>

<section class="content">
    <div class="container-fluid">
        <!-- Basic Validation -->
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
                                    <input type="text" class="form-control" name="name" required>
                                    <label class="form-label">Name</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="email" class="form-control" name="email" id="email" required>
                                    <label class="form-label email">email</label>
                                </div>
                                <div id="email1"></div>

                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="password" class="form-control" name="pass" required>
                                    <label class="form-label">pass</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label>admin image</label> <input type="file" class="form-control" name="img"
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

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Admins information
                        </h2>

                    </div>
                    <div class="body">
                        <table id="mainTable" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>email</th>
                                <th>image</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php while ($admin = mysqli_fetch_assoc($result)){ ?>
                                <td><?php echo $admin['name']; ?></td>
                                <td><?php echo $admin['email']; ?></td>
                                <td><img width="40px" height="40px"
                                         src="images/admin_image/<?php echo $admin['image']; ?>"></td>
                                <td><a href="admins.php?id=<?= $admin['id']; ?>" class="btn btn-danger waves-effect">delete</a>
                                </td>
                            </tr>
                            <?PHP } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include "../includes/footer.php"; ?>