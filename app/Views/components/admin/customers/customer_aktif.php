<div class="content-admin">
	<div class="judul-page">
		<h3>
			<img src="<?= BASEURL; ?>/img/admin/icons/customer.svg" alt="" style="filter: invert(60%) hue-rotate(180deg) contrast(400%);" width="35"> Customer
		</h3>
	</div>
	<div class="container">
		<div class="card px-2 mx-1 border-0 bg-transparent">
			<h3 style="font-weight: 400;">Daftar Customer Aktif</h3>
			<p>Berikut adalah table Daftar Customer Aktif</p>
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
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($data['customer'] as $data) {
							if ($data['status_deleted_tmuld'] == 0) {
								if ($data['id_tmru_ld'] == 2) {
									if ($data['status_deactive_tmuld'] == 1) {
						?>
										<tr>
											<th scope="row" class="text-center align-items-center col-1">
												<span class="badge p-2 text-center" style="background-color: var(--success1); color: white;">Aktif</span>
											</th>
											<td><?= $data['name'] ?></td>
											<td><?= $data['no_hp'] ?></td>
											<?php if ($data['email'] == '') { ?>
												<td>-</td>
											<?php } else { ?>
												<td><?= $data['email'] ?></td>
											<?php } ?>
										</tr>
									<?php } ?>
								<?php } ?>
							<?php } ?>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php include __DIR__ . "/../../../components/admin/modal/edit/edit-aktif.php" ?>
</div>