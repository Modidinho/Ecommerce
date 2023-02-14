<?php
require_once "../../controllers/setup/connect.php";
require_once "../../controllers/middleware/MustAuthenticate.php";
require_once "../../controllers/middleware/MustPost.php";

$id = mysqli_real_escape_string($dbc,strip_tags($_POST['id']));

?>

<!--Header-->
<div class="modal-header">
    <p class="heading">
        <strong><i class="fas fa-bags-shopping text-white"></i> Order Details</strong>
    </p>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="white-text">&times;</span>
    </button>
</div>

<?php



$sql = mysqli_query($dbc,"SELECT * FROM orders WHERE id='".$id."' ");
$row = mysqli_fetch_array($sql);

$product = mysqli_fetch_array(mysqli_query($dbc,"SELECT * FROM products WHERE id='".$row['product_id']."' "));
$user = mysqli_fetch_array(mysqli_query($dbc,"SELECT * FROM users WHERE user_id='".$row['user_id']."' "));

$payment = mysqli_fetch_array(mysqli_query($dbc,"SELECT * FROM payments WHERE id IN (SELECT payment_id FROM orders WHERE id='".$id."') "));

if($row['status'] == 'Completed')
{
  $badge = 'bg-success';
}
else 
{
  $badge = 'bg-warning';
}
if($payment['pesapal_notification_type'] == 'COMPLETED')
{
  $badge1 = 'bg-success';
}
else 
{
  $badge1 = 'bg-warning';
}

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
        <strong>That order does not exist</strong>
    </p>
</div>
<?php
    }
    else 
    {

        ?>
<div class="modal-body">
            <div class="row">
              <div class="col-lg-5">
                <!--Carousel Wrapper-->
                <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                  <!--Slides-->
                  <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="<?php echo media_url.'products/products/'.$product['file'] ;?>" alt="Product Image">
                    </div>



                  </div>
                  <!--/.Slides-->

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
                <!--/.Carousel Wrapper-->
              </div>
              <div class="col-lg-7">
                <h2 class="h2-responsive product-name">
                  <strong><?php echo $product['product_name'] ;?></strong>
                </h2>
                <h4 class="h4-responsive">
                  <span class="green-text">
                    <strong>KES <?php echo number_format($row['total']);?></strong>
                  </span>
                </h4>

                <div class="footer">
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
                    <li class="list-group-item">
                        <div class="float-left"><i class="fas fa-user-circle"></i> Name:</div> <div class="float-right font-weight-bold"><?php echo $user['first_name']. " ". $user['last_name'];?></div>
                    </li>
                    <li class="list-group-item">
                        <div class="float-left"><i class="fas fa-envelope"></i> Email:</div> 
                        <div class="float-right font-weight-bold"><a href="mailto:<?php echo $user['email'];?>"><?php echo $user['email'];?></a> </div>
                    </li>
                    <li class="list-group-item">
                        <div class="float-left"><i class="fas fa-phone"></i> Phone:</div> 
                        <div class="float-right font-weight-bold"><a href="tel:<?php echo $user['phone_number'];?>"><?php echo $user['phone_number'];?></a></div>
                    </li>
                </ul>



            </div>


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