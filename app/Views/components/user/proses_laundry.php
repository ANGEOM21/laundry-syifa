<?php
$filter = [
	[
		'7 Hari Terakhir' =>
		'user/proses'
	],
	[
		'1 Bulan Terakhir' =>
		'user/proses/' . base64_encode(30)
	],
	[
		'6 Bulan Terakhir' =>
		'user/proses/' . base64_encode(180)
	],
	[
		'1 Tahun Terakhir' =>
		'user/proses/' . base64_encode(370)
	]
];
?>
<div class="content-edit-user">
	<div class="container">
		<h1>Prosess Laundry <img src="./img/users/icons/proses.svg" alt="" style="filter: brightness(0);" width="40"></h1>
		<h5>Lihat Prosess Laundry Anda</h5>
		<p>Berikut adalah tabel untuk melihat proses laundry anda</p>
		<div class="card mx-1">
			<div class="card-body">
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
					<table class="table table-striped table-sm table-bordered table-hover text-center" id="TabelProsess">
						<thead>
							<tr>
								<th scope="row">No</th>
								<th>Kategory Pesanan</th>
								<th>Proses</th>
								<th>Update Prosess</th>
								<th>Waktu Pesanan</th>
								<th>Total Harga</th>
								<th>Status Pembayaran</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($data['pesanan'])) { ?>
								<?php
								$no = 1;
								$total_bayar = 0;
								foreach ($data['pesanan'] as $data) {
									if ($data['status_bayar_pld'] == 0) {
										$total_bayar += $data['bayar'];
									}
								?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= ucfirst($data['name_kld']) ?></td>
										<td><?= $data['prosess'] ?></td>
										<td><?= $data['update_at_prosess'] ?></td>
										<td><?= $data['created_at'] ?></td>
										<td>Rp. <?= number_format($data['bayar'], 0, ',', '.') ?></td>
										<td>
											<?php if ($data['status_bayar_pld'] == 1) { ?>
												<div class="tipe-pesan text-center">Lunas </div>
											<?php } else { ?>
												<div class="no-pesan text-center">
													Belum Lunas
												</div>
											<?php } ?>
										</td>
									</tr>
								<?php } ?>
								<tr class="bg-secondary text-light">
									<td colspan="7" class="text-center">Total Pembayaran Belum Lunas : Rp. <?= number_format($total_bayar, 0, ',', '.') ?></td>
								</tr>
							<?php } else { ?>
								<tr class="">
									<td colspan="7" class="text-center">Tidak Ada Pesanan</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>