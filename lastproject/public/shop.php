

<?php include "includes/header.php"; ?>
<?php require "includes/db.php";
?>

<div class="product-big-title-area">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-2">
                <div class="product-bit-title text-center">
                    <h2>Shop</h2>
                </div>
            </div>
            <div class="col-md-2">

            </div>
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
            <div class="col-md-2">

            </div>
        </div>
    </div>
</div>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container-fluid" >


<div class="col-md-3">
    <div class="md-form mt-0" style="margin-top: 60px;">
        <h3>Search</h3>
        <h2><input class="form-control filter" type="text" placeholder="Search" aria-label="Search" id="search">
        </h2>
    </div>
    <div class="list-group">
        <h3>Maximum price</h3>

        <input type="number" id="Price" style="width:100%;" class="input-text Price number filter form-control filter" title="Price"   name="Price" >

    </div>
    <div class="list-group">

        <h3>State</h3>
        <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
            <div class="list-group-item checkbox">
                <label><input type="radio" class="common_selector state filter" value="used" name="state"> Used</label><br>
                <label><input type="radio" class="common_selector state" value="new" name="state"> New</label>
            </div>

        </div>
    </div>


</div>
        <div class="col-md-9" id="result">


        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

       


        // $("#search").keyup(function () {
        //     var search = $("#search").val();
        //     var id = getUrlParameter('id');
        //
        //     $.ajax({
        //         type: "GET",
        //         url: "searchshop.php?search=" + search+"&id="+id,
        //         success: function (data) {
        //             $("#result").html(data);
        //         }
        //     })
        // });
        // $('.filter').click(function(){
        //     var  filter=$(this).val();
        //     alert(filter);
        // });







        function get_filter(class_name)
        {   $('#Price').change(function(){
            filter_data();
        });
        $('.state').change(function(){

            filter_data();
        });
            var filter = [];
            $('.'+class_name+':checked').each(function(){
                filter.push($(this).val());
            });
            return filter;
        }
        filter_data();

        function filter_data()
        {
            var getUrlParameter = function getUrlParameter(sParam) {
                var sPageURL = window.location.search.substring(1),
                    sURLVariables = sPageURL.split('&'),
                    sParameterName,
                    i;

                for (i = 0; i < sURLVariables.length; i++) {
                    sParameterName = sURLVariables[i].split('=');

                    if (sParameterName[0] === sParam) {
                        return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                    }
                }
            };

            var search = $("#search").val();
            var id = getUrlParameter('id');
            $('.filter_data').html('<div id="loading" style="" ></div>');
            var action = 'fetch_data';
            var maximum_price = $('#Price').val();

            var state = get_filter('state');
            $.ajax({
                url:"searchshop.php",
                method:"POST",
                data:{action:action, maximum_price:maximum_price, state:state,id:id,search:search},
                success:function(data){
                    $('#result').html(data);
                }
            });
        }
     $('#search').keyup(function(){
            filter_data();
     });
    });









</script>
