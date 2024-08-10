<div class="content-admin">
	<div class="judul-page">
		<h3>
			<img src="<?= BASEURL; ?>/img/admin/icons/customer.svg" alt="" style="filter: invert(60%) hue-rotate(180deg) contrast(400%);" width="35"> Customer
		</h3>
	</div>
	<div class="container">
		<div class="card px-2 mx-1 border-0 bg-transparent">
			<h3 style="font-weight: 400;">Daftar Semua Customer</h3>
			<p>Berikut adalah table Daftar Semua Customer</p>
		</div>
		<div class="card mx-1 py-3">
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="TableAdmin">
					<thead>
						<tr>
							<th scope="col">Status</th>
							<th scope="col">Nama</th>
							<th scope="col">No. Hp</th>
							<th scope="col">Email</th>
							<th scope="col" class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($data['customer'] as $row) {
							if ($row['status_deleted_tmuld'] == 0) {
								if ($row['id_tmru_ld'] == 2) {
						?>
									<tr>
										<th scope="row" class="text-center align-items-center col-1">
											<?php if ($row['status_deactive_tmuld'] == 1) { ?>
												<span class="badge p-2 text-center" style="background-color: var(--success1); color: white;">Aktif</span>
											<?php } else { ?>
												<span class="badge p-2 text-center" style="background-color: var(--danger1); color: white;">Tidak Aktif</span>
											<?php } ?>
										</th>
										<td><?= $row['name'] ?></td>
										<td><a href="https://api.whatsapp.com/send?phone=+62<?= substr($row['no_hp'], 1) ?>&text=Hello <?= $row['name'] ?>,%20Terimakasih%20telah%20mencuci%20di%20<?= $data['owner'] ?>%20😊%20"" target=" _blank" data-toggle="tooltip" data-placement="top" title="Whatsapp" type="button"> <?= $row['no_hp'] ?></a></td>
										<?php if ($row['email'] == '') { ?>
											<td>-</td>
										<?php } else { ?>
											<td><a href="mailto:<?= $row['email'] ?>?subject=Haii%20<?= $row['name'] ?>%20&body=Terimakasih%20telah%20mencuci%20di%20<?= $data['owner'] ?>%20😊%20" title="Email"><?= $row['email'] ?></a></td>
										<?php } ?>
										<td class="text-center">
											<button class=" m-1 btn-edit_ctm btn-light rounded rounded-lg" data-id="<?= $row['id_tmuld'] ?>">
												<img src="<?= BASEURL ?>/img/admin/icons/edit.svg" alt="icon">
											</button>
											<button class=" m-1 btn-hapus_ctm btn-danger rounded rounded-lg" data-id="<?= $row['id_tmuld'] ?>"><i class="bi bi-trash3"></i></button>
										</td>
									</tr>
								<?php } ?>
							<?php } ?>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php include __DIR__ . "/../../../components/admin/modal/pdfdata_cutomer.php" ?>
	<?php include __DIR__ . "/../../../components/admin/modal/exceldata_cutomer.php" ?>
	<?php include __DIR__ . "/../../../components/admin/modal/tambah/tambah-customer.php" ?>
	<?php include __DIR__ . "/../../../components/admin/modal/edit/edit-customer.php" ?>
</div>