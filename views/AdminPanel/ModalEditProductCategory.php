<?php
require_once "../../controllers/middleware/MustPost.php";
require_once "../../controllers/setup/connect.php";
require_once "../../controllers/middleware/MustAuthenticate.php";
require_once "../../controllers/middleware/MustBeAdmin.php";

$id = mysqli_real_escape_string($dbc,strip_tags($_POST['id']));

$sql = mysqli_query($dbc,"SELECT * FROM product_categories WHERE id='".$id."' ");
$row = mysqli_fetch_array($sql);

?>

            <div class="modal-header text-white">
                Update Product

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="edit-product-category-form">
                    <input type="hidden" name="edit-product-category">
                    <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form md-outline">
                                <input type="text" name="category_name" class="form-control form-control-lg" value="<?php echo $row['category_name'];?>" required>
                                <label class="form-label active">Category Name</label>
                            </div>


                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 select-outline">

                            <select name="active"
                                class="mdb-select md-form md-outline colorful-select dropdown-primary">

                                <option value="<?php echo $row['active'];?>" selected><?php echo $row['active'];?></option>

                                <?php 
                                    if($row['active'] == 'Yes')
                                    {
                                        ?>
                                            <option value="No">No</option>
                                        <?php
                                    }
                                    else if($row['active'] == 'No')
                                    {
                                        ?>
                                        <option value="Yes">Yes</option>
                                        <?php
                                    }
                                ?>

                            </select>
                            <label>Category Active?</label>

                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button class="btn btn-primary waves waves-light btn-form btn-rounded btn-block"
                                type="submit"><i class="far fa-circle"></i> Update Product Category</button>
                        </div>
                    </div>

                </form>
            </div>

            <script>
$('.mdb-select').materialSelect();
$('.select-wrapper.md-form.md-outline input.select-dropdown').bind('focus blur', function () {
    $(this).closest('.select-outline').find('label').toggleClass('active');
    $(this).closest('.select-outline').find('.caret').toggleClass('active');
  });
</script>
