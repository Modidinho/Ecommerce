<?php
require_once "../../controllers/setup/connect.php";
require_once "../../controllers/middleware/MustAuthenticate.php";
require_once "../../controllers/middleware/MustPost.php";

?>
<!--Header-->
<div class="modal-header">
    <p class="heading">
        <strong><i class="fas fa-shopping-cart text-white"></i> My Cart</strong>
    </p>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="white-text">&times;</span>
    </button>
</div>

<?php



$user_id = $_SESSION['user_id'];


$sql = mysqli_query($dbc,"SELECT * FROM orders WHERE user_id='".$user_id."' && status='pending'");
$sql_sum = mysqli_query($dbc,"SELECT SUM(total) AS total FROM orders WHERE user_id='".$user_id."' && status='pending'");
$sum = mysqli_fetch_array($sql_sum);

if($sql)
{
    $count = mysqli_num_rows($sql);

    if($count == 0)
    {
        ?>

<div class="text-center mt-3 text-danger">
    <i class="fas fa-shopping-cart  fa-4x mb-3 animated rotateIn text-danger"></i>
    <p>
        <strong>You have no items in the cart</strong>
    </p>
</div>

<?php
    }
    else 
    {
        
        while($row = mysqli_fetch_array($sql))
        {
            $product = mysqli_fetch_array(mysqli_query($dbc,"SELECT * FROM products WHERE id='".$row['product_id']."'"));
            ?>
<div class="accordion md-accordion" id="accordion-<?php echo $row['id'];?>" role="tablist" aria-multiselectable="true">

    <!-- Accordion card -->
    <div class="card">

        <!-- Card header -->
        <div class="card-header" role="tab" id="heading-<?php echo $row['id'];?>">
            <div class="row">
                <div class="col-md-2">
                    <a href="#" onclick="RemoveProductFromCart('<?php echo $row['id'];?>')"
                        class="float-left remove-btn m-3"><i class="fas fa-times text-danger"></i></a>
                    <img class="img-thumbnail img-fluid" height="80px" width="80px"
                        src="<?php echo media_url.'products/products/'.$product['file'] ;?>" alt="Card image cap">

                </div>

                <div class="col-md-3 select-outline">

                    <select id="quantity-<?php echo $row['id'];?>"
                        class="mdb-select md-form md-outline colorful-select dropdown-primary quantity-<?php echo $row['id'];?>"
                        onchange="UpdateCartProductQuantity('<?php echo $row['id'];?>')">
                        <option value="<?php echo $row['quantity'];?>"><?php echo $row['quantity'];?></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                    <label>Quantity</label>

                </div>


                <div class="col-md-7 mt-3">


                    <a data-toggle="collapse" data-parent="#accordion-<?php echo $row['id'];?>"
                        href="#collapse-<?php echo $row['id'];?>" aria-expanded="false"
                        aria-controls="collapse-<?php echo $row['id'];?>" class="collapsed float-right">
                        <h6 class="mb-0 card-text">

                            <?php echo $product['product_name'];?>
                            <i class="fas fa-angle-down rotate-icon mr-3 ml-3"></i>
                        </h6>
                        <p class="card-text text-muted float-right m-3"><?php echo $row['quantity'];?> x (KES
                            <?php echo number_format($product['price']);?>) </p>
                    </a>
                </div>


            </div>









        </div>

        <!-- Card body -->
        <div id="collapse-<?php echo $row['id'];?>" class="collapse" role="tabpanel"
            aria-labelledby="heading-<?php echo $row['id'];?>" data-parent="#accordion-<?php echo $row['id'];?>"
            style="">
            <div class="card-body">
                <div class="collapse-content">

                    <!-- Text -->
                    <p class="card-text collapse" id="product-details-<?php echo $row['id'] ;?>">
                        <?php echo $product['description'] ;?></p>
                    <!-- Button -->
                    <a class="btn btn-flat red-text p-1 my-1 mr-0 mml-1 collapsed waves-effect" data-toggle="collapse"
                        href="#product-details-<?php echo $row['id'] ;?>" aria-expanded="false"
                        aria-controls="collapseContent"></a>
                    <i class="fas fa-heart text-muted float-right p-1 my-1" data-toggle="tooltip" data-placement="top"
                        title="Save Product" data-original-title="save this product"></i>

                </div>
            </div>
        </div>

    </div>
    <!-- Accordion card -->


</div>

<?php
        }

        ?>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-text float-left m-3 font-weight-bold">TOTAL (KES)</h4>
            </div>
            <div class="col-md-6">
                <h4 class="card-text float-right m-3 font-weight-bold"><?php echo number_format($sum['total']);?></h4>

            </div>
        </div>
    </div>

    <div class="card-footer text-muted text-center mt-4">
        <div class="row">
            <div class="col-md-12">
                <h4 class="card-text"><i class="fas fa-cash-register"></i> Checkout</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-3 mb-3">
                <button class="btn btn-info waves waves-light btn-form btn-rounded btn-block"
                    onclick="Checkout('cash');" type="button"><i class="far fa-hand-holding-usd fa-1x"></i> Cash on
                    Delivery</button>
            </div>
            <div class="col-md-6 mt-3 mb-3">
                <button class="btn btn-success waves waves-light btn-form btn-rounded btn-block"
                    onclick="Checkout('eft');" type="button"><i class="fas fa-mobile fa-1x"></i> M-PESA</button>

            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-12 pesapal-payment-iframe d-none">
        <div class="alert alert-info card-text text-center m-3" role="alert">
            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
            Loading the payment gateway...
        </div>
    </div>
</div>

<?php
    }


}
else
{
 echo "error";
}

 ?>
<script>
$('.mdb-select').materialSelect();
$('.select-wrapper.md-form.md-outline input.select-dropdown').bind('focus blur', function() {
    $(this).closest('.select-outline').find('label').toggleClass('active');
    $(this).closest('.select-outline').find('.caret').toggleClass('active');
});
</script>