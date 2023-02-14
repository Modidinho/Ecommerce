<?php
require_once "../../controllers/middleware/MustPost.php";
require_once "../../controllers/setup/connect.php";
require_once "../../controllers/middleware/MustAuthenticate.php";
require_once "../../controllers/middleware/MustBeAdmin.php";

$sql = mysqli_query($dbc,"SELECT * FROM product_categories ORDER BY id DESC");
$no = 1;

?>


<!-- Grid column -->
<div class="col-md-12">


    <!-- Panel -->
    <div class="card mb-lg-0 mb-4">

        <div class="card-header white-text blue-gradient">
            <h5 class="font-weight-500 my-1">Manage Product Categories

                <span class="float-right">
                    <button class="btn btn-outline-light btn-sm btn-rounded" data-toggle="modal"
                        data-target=".add-product-category-modal">
                        <i class="fas fa-plus-circle"></i>
                        Add Product Category
                    </button>
                </span>


            </h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="font-weight-bold ">#</th>
                            <th class="font-weight-bold ">Image</th>
                            <th class="font-weight-bold ">Category Name</th>
                            <th class="font-weight-bold ">Total Products</th>
                            <th class="font-weight-bold ">Availability</th>
                            <th class="font-weight-bold ">Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                      while($row= mysqli_fetch_array($sql))
                      {
                          $total_products = mysqli_query($dbc,"SELECT COUNT(*) AS total_products FROM products WHERE category_id='".$row['id']."'");
                          $total_products = mysqli_fetch_array($total_products);
                          $total_products = $total_products['total_products'];

                          if($row['active'] == 'Yes')
                          {
                              $bg = 'bg-success';
                          }
                          else 
                          {
                              $bg = 'bg-danger';
                          }

                        ?>
                        <tr>
                            <td><?php echo $no++ ;?></td>
                            <td width="100px">
                            <div class="view overlay" data-toggle="modal"
                                    data-target=".edit-poster-modal"
                                    onclick="OpenChangePosterModal('<?php echo $row['id'];?>','category')">
                                    <img class="img-thumbnail img-fluid" style="width: 80px; height:80px;"
                                        src="<?php echo media_url.'products/category/'.$row['file'] ;?>"
                                        alt="Product Image">
                                    <div class="mask flex-center rgba-green-strong">
                                            <label class="text-white cursor-pointer">
                                                Change Image
                                            </label>

                                        </form>
                                    </div>
                                </div>

                            </td>
                            <td><?php echo $row['category_name'];?></td>
                            <td><?php echo $total_products;?></td>
                            <td class="<?php echo $bg;?>"><?php echo $row['active'];?></td>
                            <td>
                                <span class="badge badge-pill badge-info badge-large cursor-pointer" data-toggle="modal"
                                    data-target=".edit-product-category-modal"
                                    onclick="OpenEditProductCategoryModal('<?php echo $row['id'];?>')">update</span>
                            </td>

                        </tr>


                        <?php
                      }

                      ?>

                    </tbody>

                </table>
            </div>

        </div>

    </div>
    <!-- Panel -->

</div>
<!-- Grid column -->


<?php 
require_once('ModalAddProductCategory.php');
?>

<script>
$('.table').DataTable({
    stateSave: true,

});

$('.select2').select2({

});

$('.mdb-select').materialSelect();
$('.select-wrapper.md-form.md-outline input.select-dropdown').bind('focus blur', function() {
    $(this).closest('.select-outline').find('label').toggleClass('active');
    $(this).closest('.select-outline').find('.caret').toggleClass('active');
});
</script>