<?php
require_once "../../controllers/setup/connect.php";
require_once "../../controllers/middleware/MustAuthenticate.php";
require_once "../../controllers/middleware/MustPost.php";

?>
<!--Header-->
<div class="modal-header">
    <p class="heading">
        <strong><i class="fas fa-bags-shopping text-white"></i> My Orders</strong>
    </p>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="white-text">&times;</span>
    </button>
</div>

<?php



$user_id = $_SESSION['user_id'];


$sql = mysqli_query($dbc,"SELECT * FROM orders WHERE user_id='".$user_id."' && status!='pending' ORDER BY id DESC");
$no = 1;

if($sql)
{
    $count = mysqli_num_rows($sql);

    if($count == 0)
    {
        ?>
<div class="text-center mt-3 text-danger">
    <i class="fas fa-bags-shopping  fa-4x mb-3 animated rotateIn text-danger"></i>
    <p>
        <strong>You have no orders</strong>
    </p>
</div>

<?php
    }
    else 
    {
        
        while($row = mysqli_fetch_array($sql))
        {
            if($row['status'] == 'COMPLETED')
            {
                $badge_color = 'badge-success';
            }
            else 
            {
                $badge_color = '';
            }

            $payment = mysqli_fetch_array(mysqli_query($dbc,"SELECT * FROM payments WHERE id IN (SELECT payment_id FROM orders WHERE id='".$row['id']."') "));

            if($payment['pesapal_notification_type'] == 'COMPLETED')
            {
            $badge1 = 'bg-success';
            }
            else 
            {
            $badge1 = 'bg-warning';
            }

            $product = mysqli_fetch_array(mysqli_query($dbc,"SELECT * FROM products WHERE id='".$row['product_id']."'"));
            ?>
<div class="accordion md-accordion" id="accordion-<?php echo $row['id'];?>" role="tablist" aria-multiselectable="true">

    <!-- Accordion card -->
    <div class="card">

        <!-- Card header -->
        <div class="card-header" role="tab" id="heading-<?php echo $row['id'];?>">
            <div class="row">
                <div class="col-md-2">
                    <?php echo $no++;?>.
                    <img class="img-thumbnail img-fluid" height="80px" width="80px"
                        src="<?php echo media_url.'products/products/'.$product['file'] ;?>" alt="Card image cap">

                </div>
                <div class="col-md-2">
                    <div class="badge <?php echo $badge_color;?> "><?php echo $row['status'];?></div>
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

            <ul class="list-group card-text">
                    <li class="list-group-item">
                        <div class="float-left"><i class="fas fa-file"></i> Order ID:</div> 
                        <div class="float-right font-weight-bold"> <?php echo $row['id'];?></div>
                    </li>
                    <li class="list-group-item">
                        <div class="float-left"><i class="fas fa-info-circle"></i> Order Status:</div> 
                        <div class="float-right font-weight-bold"><span class="badge <?php echo $badge;?>"><?php echo $row['status'];?></span></div>
                    </li>
                    <li class="list-group-item">
                        <div class="float-left"><i class="fas fa-info-circle"></i> Payment Status:</div> 
                        <div class="float-right font-weight-bold"><span class="badge <?php echo $badge1;?>"><?php echo $payment['pesapal_notification_type'];?></span></div>
                    </li>
                </ul>

                <div class="collapse-content">

                    <!-- Text -->
                    <p class="card-text collapse" id="product-details-<?php echo $row['id'] ;?>">
                        <?php echo $product['description'] ;?></p>
                    <!-- Button -->
                    <a class="btn btn-flat red-text p-1 my-1 mr-0 mml-1 collapsed waves-effect" data-toggle="collapse"
                        href="#product-details-<?php echo $row['id'] ;?>" aria-expanded="false"
                        aria-controls="collapseContent"></a>

                </div>
            </div>
        </div>

    </div>
    <!-- Accordion card -->


</div>

<?php
        }

        ?>


<?php
    }


}
else
{
 echo "error";
}

 ?>