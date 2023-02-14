<div class="col-lg-12 ">
    <div class="row justify-content-center">
        <div class="col-lg-4 animate__animated animate__fadeInRight">
            <!-- Card -->
            <div class="card testimonial-card">

                <!-- Background color -->
                <div class="card-up gradient-card-header blue-gradient">
                    <h5 class="white-text text-center py-4">
                        <strong>Create Account</strong>
                    </h5>
                </div>

                <!-- Avatar -->
                <div class="avatar mx-auto white">
                    <img src="assets/img/avatar.png" class="rounded-circle" alt="user avatar">
                </div>

                <span class="link verify-account-link"></span>

                <!-- Content -->
                <div class="card-body">
                    <form class="create-account-form">
                        <input type="hidden" name="register">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form md-outline input-with-pre-icon">
                                    <i class="fas fa-envelope  input-prefix"></i>
                                    <input type="email" name="email" class="form-control form-control-lg"
                                         aria-label="Email" aria-describedby="basic-addon1" required>
                                    <div class="invalid-feedback">Please provide an email.</div>
                                    <label for="email" class="form-label">Email</label>
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
                            <div class="col-md-12 form-check">
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
                                    type="submit"><i class="far fa-circle"></i> Create Account</button>
                            </div>
                        </div>

                        <hr />
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-around">
                                    <div>
                                        <!-- Forgot password -->
                                        <a href="#" class="link log-in-link">Login</a> | <a href="#"
                                            class="link verify-account-link">Verify Account</a>
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