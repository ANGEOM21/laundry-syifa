<?php
$filter = [
	[
		'7 Hari Terakhir' =>
		'admin/pemesanan/detail/' . base64_encode($data['customer']['id_tmuld'])
	],
	[
		'1 Bulan Terakhir' =>
		'admin/pemesanan/detail/' . base64_encode($data['customer']['id_tmuld']) . '/' . base64_encode(30)
	],
	[
		'6 Bulan Terakhir' =>
		'admin/pemesanan/detail/' . base64_encode($data['customer']['id_tmuld']) . '/' . base64_encode(180)
	],
	[
		'1 Tahun Terakhir' =>
		'admin/pemesanan/detail/' . base64_encode($data['customer']['id_tmuld']) . '/' . base64_encode(370)
	]
];
?>
<div class="content-admin">
	<div class="judul-page">
		<h3><img src="<?= BASEURL; ?>/img/admin/icons/troli.svg" alt="" style="filter: invert(60%) hue-rotate(180deg) contrast(400%);" width="35"> Detail Pemesanan </h3>
	</div>
	<div class="container">
		<div class="card px-2 mx-1 border-0 bg-transparent">
			<h3 style="font-weight: 400;">Pemesanan <?= $data['customer']['name'] ?></h3>
			<p>Berikut adalah table Pemesanan untuk customer <?= $data['customer']['name'] ?></p>
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
							<th scope="col">#</th>
							<th scope="col">No. Hp</th>
							<th scope="col">Kategori pesanan</th>
							<th scope="col">Prosess Laundry</th>
							<th scope="col">Status Bayar</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($data['pesanan'] as $row) {
							if ($row['status_deleted_tmuld'] == 0) {
								if ($row)
						?> <tr>
									<th scope="row" class="text-center"><?= $no++ ?></th>
									<td><a href="https://api.whatsapp.com/send?phone=+62<?= substr($row['no_hp'], 1) ?>&text=Hello%20<?= $row['name'] ?>%20Pesanan%20<?= $row['name_kld'] ?>%20<?= $row['prosess'] ?>" target="_blank" title="Whatsapp"> <?= $row['no_hp'] ?></a></td>
									<td><?= $row['name_kld'] ?></td>
									<td><?= $row['prosess'] ?> <button class="btn-edit-prosess float-right" data-id="<?= $row['id_pld'] ?>">
											<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil text-dark" viewBox="0 0 16 16">
												<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
											</svg>
										</button> </td>
									<td>
										<div class="pesanan">
											<?php if ($row['status_bayar_pld'] == 1) { ?>
												<div class="tipe-pesan">success </div>
											<?php } else { ?>
												<div class="no-pesan">Rp. <?= number_format($row['bayar'], 0, ',', '.') ?></div>
											<?php } ?>
										</div>
									</td>
									</td>
									<td class="text-center">
										<button class="btn-edit-pesanan btn-light rounded rounded-lg" data-id="<?= $row['id_pld'] ?>">
											<img src="<?= BASEURL ?>/img/admin/icons/edit.svg" alt="icon">
										</button>
									</td>
								</tr>
							<?php } ?>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<?php include __DIR__ . "/../modal/edit/edit-prosess.php" ?>
			<?php include __DIR__ . "/../modal/edit/edit-pesanan.php" ?>
		</div>
	</div>
</div>
<!-- STYLE INTERNAL -->
<style>
	.btn-edit-prosess {
		border: 0;
		background-color: transparent;
		color: var(--dark);
	}

	.btn-edit-prosess svg:hover {
		color: #000;
	}

	.btn-edit-prosess:focus {
		border: none;
		outline: none;
	}
</style>