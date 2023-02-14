<?php
require_once "../../controllers/middleware/MustPost.php";
require_once "../../controllers/setup/connect.php";
require_once "../../controllers/middleware/MustAuthenticate.php";
require_once "../../controllers/middleware/MustBeAdmin.php";

$id = mysqli_real_escape_string($dbc,strip_tags($_POST['id']));

$sql = mysqli_query($dbc,"SELECT * FROM users WHERE user_id='".$id."' ");
$row = mysqli_fetch_array($sql);

?>

<div class="modal-header text-white">
    Update User

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="white-text">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="text-center mt-3">
        <i class="fas fa-user-edit  fa-4x mb-3 animated rotateIn text-info"></i>
    </div>
    <form class="admin-update-account-form">
        <input type="hidden" name="admin_update_user_account">
        <input type="hidden" name="id" value="<?php echo $row['user_id'];?>">
        <div class="row">
            <div class="col-md-12">
                <div class="md-form md-outline input-with-pre-icon">
                    <i class="fas fa-envelope  input-prefix"></i>
                    <input type="email" name="email" class="form-control form-control-lg readonly cursor-not-allowed" readonly aria-label="Email"
                        value="<?php echo $row['email'];?>" aria-describedby="basic-addon1" required>
                    <div class="invalid-feedback">Please provide an email.</div>
                    <label for="email" class="form-label active">Email</label>
                </div>


            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="md-form md-outline">
                    <input type="text" name="first_name" class="form-control form-control-lg"
                        value="<?php echo $row['first_name'];?>" required>
                    <label class="form-label active">First Name</label>
                </div>


            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="md-form md-outline">
                    <input type="text" name="last_name" class="form-control form-control-lg"
                        value="<?php echo $row['last_name'];?>" required>
                    <label class="form-label active">Last Name</label>
                </div>


            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="md-form md-outline">
                    <input type="number" name="phone_number" class="form-control form-control-lg"
                        value="<?php echo $row['phone_number'];?>" minlength="10" maxlength="10" required>
                    <label class="form-label active">Phone Number</label>
                </div>


            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="md-form md-outline">
                    <input type="text" name="address" class="form-control form-control-lg"
                        value="<?php echo $row['address'];?>" minlength="3" maxlength="200" required>
                    <label class="form-label active">Address</label>
                </div>


            </div>
        </div>



        <div class="row">
            <div class="col-md-12 select-outline">

                <select name="role" class="mdb-select md-form md-outline colorful-select dropdown-primary">
                    <option value="<?php echo $row['role'];?>" selected><?php echo $row['role'] ;?></option>
                    <?php 
if($row['role'] == 'user')
{
    ?>
                    <option value="admin">Admin</option>
                    <?php
}
else if ($row['role'] == 'admin')
{
    ?>
                    <option value="user">User</option>
                    <?php
}
else 
{
    //
}

?>


                </select>
                <label>Role</label>

            </div>
        </div>

        <div class="row">
            <?php 
if($row['is_verified'] == 1)
{
    $verification = "Verified";
    $value = 1;

    $verification_no = "Not Verified";
    $value_no = 0;
}
else if($row['is_verified'] == 0)
{
    $verification = "Not Verified";
    $value = 0;

    $verification_no = "Verified";
    $value_no = 1;
}

?>
            <div class="col-md-12 select-outline">

                <select name="verification" class="mdb-select md-form md-outline colorful-select dropdown-primary">
                    <option value="<?php echo $row['is_verified'];?>" selected><?php echo $verification ;?></option>
                    <option value="<?php echo $value_no;?>"><?php echo $verification_no;?></option>
                </select>
                <label>Verification</label>

            </div>
        </div>


        <div class="row mt-3">
            <div class="col-md-12">
                <button class="btn btn-primary waves waves-light btn-form btn-rounded btn-block" type="submit"><i
                        class="far fa-circle"></i> Update User</button>
            </div>
        </div>

    </form>
    </form>
</div>

<script>
$('.mdb-select').materialSelect();
$('.select-wrapper.md-form.md-outline input.select-dropdown').bind('focus blur', function() {
    $(this).closest('.select-outline').find('label').toggleClass('active');
    $(this).closest('.select-outline').find('.caret').toggleClass('active');
});
</script>