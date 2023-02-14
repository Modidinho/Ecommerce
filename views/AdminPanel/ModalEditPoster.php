<?php
require_once "../../controllers/middleware/MustPost.php";
require_once "../../controllers/setup/connect.php";
require_once "../../controllers/middleware/MustAuthenticate.php";
require_once "../../controllers/middleware/MustBeAdmin.php";

$id = mysqli_real_escape_string($dbc,strip_tags($_POST['id']));
$item = mysqli_real_escape_string($dbc,strip_tags($_POST['item']));



if($item == 'product')
{
    $sql = mysqli_query($dbc,"SELECT * FROM products WHERE id='".$id."' ");
    $row = mysqli_fetch_array($sql);

    ?>
<div class="modal-header text-white">
    Update Poster

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="white-text">&times;</span>
    </button>
</div>
<div class="modal-body">

    <!-- Card -->
    <div class="card">
        <!-- Card content -->
        <div class="card-body">
            <form class="md-form update-poster-form" enctype="multipart/form-data">
                <input name="id" type="hidden" value="<?php echo $id;?>">
                <input name="item" type="hidden" class="item" value="<?php echo $item;?>">
                <div class="file-field">
                    <div class="z-depth-1-half mb-4">
                        <img src="<?php echo media_url.'products/products/'.$row['file'] ;?>" class="img-fluid"
                            alt="Product Poster">
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="btn btn-mdb-color btn-rounded float-left">
                            <span>Choose file</span>
                            <input type="file" class="image-input" name="poster">
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- Card -->



</div>

<?php
}
else if ($item == 'category')
{
    $sql = mysqli_query($dbc,"SELECT * FROM product_categories WHERE id='".$id."' ");
    $row = mysqli_fetch_array($sql);

    ?>
<div class="modal-header text-white">
    Update Poster

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="white-text">&times;</span>
    </button>
</div>
<div class="modal-body">

    </form>

        <!-- Card -->
        <div class="card">
        <!-- Card content -->
        <div class="card-body">
            <form class="md-form update-poster-form" enctype="multipart/form-data">
                <input name="id" type="hidden" value="<?php echo $id;?>">
                <input name="item" type="hidden" class="item" value="<?php echo $item;?>">
                <div class="file-field">
                    <div class="z-depth-1-half mb-4">
                        <img src="<?php echo media_url.'products/category/'.$row['file'] ;?>" class="img-fluid"
                            alt="Product Poster">
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="btn btn-mdb-color btn-rounded float-left">
                            <span>Choose file</span>
                            <input type="file" class="image-input" name="poster">
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- Card -->


</div>


<?php
}
?>