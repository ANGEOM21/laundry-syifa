<div class="modal fade" id="signUpModal" tabindex="-1" aria-labelledby="signinModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog">
        <div class="card-body p-0">
            <div class="modal-content">
                <!-- Nested Row within Card Body -->
                <form method="post" class="user" id="register_user">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="px-5 py-3 mx-auto">
                                <div class="text">
                                    <h1 class="h2 fw-bold sign-text text-gray-900">Sign Up account</h1>
                                    <p class="h6 text-start text-gray-900 mb-3">Enter your details below</p>
                                </div>
                                <div class="modal-body">

                                    <!-- form email -->
                                    <div class="form-group row">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email_regist" id="email_regist" placeholder="Email : example@gmail.com" required autocomplete="off">
                                        <div class="invalid-feedback">
                                            email harus berupa format email @
                                        </div>
                                    </div>

                                    <!-- no hp -->
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="nomer_hp" id="nomer_hp" placeholder="No.Hp : +628xxxxxxxxxx" required autocomplete="off">
                                        <div class="invalid-feedback">
                                            nomor hp harus berupa angka dan panjang minimal 11
                                        </div>
                                    </div>
                                    <!-- form password -->
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password" required autocomplete="off">
                                            <div class="showPass">
                                                <label for="checkPasswd">
                                                    <i class="bi bi-eye"></i>
                                                    <input type="checkbox" class="form-check-input" id="checkPasswd_register">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            password harus berupa huruf dan angka dan panjang minimal 8
                                        </div>
                                    </div>
                                    <!-- konfirmasi password  -->
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <input type="password" class="form-control form-control-user" name="re_password" id="re_password" placeholder="Confirm Password" required autocomplete="off">
                                            <div class="showPass_re">
                                                <label for="checkPasswd">
                                                    <i class="bi bi-eye"></i>
                                                    <input type="checkbox" class="form-check-input" id="checkPasswd_register_re">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            password harus berupa huruf dan angka dan panjang minimal 8
                                        </div>
                                    </div>
                                    <button class="btn btn-user btn-block register_btn" type="submit">
                                        Sign Up
                                    </button>
                                </div>
                                <hr>
                                <div class="text-center">
                                    have already account ? <a href="#" type="button" class="" data-dismiss="modal" data-toggle="modal" data-target="#signInModal" style="font-weight: 600;">Sign In</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>