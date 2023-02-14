<?php
require_once "../../controllers/setup/connect.php";
require_once "../../controllers/middleware/MustAuthenticate.php";
require_once "../../controllers/middleware/MustPost.php";

$user = mysqli_fetch_array(mysqli_query($dbc,"SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'"));

?>
<div class="col-lg-12 ">
    <div class="row justify-content-center">
        <div class="col-lg-4 animate__animated animate__fadeInRight">
            <!-- Card -->
            <div class="card testimonial-card">

                <!-- Background color -->
                <div class="card-up gradient-card-header blue-gradient">
                    <h5 class="white-text text-center py-4">
                        <strong>Account</strong>
                    </h5>
                </div>

                <!-- Avatar -->
                <div class="avatar mx-auto white">
                    <img src="assets/img/avatar.png" class="rounded-circle" alt="user avatar">
                </div>

                <!-- Content -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 border-right">
                            <small class="text-muted">First Name</small>
                            <h4 class="card-text font-weight-bold"> <?php echo $user['first_name'];?></h4>

                        </div>
                        <div class="col-md-6 border-right">
                            <small class="text-muted">Last Name</small>
                            <h4 class="card-text font-weight-bold"> <?php echo $user['last_name'];?></h4>

                        </div>
                    </div>

                    <hr />

                    <div class="row">
                        <div class="col-md-6 border-right">
                            <small class="text-muted">Phone</small>
                            <h4 class="card-text font-weight-bold"> <?php echo $user['phone_number'];?> </h4>

                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Address</small>
                            <h4 class="card-text font-weight-bold"> <?php echo $user['address'];?> </h4>

                        </div>

                    </div>
                    <hr />
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-around">
                                <div>
                                    <a href="#" data-toggle="modal" data-target=".update-user-profile-modal">Update
                                        Profile
                                    </a> |
                                    <a href="#" data-toggle="modal" data-target=".update-user-password-modal">
                                        Change Password
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <!-- Card -->
        </div>
    </div>

</div>
<!-- end card -->

<!-- Modal -->
<div class="modal fade update-user-profile-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title">Update Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="update-profile-form">
                    <input type="hidden" name="update">
                    <input type="hidden" name="account-update">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form md-outline">
                                <input type="text" name="first_name" class="form-control form-control-lg"
                                    id="first_name" aria-label="First Name" value="<?php echo $user['first_name'];?>"
                                    required>
                                <label for="first_name" class="form-label active">First Name</label>
                                <div class="invalid-feedback">Please provide a first name</div>
                            </div>


                        </div>
                        <div class="col-md-12">
                            <div class="md-form md-outline">
                                <input type="text" name="last_name" class="form-control form-control-lg"
                                    value="<?php echo $user['last_name'];?>" id="last_name" aria-label="Last Name"
                                    required>
                                <label for="last_name" class="form-label active">Last Name</label>
                                <div class="invalid-feedback">Please provide a last name</div>
                            </div>


                        </div>

                        <div class="col-md-12">
                            <div class="md-form md-outline">
                                <input type="text" name="phone_number" class="form-control form-control-lg"
                                    value="<?php echo $user['phone_number'];?>" id="phone_number"
                                    aria-label="Phone Number" minlength="10" maxlength="10" required>
                                <label for="phone_number" class="form-label active">Phone Number</label>
                                <div class="invalid-feedback">Please provide a phone number</div>
                            </div>


                        </div>

                        <div class="col-md-12">
                            <div class="md-form md-outline">
                                <input type="text" name="address" class="form-control form-control-lg"
                                    value="<?php echo $user['address'];?>" id="address" aria-label="Address" required>
                                <label for="address" class="form-label active">Address</label>
                                <div class="invalid-feedback">Please provide an address</div>
                            </div>


                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button class="btn btn-primary waves waves-light btn-form btn-rounded btn-block"
                                type="submit">UPDATE PROFILE</button>
                        </div>
                    </div>


                    <hr />
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade update-user-password-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title">Update Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="update-user-password-form">
                    <input type="hidden" name="update-user-password">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form md-outline input-with-pre-icon">
                                <i class="fas fa-unlock  input-prefix"></i>
                                <input type="password" name="current_password" class="form-control form-control-lg password"
                                    id="password" aria-label="Password" required />
                                <label for="password" class="form-label">Current Password</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form md-outline input-with-pre-icon">
                                <i class="fas fa-lock  input-prefix"></i>
                                <input type="password" name="password" class="form-control form-control-lg password"
                                    id="password" aria-label="Password" required />
                                <label for="password" class="form-label">New Password</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form md-outline input-with-pre-icon">
                                <i class="fas fa-lock  input-prefix"></i>
                                <input type="password" name="confirm_password"
                                    class="form-control form-control-lg password" id="password1" aria-label="Password"
                                    required />
                                <label for="password1" class="form-label">Confirm New Password</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12 form-check d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" onclick="ShowPassword()"
                                id="show-password" />
                            <label class="form-check-label" for="show-password">
                                Show Password
                            </label>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button class="btn btn-primary waves waves-light btn-form btn-rounded btn-block"
                                type="submit"><i class="far fa-circle"></i> Reset Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

</script>