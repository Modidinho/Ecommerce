<div class="col-lg-12 ">
    <div class="row justify-content-center">
        <div class="col-lg-4 animate__animated animate__fadeInRight">
            <!-- Card -->
            <div class="card testimonial-card">

                <!-- Background color -->
                <div class="card-up gradient-card-header blue-gradient">
                    <h5 class="white-text text-center py-4">
                        <strong>Reset Password</strong>
                    </h5>
                </div>

                <!-- Avatar -->
                <div class="avatar mx-auto white">
                    <img src="assets/img/avatar.png" class="rounded-circle" alt="user avatar">
                </div>

                <!-- Content -->
                <div class="card-body">
                    <form class="reset-password-form">
                        <input type="hidden" name="reset_password">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form md-outline">
                                    <input type="number" name="reset_code" class="form-control form-control-lg" required>
                                    <label class="form-label">Reset Code</label>
                                </div>


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form md-outline input-with-pre-icon">
                                    <i class="fas fa-lock  input-prefix"></i>
                                    <input type="password" name="password" class="form-control form-control-lg password"
                                        id="password" aria-label="Password" required />
                                    <label for="password" class="form-label">Password</label>
                                    <div class="invalid-feedback">Please provide a password.</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form md-outline input-with-pre-icon">
                                    <i class="fas fa-lock  input-prefix"></i>
                                    <input type="password" name="confirm_password"
                                        class="form-control form-control-lg password" id="password1"
                                        aria-label="Password" required />
                                    <label for="password1" class="form-label">Confirm Password</label>
                                    <div class="invalid-feedback">Please provide a password.</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 form-check ">
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

                        <hr />
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-around">
                                    <div>
                                        <!-- Forgot password -->
                                        <a href="#" class="link log-in-link">Login</a> | <a href="#"
                                            class="link forgot-password-email-link">Resend Password Reset Code</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>

            </div>
            <!-- Card -->
        </div>
    </div>

</div>
<!-- end card -->