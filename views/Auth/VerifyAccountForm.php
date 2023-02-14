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


            <!-- Content -->
            <div class="card-body">
                <form onsubmit="VerifyAccount()" class="verify-account-form">
                <input type="hidden" name="verifyaccount">
                
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" name="verification_code" class="form-control form-control-lg" placeholder="Verification Code"
                            aria-label="Email" aria-describedby="basic-addon1" required>
                        <div class="invalid-feedback">Verification Code</div>
                        <div class="input-group mb-3 d-none">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"></span>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <button class="btn btn-primary waves waves-light btn-form btn-rounded btn-block"
                            type="submit"><i class="far fa-circle"></i> Verify Account</button>
                    </div>
                </div>

                <hr />
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-around">
                            <div>
                                <!-- Forgot password -->
                                <a href="#" class="link resend-verification-code-link">Resend Verification Code</a> | <a href="#" class="link log-in-link">Login</a>
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