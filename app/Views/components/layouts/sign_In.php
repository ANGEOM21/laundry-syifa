<div class="modal fade" id="signInModal" tabindex="-1" aria-labelledby="signinModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog">
    <div class="modal-content">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
          <div class="col-lg-6">
            <div class="p-5 mx-auto">
              <div class="text">
                <h1 class="h2 fw-bold sign-text text-gray-900">Sign In account</h1>
                <p class="h6 text-start text-gray-900 mb-5">Enter your details below</p>
              </div>
              <form action="<?= BASEURL ?>/login" method="post" class="user" id="formLogin">
                <div class="form-group">
                  <input id="email_user" name="email_user" type="text" class="form-control form-control-user"
                    aria-describedby="emailHelp" placeholder="Email or Username" required autocomplete="username">
                </div>
                <div class="form-group">
                  <input id="password_user" name="password_user" type="password" class="form-control form-control-user"
                    placeholder="Password" required autocomplete="off">
                  <div class="showPass">
                    <label for="checkPasswd">
                      <i class="bi bi-eye"></i>
                      <input type="checkbox" class="form-check-input" id="checkPasswd_login">
                    </label>
                  </div>
                </div>
                <!-- form check -->
                <div class="form-group">
                  <div class="custom-control custom-checkbox small">
                    <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                    <label class="custom-control-label" for="customCheck">Remember
                      Me</label>
                  </div>
                </div>
                <!-- end check -->
                <button class="btn btn-user btn-block" type="submit">
                  Login
                </button>
              </form>
              <div class="text-start">
                <a class="small" href="<?= BASEURL ?>/forgot">Forgot Password?</a>
              </div>
              <hr>
              <div class="text-center">
                don’t have a acount? <a href="#" type="button" class="sign_up" style="font-weight: 600;">Sign Up</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>