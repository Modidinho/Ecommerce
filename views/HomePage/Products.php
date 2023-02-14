<?php
session_start();
require_once('../../controllers/setup/connect.php');
require_once('../../controllers/middleware/MustPost.php');

if(isset($_POST['search']))
{
  $search = mysqli_real_escape_string($dbc,strip_tags($_POST['search']));
  if($search == '')
  {
    $sql = mysqli_query($dbc," SELECT * FROM products WHERE active='Yes' ORDER BY product_name ASC LIMIT 50");
    $header_name = 'Products';
  }
  else 
  {
    $sql = mysqli_query($dbc," SELECT * FROM products WHERE active='Yes' && product_name LIKE'%".$search."%' LIMIT 50");
    $header_name = 'Products';

        if(mysqli_num_rows($sql) < 1)
        {
            ?>
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <div class="alert alert-danger d-flex justify-content-center" role="alert">
                            We could not find the product named <?php echo $search;?>. Mind searching with another name?
                          </div>
                    </div>
                </div>

        <?php
        }


        

  }
  
}
else if (isset($_POST['category']))
{
  $id = mysqli_real_escape_string($dbc,strip_tags($_POST['id']));
  $sql = mysqli_query($dbc," SELECT * FROM products WHERE category_id='".$id."' LIMIT 50");

  $category_name1 = mysqli_fetch_array(mysqli_query($dbc,"SELECT category_name FROM product_categories WHERE active='Yes' && id='".$id."'"));
  $category = $category_name1['category_name'];
  $header_name = $category . ' Products';
}
else
{
  $sql = mysqli_query($dbc," SELECT * FROM products WHERE active='Yes' ORDER BY product_name ASC LIMIT 50");
  $header_name = 'Products';
}


if(mysqli_num_rows($sql) < 1)
{
    ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning" role="alert">We have no products at the moment. Please try again in a little bit</div>
            </div>
        </div>

<?php
}
else 
{
    ?>
    <div class="col-lg-12">
    <div class="card">
  <div class="card-header blue-gradient">
      <span class="float-left card-text font-weight-bold text-dark"><?php echo $header_name;?></span>

      <span class="float-right text-white card-text font-weight-bold">Show All <i class="fas fa-chevron-double-right"></i></span>
</div>
  <div class="card-body">
  <div class="row">
      <?php
  while($row = mysqli_fetch_array ($sql))

{
?>
<div class="col-md-4 mt-3 mb-3 ">
<div class="card">

          <!-- Card image -->
          <div class="view overlay">
            <img class="card-img-top poster" src="<?php echo media_url.'products/products/'.$row['file'] ;?>" alt="Product Image">
            <a>
              <div class="mask rgba-white-slight waves-effect waves-light"></div>
            </a>
          </div>

          <!-- Button -->
          <?php 
        if(isset($_SESSION['is_logged_in']))
        {

          
          ?>
          <a class="btn-floating btn-action ml-auto mr-4  btn-danger waves-effect waves-light cart-btn-<?php echo $row['id'] ;?>" 
          data-toggle="tooltip" title="Add to cart"
          onClick="AddToCart('<?php echo $row['id'] ;?>','<?php echo $row['price'] ;?>')">
            <i class="fas fa-cart-plus pl-1"></i>
          </a>
          <?php
        }
        else 
        {
          ?>
          <a class="btn-floating btn-action ml-auto mr-4  btn-danger waves-effect waves-light cart-btn disabled cursor-not-allowed" 
             data-toggle="tooltip" title="Please log in to add this item to cart">
            <i class="fas fa-cart-plus pl-1"></i>
          </a>
          <?php
        }
          ?>


          <!-- Card content -->
          <div class="card-body">

            <!-- Title -->
            <h6 class="card-title font-weight-bold mb-2"><?php echo $row['product_name'] ;?></h6>
            <h6 class="card-title">

            <div class="ribbon-wrapper">
          <div class="ribbon red">
              <small> KES <?php echo number_format($row['price']);?></small>
          </div>
      </div>
            </h6>
            <hr>
            <!-- Text -->

            <div class="collapse-content">

<!-- Text -->
<p class="card-text collapse" id="product-details-<?php echo $row['id'] ;?>"><?php echo $row['description'] ;?></p>
<!-- Button -->
<a class="btn btn-flat red-text p-1 my-1 mr-0 mml-1 collapsed waves-effect" data-toggle="collapse" href="#product-details-<?php echo $row['id'] ;?>" aria-expanded="false" aria-controls="collapseContent"></a>
</div>


          </div>


        </div>
  </div>





<?php
}

?>
</div>
  </div>
</div>
    </div>


<?php


}

?>


<script>
$('[data-toggle="tooltip"]').tooltip()
        </script>