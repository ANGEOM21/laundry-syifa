<?php
$filter = [
	[
		'7 Hari Terakhir' =>
		'admin/kategori/kiloan'
	],
	[
		'1 Bulan Terakhir' =>
		'admin/kategori/kiloan/' . base64_encode(30)
	],
	[
		'6 Bulan Terakhir' =>
		'admin/kategori/kiloan/' . base64_encode(180)
	],
	[
		'1 Tahun Terakhir' =>
		'admin/kategori/kiloan/' . base64_encode(370)
	]
];
?>

<div class="content-admin">
	<div class="judul-page">
		<h3>
			<img src="<?= BASEURL; ?>/img/admin/icons/kategori.svg" alt="" style="filter: invert(57%) hue-rotate(180deg) contrast(400%);" width="35"> Kategori Pesanan Kiloan
		</h3>
	</div>
	<div class="container">
		<div class="card px-2 mx-1 border-0 bg-transparent">
			<h3 style="font-weight: 400;"> Kategori Pesanan Kiloan</h3>
			<p>Berikut adalah table kategori pesanan Kiloan</p>
		</div>
		<div class="card mx-1 py-3">
			<div class="d-flex justify-content-end mb-3 mx-3">
				<button type="button" class="rounded py-2 btn-light btn border-0" data-toggle="dropdown" aria-expanded="false" data-offset="0,5">
					Filter Data Pemesanan<i class="bi bi-sort-down"></i>
				</button>
				<?php
				$requestUri = $_SERVER['REQUEST_URI'];
				$url = rtrim(ltrim($requestUri, '/'), '/');
				?>
				<div class="dropdown-menu">
					<?php foreach ($filter as $f) { ?>
						<?php foreach ($f as $k => $v) { ?>
							<a class="dropdown-item <?= $url === $v ? 'active' : "" ?>" href="<?= BASEURL . "/" . $v ?>">
								<?= $k ?>
							</a>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="TableAdmin">
					<thead>
						<tr>
							<th class="text-center col-1" scope="col">No</th>
							<th scope="col">Nama</th>
							<th scope="col">Pesanan</th>
							<th scope="col">Jumlah Pesan</th>
							<th scope="col">Harga</th>
							<th scope="col">Tanggal dan Waktu</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($data['categories'] as $category) {
							$date = $data['date'];
							$now = $date::create($category['created_at']);
						?>
							<tr>
								<td class="text-center" scope="row"><?= $no++ ?></td>
								<td><?= $category['name'] ?></td>
								<td><?= $category['name_kld'] ?></td>
								<td><?= $category['jumlah_kld'] ?></td>
								<td>Rp. <?= number_format($category['bayar'], 0, ',', '.') ?></td>
								<td class="text-center">
									<kbd class="text-dark font-weight-bold bg-light"><?= $now->locale('id')->diffForHumans() ?></kbd>
									<!-- <kbd><?= $now->locale('id')->toRfc850String() ?></kbd> -->
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>