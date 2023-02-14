<?php
require_once "../../controllers/setup/connect.php";
require_once "../../controllers/Auth/MustAuthenticate.php";
require_once "../../controllers/Auth/MustBeAdmin.php";
require_once "../../controllers/Auth/MustSubmit.php";


$user_id = mysqli_real_escape_string($dbc,strip_tags($_POST['user_id']));
$row = mysqli_fetch_array(mysqli_query($dbc,"SELECT * FROM users WHERE user_id='".$user_id."'"));
?>

<!--Header-->
<div class="modal-header">
	<p class="heading lead"><small class="white-text">Updating  <?php echo $row['name'];?></small></p>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		 <span aria-hidden="true" class="white-text">×</span>
	</button>
</div>
<!--Body-->
<div class="modal-body">
  <form class="update-user-form md-form">
					<input type="hidden" name="update_user" value="update_user">
					<input type="hidden" name="user_id" value="<?php echo $user_id;?>">

    <div class="row border-bottom">
        <div class="col-md-12">
          <div class="md-form input-with-pre-icon">
            <i class="fas fa-user input-prefix"></i>
            <input type="text" id="name" class="form-control" value="<?php echo $row['name'];?>" readonly>
            <label for="name" class="active">Name </label>
          </div>
        </div>
        <div class="col-md-12">
          <div class="md-form input-with-pre-icon">
            <i class="fas fa-envelope input-prefix"></i>
            <input type="text" id="email" name="official_email" class="form-control" value="<?php echo $row['email'];?>" readonly>
            <label for="email" class="active">Email </label>
          </div>
        </div>
        <div class="col-md-12">
          <div class="md-form input-with-pre-icon">
            <i class="fas fa-envelope input-prefix"></i>
            <input type="email" id="official-email" name="official_email" class="form-control" value="<?php echo $row['official_email'];?>">
            <label for="official-email" class="active">Official Email </label>
          </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
          <select class="mdb-select role md-form colorful-select dropdown-primary" name="role" required>
            <option value="<?php echo $row['role'];?>" selected><?php echo ucfirst($row['role']);?></option>
            <?php
                $sql_role = mysqli_query($dbc,"SELECT role FROM user_roles WHERE role!='".$row['role']."' ORDER BY role ASC");
                while($row_role = mysqli_fetch_array($sql_role))
                {
                  ?>
                  <option value="<?php echo $row_role['role'];?>">
                          <?php echo ucfirst($row_role['role']);?>
                  </option>
                  <?php
                }
             ?>

          </select>
          <label for="role" class="active">Role </label>
      </div>
			<div class="col-md-12">
					<select class="mdb-select colorful-select dropdown-primary working-groups-select d-none" name="working_group_id">
						<option disabled selected>Choose Working Group</option>
						<?php
								$sql = mysqli_query($dbc,"SELECT working_group_id,working_group_name FROM working_groups ORDER BY working_group_name ASC");
								while($row = mysqli_fetch_array($sql))
								{
									?>
									<option value="<?php echo $row['working_group_id'];?>"><?php echo $row['working_group_name'];?></option>
									<?php
								}
						 ?>
					</select>
			</div>
      <div class="col-md-12">
          <select class="mdb-select md-form colorful-select dropdown-primary" name="subscription" required>
            <?php
                $subscription = mysqli_query($dbc,"SELECT user_id FROM updates_subscriptions WHERE user_id='".$row['user_id']."'");
                $subscribed = mysqli_num_rows($subscription);
                if($subscribed > 0)
                {
                  ?>
                  <option value="active" selected>
                          Active
                  </option>
                  <option value="inactive">
                          Inactive
                  </option>
                  <?php
                }
                else
                {
                  ?>
                  <option value="inactive" selected>
                          Inactive
                  </option>
                  <option value="active">
                          Active
                  </option>
                  <?php
                }
             ?>

          </select>
          <label for="subscription" class="active">Subscription </label>
      </div>
    </div>

    <div class="row justify-content-center">
        <button class="btn btn-rounded aqua-gradient waves-effect waves-light mt-3 btn-form" type="submit" value="saved">
          <i class="fad fa-save fa-lg"></i> Save
        </button>
    </div>


  </form>
</div>

<script>
$('.mdb-select').materialSelect();

$(document).ready(function(){

	$('.role').unbind('change');
	$('.role').on('change', function(e) {
		e.stopImmediatePropagation();
	if($(this).val() === 'approver')
	{
		$('.working-groups-select').removeClass('d-none');
	}
	else
	{
		$('.working-groups-select').addClass('d-none');
	}

	});
})


</script>
