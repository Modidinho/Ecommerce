<?php
require_once "../../controllers/middleware/MustPost.php";
require_once "../../controllers/setup/connect.php";
require_once "../../controllers/middleware/MustAuthenticate.php";
require_once "../../controllers/middleware/MustBeAdmin.php";

$sql = mysqli_query($dbc,"SELECT * FROM products ORDER BY id DESC");
$no = 1;

?>

<!-- Grid column -->
<div class="col-md-12">


    <!-- Panel -->
    <div class="card mb-lg-0 mb-4">

        <div class="card-header white-text blue-gradient">
            <h5 class="font-weight-500 my-1">Manage Products
                <span class="float-right">
                    <button class="btn btn-outline-light btn-sm btn-rounded" data-toggle="modal"
                        data-target=".add-product-modal">
                        <i class="fas fa-plus-circle"></i>
                        Add Product
                    </button>
                </span>
            </h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table admin-manage-products-table">
                    <thead>
                        <tr>
                            <th class="font-weight-bold ">#</th>
                            <th class="font-weight-bold ">Image</th>
                            <th class="font-weight-bold ">Product Name</th>
                            <th class="font-weight-bold ">Description</th>
                            <th class="font-weight-bold ">Price</th>
                            <th class="font-weight-bold ">Category</th>
                            <th class="font-weight-bold ">Availability</th>
                            <th class="font-weight-bold ">Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                      while($row= mysqli_fetch_array($sql))
                      {

                        $product_category = mysqli_fetch_array(mysqli_query($dbc,"SELECT * FROM product_categories WHERE id='".$row['category_id']."'"));
                        $category = $product_category['category_name'];

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
                            <td>
                                <div class="view overlay" data-toggle="modal"
                                    data-target=".edit-poster-modal"
                                    onclick="OpenChangePosterModal('<?php echo $row['id'];?>','product')">
                                    <img class="img-thumbnail img-fluid" style="width: 80px; height:80px;"
                                        src="<?php echo media_url.'products/products/'.$row['file'] ;?>"
                                        alt="Product Image">
                                    <div class="mask flex-center rgba-green-strong">
                                            <label class="text-white cursor-pointer">
                                                Change Image
                                            </label>

                                        </form>
                                    </div>
                                </div>


                            </td>
                            <td width="350px"><?php echo $row['product_name'];?></td>
                            <td width="350px"><?php echo $row['description'];?></td>
                            <td> <?php echo number_format($row['price']);?> </td>
                            <td> <?php echo $category;?> </td>
                            <td width="100px" class="<?php echo $bg;?>"><?php echo $row['active'];?></td>
                            <td>
                                <span class="badge badge-pill badge-info badge-large cursor-pointer" data-toggle="modal"
                                    data-target=".edit-product-modal"
                                    onclick="OpenEditProductModal('<?php echo $row['id'];?>')">update</span>
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
require_once('ModalAddProduct.php');
?>

<script>
$('[data-toggle="tooltip"]').tooltip()


$('.admin-manage-products-table').DataTable({
    stateSave: true,
    initComplete: function() {
        this.api()
            .columns()
            .every(function() {
                var column = this;
                var select = $(
                        '<select class="select2 form-control"><option value=""></option></select>')
                    .appendTo($(column.header()))
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());

                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                    });

                column
                    .data()
                    .unique()
                    .sort()
                    .each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>');
                    });
            });
    },
});

$('.select2').select2({

});

$('.mdb-select').materialSelect();
$('.select-wrapper.md-form.md-outline input.select-dropdown').bind('focus blur', function() {
    $(this).closest('.select-outline').find('label').toggleClass('active');
    $(this).closest('.select-outline').find('.caret').toggleClass('active');
});
</script>