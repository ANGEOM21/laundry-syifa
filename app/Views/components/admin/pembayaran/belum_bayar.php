<div class="content-admin">
	<div class="judul-page">
		<h3><img src="<?= BASEURL; ?>/img/admin/icons/troli.svg" alt="" style="filter: invert(60%) hue-rotate(180deg) contrast(400%);" width="35"> Pemesanan Customer </h3>
		<h3 class="page">/ Pembayaran</h3>
	</div>
	<div class="container">
		<div class="card px-2 mx-1 border-0 bg-transparent">
			<h3 style="font-weight: 400;">Belum Bayar</h3>
			<p>Berikut adalah table Pemesanan Customer untuk yang belum melakukan Pembayaran</p>
		</div>
		<div class="card mx-1 py-3">
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="TableAdmin">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama</th>
							<th scope="col">No. Hp</th>
							<th scope="col">Kategori</th>
							<th scope="col">Status Pembayaran</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($data['pesanan'] as $row) {
							if ($row['status_deleted_tmuld'] == 0) {
								if ($row['status_deactive_pld'] == 1) {
									if ($row['status_bayar_pld'] == 0) {
						?>
										<tr>
											<th class="col-1 text-center" scope="row"><?= $no++ ?></th>
											<td class="col-3"><?= $row['name'] ?></td>
											<td class="col-2"><?= $row['no_hp'] ?></td>
											<td class="col-2"><?= $row['name_kld'] ?></td>
											<td class="col-4">
												<div class="pesanan">
													<?php if ($row['status_bayar_pld'] == 1) { ?>
														<div class="tipe-pesan">success </div>
													<?php } else { ?>
														<div class="no-pesan">Rp. <?= number_format($row['bayar'], 0, ',', '.') ?></div>
													<?php } ?>
												</div>
											</td>
											<td class="col-2 text-center">
												<button class="btn-edit-bayar rounded btn-light" data-id="<?= $row['id_pld'] ?>">
													<img src="<?= BASEURL ?>/img/admin/icons/edit.svg" alt="icon">
												</button>
											</td>
										</tr>
									<?php } ?>
								<?php } ?>
							<?php } ?>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<?php include __DIR__ . "/../modal/pdfdata_cutomer.php" ?>
			<?php include __DIR__ . "/../modal/excel_blm_byr_ctm.php" ?>
			<?php include __DIR__ . '/../modal/edit/edit-pembayaran.php'; ?>
		</div>
	</div>
</div>