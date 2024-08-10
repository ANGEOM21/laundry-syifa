<?php $navmenu = [['Home' => '#home'], ['Category' => '#category'], ['Contact' => '#contact']]; ?>

<div class="navbar navbar-expand-sm  navbar-light border-bottom">
	<div class="container">
		<a href="<?= BASEURL ?>" class="navbar-brand navbar-text text-dark"><?= $data['owner'] ?></a>
		<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse align-items-center justify-content-around" id="navbarCollapse">
			<div class="navbar-nav mx-auto">
				<?php foreach ($navmenu as $nav) { ?>
					<?php foreach ($nav as $k => $v) { ?>
						<a href="<?= $v ?>" class="nav-item nav-link text-dark <?= $v === '#home' ? 'active' : '' ?>"><?= $k ?>
						</a>
					<?php } ?>
				<?php } ?>
			</div>

			<!-- tombol login -->
			<div class="row justify-content-center align-items-center">
				<!-- <?= $_SESSION['login'] ?> -->
				<?php if (empty($_SESSION['login'])) { ?>
					<div class="col">
						<button class="btn btn-signin align-items-center text-dark signIn">Sign In
							<i class="bi bi-arrow-right-square" i></i>
						</button>
					<?php } ?>
					</div>
					<div class="navbar-user mr-4">

						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow" style="list-style: none;">
							<a class="nav-link d-flex align-items-center p-0" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?php if (!empty($_SESSION['login'])) { 
									?>
									
									<span class="mr-2  text-gray-600 "><?= $_SESSION['name'] ?></span>
								<?php } ?>
								<div class="img-profile-navbar d-flex align-items-center justify-content-center">
									<!--  <img class="rounded-circle" src="/img/admin/undraw_profile.svg"> -->
									<i class="bi bi-person fa-2x"></i>
								</div>
							</a>

							<!-- Dropdown - User Information -->
							<?php if (!empty($_SESSION['login'])) { ?>
								<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
									<?php if ($_SESSION['role'] == 1) { ?>
										<a class="dropdown-item" href="<?= BASEURL ?>/admin">
											<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
											admin
										</a>
									<?php } ?>
									<?php if ($_SESSION['role'] == 2) { ?>
										<a class="dropdown-item" href="<?= BASEURL ?>/user">
											<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
											Profile
										</a>
									<?php } ?>
									<div class="dropdown-divider"></div>
									<button class="logout_btn dropdown-item">
										<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
										Logout
									</button>
								</div>
							<?php } ?>
						</li>
					</div>
			</div>
		</div>
	</div>
</div>
<?php include __DIR__ . '/sign_In.php'; ?>
<?php include __DIR__ . '/sign_up.php'; ?>
<?php include __DIR__ . '/../admin/modal/logout.php'; ?>