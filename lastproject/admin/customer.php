<?php include "../includes/header.php";?>
<?php require "../includes/db.php";
if (isset($_GET['id']))
    {
        $sql="delete from customer where customer_id=$_GET[id]";
        mysqli_query($conn,$sql);
        header("location:customer.php");
    }
?>
<section class="content">
    <div class="container-fluid">
        <!-- Basic Validation -->

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Customer information
                        </h2>

                    </div>
                    <div class="body">
                        <table id="mainTable" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>email</th>
                                <th>mobile</th>
                                <th>address</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql="SELECT `customer_id`, `customer_name`, `customer_email`, `mobile`, `address`, `password` FROM `customer`";
                                $result=mysqli_query($conn,$sql);
                                while ($admin = mysqli_fetch_assoc($result)){ ?>
                            <tr>
                                <td><?php echo $admin['customer_name']; ?></td>
                                <td><?php echo $admin['customer_email']; ?></td>
                                <td><?php echo $admin['mobile']; ?></td>
                                <td><?php echo $admin['address']; ?></td>
                                <td><a href="customer.php?id=<?= $admin['customer_id']; ?>" class="btn btn-danger waves-effect">delete</a></td>

                            </tr>
                            <?PHP } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include "../includes/footer.php";?>
