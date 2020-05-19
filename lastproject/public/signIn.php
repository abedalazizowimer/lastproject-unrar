<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#Email").change(function () {

            var email = $("#Email").val();
            if (email != "") {
                $.ajax({
                    type: "GET",
                    url: "checkemail.php?email=" + email,
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

<?php include "includes/header.php";

?>
<?php require "includes/db.php";?>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <div class="woocommerce-info">Returning customer? <a class="showlogin" data-toggle="collapse" href="#login-form-wrap" aria-expanded="false" aria-controls="login-form-wrap">Click here to login</a><br>
                            <label for="error" style="color:red;"><?php if (isset($_GET['error'])){echo $_GET['error'];} ?>
                        </div>

                        <form id="login-form-wrap" action="complete.php" class="login collapse" method="post">


                            <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.</p>

                            <p class="form-row form-row-first">

                                <label for="username">Username or email <span class="required">*</span>
                                </label>
                                <input type="text" id="username" name="username" class="input-text">
                            </p>
                            <p class="form-row form-row-last">
                                <label for="password">Password <span class="required">*</span>
                                </label>
                                <input type="password" id="password" name="password" class="input-text">
                            </p>


                                <div class="clear"></div>


                            <p class="form-row">
                                <input type="submit" value="Login" name="login" class="button">
                            </p>

                        </form>


                        <form enctype="multipart/form-data" action="complete.php"  class="checkout" method="post" >

                            <div id="customer_details" class="col3-set">
                                <div class="col-3">

                                        <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                            <label class="" for="billing_name">First Name <abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="text" value="" placeholder="" id="billing_name" name="billing_name" class="input-text" required>
                                        </p>

                                        <p id="E-mail" class="form-row form-row-last validate-required">
                                            <label class="" for="E-mail">E-mail <abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="text"  placeholder="" id="Email" name="E-mail" class="input-text" required>
                                    <div id="email1"></div>

                                    </p>
                                        <div class="clear"></div>

                                        <p id="mobile" class="form-row form-row-wide">
                                            <label class="" for="mobile">Mobile number</label>
                                            <input type="text" value="" placeholder="" id="mobile" name="mobile" class="input-text"required="required">
                                        </p>

                                        <p id="address" class="form-row form-row-wide address-field validate-required">
                                            <label class="" for="address">Address <abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="text" value="" placeholder="address" id="address" name="address" class="input-text" required>
                                        </p>





                                        <div class="create-account">
                                            <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                            <p id="account_password_field" class="form-row validate-required">
                                                <label class="" for="account_password">Account password <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="password" value="" placeholder="Password" id="account_password" name="account_password" class="input-text" required>
                                            </p>
                                            <div class="clear"></div>
                                        </div>

                                    <p id="address" class="form-row form-row-wide address-field validate-required">

                                        <input type="submit" value="submit" placeholder="Street address" id="save" name="submit" class="input-text btn-success" >
                                    </p>



                                </div></div></form>  </div>
                            </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php";?>
