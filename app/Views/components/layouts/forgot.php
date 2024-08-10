<div class="container-fluid d-flex flex-column align-items-center justify-content-center forgot_password" style="height: 100vh;">
	<div class="container">
		<div class="card-body p-0 border border-2 rounded shadow-sm">
			<!-- Nested Row within Card Body -->
			<div class="row">
				<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
				<div class="col-lg-6">
					<div class="p-5 mx-auto">
						<div class="text">
							<h1 class="h2 fw-bold sign-text text-gray-900">Forgot Password</h1>
							<p class="h6 text-start text-gray-900 mb-5">Enter your email or username</p>
						</div>
						<form action="<?= BASEURL ?>/forgot/send" method="post" class="user" id="formLogin">
							<!-- Emaill -->
							<div class="form-group my-4">
								<input id="email_user" name="email_user" type="text" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Email or Username" required>
							</div>
							<!-- forgot Password -->
							<div class="form-group my-4">
								<div class="d-flex">
									<input id="password_user" name="password_user" type="password" class="form-control form-control-user mb-2" placeholder="New Password" required>
									<div class="showPass">
										<label for="checkPasswd">
											<i class="bi bi-eye"></i>
											<input type="checkbox" class="form-check-input" id="checkPasswd_frgt">
										</label>
									</div>
								</div>
							</div>
							<!-- konfirmsi Password -->
							<div class="form-group my-4">
								<div class="d-flex">
									<input id="re_password_user" name="re_password_user"  type="password" class="form-control form-control-user" placeholder="Konfirmasi Password" required>
									<div class="showPass_re">
										<label for="checkPasswd">
											<i class="bi bi-eye"></i>
											<input type="checkbox" class="form-check-input" id="checkPasswd_frgt_re">
										</label>
									</div>
								</div>
							</div>
							<button class="btn btn-user btn-block mt-5 mb-2">
								Forgot Password
							</button>
						</form>
						<div class="text-center">
						Back to  <a href="<?= BASEURL ?>" type="button" class="" style="font-weight: 800; font-style: underline;"> Home </a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>