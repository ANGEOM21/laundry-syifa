<h3 style="font-weight: 400; margin-top: 30px">Total Data Customer</h3>
<p>Total customer, Total pesanan, Total sudah bayar, Total belum bayar</p>
<div class="d-flex justify-content-center mt-3 card-admin-total">
	<div class="row gap-5">
		<a href="<?= BASEURL; ?>/admin/customer" class=" d-flex align-items-center p-1 rounded-lg col-lg-3 col">
			<div class="bg-banner shadow d-flex flex-column align-items-center py-3">
				<div class="d-flex align-items-center border-bottom mb-0">
					<h6 class="ml-2 p-md-2 text-white">Total customer</h6>
					<h2 class="mr-3 text-dark bg-light rounded-lg px-3 py-1"><?= $data['total_pelanggan'] ?></h2>
				</div>
				<div class="text-white more-info p-0" style="font-size: 18px">more info <i class="fas fa-arrow-right"></i>
				</div>
			</div>
		</a>
		<a href="<?= BASEURL; ?>/admin/pemesanan" class=" d-flex align-items-center p-1 rounded-lg col-lg-3 col">
			<div class="bg-banner shadow d-flex flex-column align-items-center py-3">
				<div class="d-flex align-items-center border-bottom mb-0">
					<h6 class="ml-2 p-md-2 text-white">Total Pesanan</h6>
					<h2 class="mr-3 text-dark bg-light rounded-lg px-3 py-1">
						<?= $data["total_pesanan_ctm"] ?>
					</h2>
				</div>
				<div class="text-white more-info p-0" style="font-size: 18px">more info <i class="fas fa-arrow-right"></i>
				</div>
			</div>
		</a>
		<a href="<?= BASEURL; ?>/admin/sudahbayar" class=" d-flex align-items-center p-1 rounded-lg col col-lg-3">
			<div class="bg-banner shadow d-flex flex-column align-items-center py-3">
				<div class="d-flex align-items-center border-bottom mb-0">
					<h6 class="ml-2 p-md-2 text-white">Total sudah bayar</h6>
					<h2 class="mr-3 text-dark bg-light rounded-lg px-3 py-1"><?= $data['total_sudah_bayar'] ?></h2>
				</div>
				<div class="text-white more-info p-0" style="font-size: 18px">more info <i class="fas fa-arrow-right"></i>
				</div>
			</div>
		</a>
		<a href="<?= BASEURL; ?>/admin/bayar" class=" d-flex align-items-center p-1 rounded-lg col col-lg-3">
			<div class="bg-banner shadow d-flex flex-column align-items-center py-3">
				<div class="d-flex align-items-center border-bottom mb-0">
					<h6 class="ml-2 p-md-2 text-white">Total belum bayar</h6>
					<h2 class="mr-3 text-dark bg-light rounded-lg px-3 py-1"><?= $data['total_belum_bayar'] ?></h2>
				</div>
				<div class="text-white more-info p-0" style="font-size: 18px">more info <i class="fas fa-arrow-right"></i>
				</div>
			</div>
		</a>
	</div>
</div>
<hr>