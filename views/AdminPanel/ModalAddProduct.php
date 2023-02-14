<div class="modal fade show right add-product-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
        <div class="modal-content add-product-modal-content">
            <div class="modal-header text-white">
                Add Product

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <div class="text-center">
              <i class="far fa-list fa-4x mb-3 animated rotateIn"></i>
            </div>

                <form class="add-product-form">
                    <input type="hidden" name="add-product">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form md-outline">
                                <input type="text" name="product_name" class="form-control form-control-lg" required>
                                <label class="form-label">Product Name</label>
                            </div>


                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form md-outline">
                                <textarea name="product_description" class="form-control form-control-lg"
                                    required></textarea>
                                <label class="form-label">Product Description</label>
                            </div>


                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form md-outline">
                                <input type="number" name="price" min="1" max="1000000" name="price"
                                    class="form-control form-control-lg" required>
                                <label class="form-label">Price</label>
                            </div>


                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12 select-outline">

                            <select name="category_id"
                                class="mdb-select md-form md-outline colorful-select dropdown-primary>

                                <?php 
        $sql_product_category = mysqli_query($dbc,"SELECT * FROM product_categories ORDER BY category_name ASC");

        while($pc = mysqli_fetch_array($sql_product_category))
        {
            ?>
                                <option value="<?php echo $pc['id'];?>"><?php echo $pc['category_name'];?></option>
                                <?php
        }

?>
                            </select>
                            <label>Product Category</label>

                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button class="btn btn-primary waves waves-light btn-form btn-rounded btn-block"
                                type="submit"><i class="far fa-circle"></i> Add Product</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>