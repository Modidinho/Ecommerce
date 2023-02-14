<div class="modal fade show right add-user-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
        <div class="modal-content add-user-modal-content">
            <div class="modal-header text-white">
                Add User

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mt-3">
                    <i class="fas fa-user-plus  fa-4x mb-3 animated rotateIn text-info"></i>
                </div>

                <form class="admin-create-account-form">
                    <input type="hidden" name="register">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form md-outline input-with-pre-icon">
                                <i class="fas fa-envelope  input-prefix"></i>
                                <input type="email" name="email" class="form-control form-control-lg" aria-label="Email"
                                    aria-describedby="basic-addon1" required>
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
                                    class="form-control form-control-lg password" id="password1" aria-label="Password"
                                    required />
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

                </form>

            </div>
        </div>
    </div>
</div>