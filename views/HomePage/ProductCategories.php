<?php
require_once('../../controllers/setup/connect.php');
require_once('../../controllers/middleware/MustPost.php');

$sql = mysqli_query($dbc," SELECT * FROM product_categories WHERE active='Yes' ORDER BY category_name ASC");

if(mysqli_num_rows($sql) < 0)
{
    ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning" role="alert">We have no product categories at the moment. Please try again in a little bit</div>
            </div>
        </div>

<?php
}

while($row = mysqli_fetch_array ($sql))

{
?>




    <div class="col-md-3 mt-3 mb-3">

    <div class="card card-image mb-4 hvr-grow-shadow cursor-pointer" onclick="GetProductsByCategory('<?php echo $row['id'];?>')" 
          style="background-image: url(<?php echo media_url.'products/category/'.$row['file'] ;?>);">
  
          <!-- Content -->
          <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
            <div>
              <h5 class="  "> <?php echo $row['category_name'];?></h5>
            </div>
          </div>
  
        </div>

    </div>


<?php
}

?>

<div class="col-md-3 mt-3 mb-3">

<div class="card card-image mb-4 hvr-grow-shadow cursor-pointer" onclick="GetProducts()" 
      style="background-image: url();">

      <!-- Content -->
      <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
        <div>
          <h5 class="  "> All Products</h5>
        </div>
      </div>

    </div>

</div>