<div class="topbar-admin">
	<div class="topbar-admin-container">
		<div class="topbar-logo d-flex justify-content-center align-items-center">
			<a href="<?= BASEURL ?>/admin" class="d-flex align-items-center">
				<img src="<?= BASEURL ?>/img/admin/logo.svg" alt="" width="50">
				<h2 class="logo">Syifa Laundry</h2>
			</a>
		</div>
		<div class="toggle">
			<button class="btn-toggle" id="toggleBtn">
				<div class="btn-main">
					<i class="bi bi-menu-button-wide fa-lg"></i>
				</div>
			</button>
		</div>
	</div>
	<div class="d-flex icon-profile align-items-center">
		<div class="nav-item dropdown no-arrow mx-1">
			<a class="nav-link text-white border-right" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-bell fa-fw"></i>
				<!-- Counter - Alerts -->
				<span class="badge badge-danger badge-counter"></span>
			</a>
			<!-- Dropdown - Alerts -->
			<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
				<h6 class="dropdown-header">
					Notification
				</h6>
				<p class="dropdown-item text-center small text-gray-500">No Notification</p>
			</div>
		</div>
		<h5 class="mx-2 text-light my-0 logo"><?= $_SESSION['name'] ?></h5>
		<li class="nav-item dropdown no-arrow" style="list-style: none;">
			<a class="nav-link d-flex align-items-center p-0" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<div class="img-profile-navbar d-flex align-items-center justify-content-center">
					<!--  <img class="rounded-circle" src="/img/admin/undraw_profile.svg"> -->
					<i class="bi bi-person fa-2x"></i>
				</div>
			</a>
			<!-- Dropdown - User Information -->
			<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
				<!-- <a class="dropdown-item" href="<?= BASEURL ?>/logout"> -->
				<button class="logout_btn dropdown-item">
					<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
					Logout
				</button>
			</div>
		</li>
	</div>
</div>
<?php include __DIR__ . '/modal/logout.php'; ?>
<div class="notify-alert-box">
	<img src="<?= BASEURL ?>/img/icon/icon.svg" alt="">
	<p>Haii <?= $data['owner'] ?> Hidupkan Notifikasi agar mendapatkan informasi register user</p>
	<div class="buttons">
		<button id="notify-cancel-button">
			Cancel
		</button>
		<button id="notify-button">
			Accept
		</button>
	</div>
</div>
<style>
	.notify-alert-box {
		width: 400px;
		position: fixed;
		left: 50%;
		margin-left: -200px;
		top: -100%;
		padding: 20px;
		z-index: 100000;
		background-color: #fff;
		color: #333;
		transition: all 0.4s ease-in-out;
		border-radius: 4px;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
	}

	.notify-alert-box img {
		width: 70px;
		float: left;
		margin-right: 10px;
	}

	.notify-alert-box .buttons {
		text-align: right;
	}

	.notify-alert-box .buttons button {
		background-color: var(--primary1);
		color: var(--light1);
		border: 0;
		padding: 8px 15px;
		font-size: 14px;
		cursor: pointer;
		border-radius: 4px;
	}
</style>
<script>
	setTimeout(() => {
		$(".notify-alert-box").css("top", "0");
	}, 1000);
	$("#notify-button").click(function() {
		localStorage.setItem("notification", "true");
		notifyTrue();
		Notification.requestPermission();
	})

	function notifyTrue() {
		if (localStorage.getItem("notification", "true")) {
			$(".notify-alert-box").css("display", "none");
		}
	}
	notifyTrue();
	$("#notify-cancel-button").click(function() {
		localStorage.setItem("notification", "false");
		notifyFalse();
	})

	function notifyFalse() {
		if (localStorage.getItem("notification", "false")) {
			$(".notify-alert-box").css("display", "none");
		}
	}
	notifyFalse();

	function showNotification1() {
		var notificationBody = new Notification("<?= $_SESSION['name'] ?>", {
			icon: "<?= BASEURL ?>/img/icon/icon.svg",
			body: "terdapat user yang sudah registrasi",
		});
		// setTimeout(notificationBody.close.bind(notificationBody), 6000);
		notificationBody.onclick = function() {
			window.open("<?= BASEURL ?>/admin/pemesanan", "_blank");
			notificationBody.close();
		};
	}
	// pusher js code 
	// Enable pusher logging - don't include this in production
	Pusher.logToConsole = false;
	var pusher = new Pusher('c08467d0f663043d20aa', {
		cluster: 'ap1'
	});
	const currentTime = Date.now();
	const date = new Date(currentTime);
	const month = date.getMonth() + 1;
	const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	const formattedTime = `${monthNames[month - 1]} ${date.getDate()}, ${date.getFullYear()}, ${date.getHours()}:${date.getMinutes()}`;
	// Perbarui konten badge setelah seluruh konten halaman HTML telah dimuat
	var jumlahNotifikasi = $(".topbar-admin #alertsDropdown .dropdown-item:last").length;
	$(".topbar-admin #alertsDropdown .badge").html(jumlahNotifikasi);
	var channel = pusher.subscribe('notifikasi_admin');
	channel.bind('my-event', function(data) {
		$(".topbar-admin .dropdown-header").after(
			`<a class="dropdown-item d-flex align-items-center" href="/admin/customer">
				<div class="mr-3">
					<div class="icon-circle bg-primary">
						<i class="fas fa-duotone fa-envelope text-white fa-fw"></i>
					</div>
				</div>
				<div>
					<div class="small text-gray-500">${formattedTime}</div>
					<span class="font-weight-bold">terdapat user yang sudah registrasi</span>
				</div>
			</a>`
		);
		$(".topbar-admin .dropdown-list p").html("Now Notification");
		jumlahNotifikasi += 1;
		$(".topbar-admin #alertsDropdown .badge").html(`${jumlahNotifikasi} +`);
		showNotification1();
	});
</script>