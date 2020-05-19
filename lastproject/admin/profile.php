

<?PHP
include "../includes/header.php";
require "../includes/db.php";
if (isset($_POST['submit']))
{
$sql = "UPDATE admins SET name ='$_POST[name]',email='$_POST[email]',password= '$_POST[pass]' where id=$_SESSION[id]";
if (mysqli_query($conn, $sql)) {
    echo "$_GET[ubdate]";
} else {
    echo "$sql";
}
}
$sql = "SELECT name , email,  image ,password FROM admins where id=$_SESSION[id]   ";
$result = mysqli_query($conn, $sql);
$admin=mysqli_fetch_assoc($result);
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#edit").click(function () {
            var name = $("#name").attr("data");
            var email = $("#email").attr("data");
            var pass = $("#pass").attr("data");
            $("#mname").val(name);

            $("#memail").val(email);
            $("#mpass").val(pass);
            $("#memail").change(function () {
                var checkemail = $("#memail").val();
            
              if(email!=checkemail){
                  $.ajax({
                    type: "GET",
                    url: "check.php?email="+checkemail,
                    success: function (data)
                    {
                        if(data!=""){
                            $("#email1").html("<div class='badge bg-red' >Email exist</div>");
                            $("#save").prop("disabled",true);
                        }
                        else
                        {
                            $("#email1").html("<div class='badge bg-green' >Accepted</div>");
                            $("#save").prop("disabled",false);
                        }
                    }
                });}
            });
        });
        $("#file-input").change(function () {
            var name = document.getElementById("file-input").files[0].name;
            var form_data = new FormData();
            form_data.append("file-input", document.getElementById('file-input').files[0]);
            $.ajax({
                url:"adminubdate.php",
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                    $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
                },
                success:function(data)
                {
                    $("#imgimg").html("<img height=300px width=300px src=images/admin_image/"+data+" alt=AdminBSB - Profile Image />\n")
                    $(".image").html("<img width=48 height=48 alt=User src=images/admin_image/"+data+" alt=AdminBSB - Profile Image />\n")
                }
            });
        });

    $("#memail").change(function () {
        var email = $("#memail").val();
        $.ajax({
            type: "GET",
            url: "emailcheck.php?email="+email,
            success: function (data)
            {
                if(data!=""){
                    $("#s7").css("visibility", "hidden");
                    $("#la").css("visibility", "");
                    $("#save").prop("disabled",true);
                }
                else
                {
                    $("#s7").css("visibility", "");
                    $("#la").css("visibility", "hidden");
                    $("#save").prop("disabled",false);
                }
            }
        });
    });   });
</script>
<style>
    .image-upload>input {
        display: none;
    }
</style>
<div id="myModal" class="modal fade" role="model">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><label for="cc-payment" class="control-label mb-1">update catagory
                        name</label>
                </h4>
            </div>
            <div class="modal-body">
                <p>
                <form method="post" novalidate="novalidate" enctype="multipart/form-data">
                    <div class="form-group">
                        <input id="cc" name="updatename" type="text" class="form-control" aria-required="true"
                               aria-invalid="false">
                    </div>
                    <input id="oldname" name="oldname" type="hidden" class="form-control" value="">
                    <input id="oldimage" name="oldimage" type="hidden" class="form-control" value="">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="validatedCustomFile" name="img2"
                               accept=".jpg, .jpeg, .png" required>
                        <label class="custom-file-label" for="validatedCustomFile" id="updateimg">Choose
                            file...</label>
                    </div>
                    <button id="ubdate" type="submit" class="btn btn-lg btn-info" name="update1" value="">
                        <span id="payment-button-amount">update</span>
                        <span id="payment-button-sending" style="display:none;">saving</span>
                    </button>
                </form>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12">
                <div class="card profile-card">
                    <div class="profile-header">&nbsp;</div>
                    <div class="profile-body">

                        <div class="image-area">
                            <div class="image-upload">
                                <label for="file-input" id="imgimg">
                                    <img height="300px" width="300px" src="images/admin_image/<?php echo $admin['image']; ?>" alt="AdminBSB - Profile Image" />
                                </label>

                                <input id="file-input" type="file" name="image" />
                            </div>
                        </div>
                        <div class="content-area">
                            <h3><?=$admin['name'];?></h3>
                        </div>
                    </div>
                    <div class="profile-footer">
                        <ul>
                            <li>
                                <span id="name" data="<?=$admin['name'];?>"><?=$admin['name'];?></span>
                                <span></span>
                            </li>
                            <li>
                                <span id="email" data="<?=$admin['email'];?>"><?=$admin['email'];?></span>
                                <span></span>
                            </li>
                            <li>
                                <span id="pass"  data="<?=$admin['password'];?>"><?=$admin['password'];?></span>
                                <span></span>
                            </li>
                        </ul>
                        <button class="btn btn-primary btn-lg waves-effect btn-block" data-toggle="modal" data-target="#exampleModalCenter" id="edit">Edit</button>

                    </div>
                </div>

                <!-- Button trigger modal -->


                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="form_validation" method="POST" >
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label  >Name</label>
                                            <input type="text" class="form-control" name="name" id = "mname" required>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>email</label>
                                            <input type="email" class="form-control" name="email" id = "memail"  required>
                                            <div id="email1"></div>

                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>pass</label>
                                            <input type="password" class="form-control" name="pass" id ="mpass" required>

                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input class="btn btn-primary waves-effect" type="submit" name="submit" value="save"  id="save"></input>
                            </div> </form>
                        </div>
                    </div>
                </div>
<?PHP include "../includes/footer.php";?>
