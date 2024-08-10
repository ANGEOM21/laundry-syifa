<h3 style="font-weight: 400; margin-top: 30px">Pendapatan</h3>
<p>Pendapatan 1 minggu, Pendapatan 1 bulan, Pendapatan 6 bulan, Pendapatan 1 tahun</p>
<div class="row align-items-center justify-content-center">
	<div class=" bg-banner shadow d-flex flex-column align-items-center py-2 my-1 col-sm-8 col-lg-2">
		<div class="d-flex flex-column align-items-center mb-0">
			<p class="px-1 text-white m-0 mb-2">Pendapatan 1 Minggu <i class="bi bi-credit-card"></i></p>
			<kbd class="bg-light <?= $data['total_minggu'] == 0 ? 'text-danger' : 'text-dark' ?> font-weight-bold mb-1">Rp. <?= $data['total_minggu'] ?></kbd>
		</div>
	</div>
	<div class=" bg-banner shadow d-flex flex-column align-items-center py-2 my-1 col-sm-8 col-lg-2">
		<div class="d-flex flex-column align-items-center mb-0">
			<p class="px-1 text-white m-0 mb-2">Pendapatan 1 Bulan <i class="bi bi-credit-card"></i></p>
			<kbd class="bg-light <?= $data['total_bulan'] == 0 ? 'text-danger' : 'text-dark' ?> font-weight-bold mb-1">Rp. <?= $data['total_bulan'] ?></kbd>
		</div>
	</div>
	<div class=" bg-banner shadow d-flex flex-column align-items-center py-2 my-1 col-sm-8 col-lg-2">
		<div class="d-flex flex-column align-items-center mb-0">
			<p class="px-1 text-white m-0 mb-2">Pendapatan 6 Bulan <i class="bi bi-credit-card"></i></p>
			<kbd class="bg-light <?= $data['total_6bulan'] == 0 ? 'text-danger' : 'text-dark' ?> font-weight-bold mb-1">Rp. <?= $data['total_6bulan'] ?></kbd>
		</div>
	</div>
	<div class=" bg-banner shadow d-flex flex-column align-items-center py-2 my-1 col-sm-8 col-lg-2">
		<div class="d-flex flex-column align-items-center mb-0">
			<p class="px-1 text-white m-0 mb-2">Pendapatan 1 Tahun <i class="bi bi-credit-card"></i></p>
			<kbd class="bg-light <?= $data['total_tahun'] == 0 ? 'text-danger' : 'text-dark' ?> font-weight-bold mb-1">Rp. <?= $data['total_tahun'] ?></kbd>
		</div>
	</div>
</div>
<hr>