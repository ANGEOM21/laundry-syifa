<div class="content-admin">
	<div class="judul-page">
		<h3><img src="<?= BASEURL; ?>/img/admin/icons/troli.svg" alt="" style="filter: invert(60%) hue-rotate(180deg) contrast(400%);" width="35"> Data Pemesanan</h3>
		<h3 class="page"></h3>
	</div>
	<div class="container">
		<div class="card px-2 mx-1 border-0 bg-transparent">
			<h3 style="font-weight: 400;">Semua Pemesanan</h3>
			<p>Berikut adalah table Pemesanan Customer yang akan memesan ataupun melihat detail pemesanan</p>
		</div>
		<div class="card mx-1 py-3">
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="TableAdmin">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th class="text-center col-4">Nama</th>
							<th class="text-center col-4">No. Hp</th>
							<th class="text-center col-3">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($data['pesanan'] as $row) {
							if ($row['status_deleted_tmuld'] == 0) {
								if ($row['id_tmru_ld'] == 2) {
						?>
									<tr>
										<th class="text-center" scope="row"><?= $no++ ?></th>
										<td>
											<div class="d-flex align-items-center">
												<a href="<?= BASEURL ?>/img/users/profile/<?= $row['img_tmuld'] ?>" data-lightbox="image-<?= $no ?>">
													<img class="rounded-circle mx-2" src="<?= BASEURL ?>/img/users/profile/<?= $row['img_tmuld'] ?>" alt="" width="45" style="object-fit: cover; width: 45px; height: 45px; border: 3px solid var(--danger1);"></a>
												<?= $row['name'] ?>
											</div>
										</td>
										<td><a href="https://api.whatsapp.com/send?phone=+62<?= substr($row['no_hp'], 1) ?>&text=Hello <?= $row['name'] ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Whatsapp" type="button"> <?= $row['no_hp'] ?></a></td>
										<td class="text-center">
											<a href="<?= BASEURL; ?>/admin/pemesanan/detail/<?= base64_encode($row['id_tmuld']) ?>" class="border-1 border-warning" style="background-color: var(--orange); color: #fff; padding: 5px 5px; border-radius: 4px; font-weight: 600; font-size: 14px;">Detail</a>
											<button class="tambah-pesanan border-1 border-primary m-1" data-id="<?= $row['id_tmuld'] ?>" style="background-color: var(--primary1); color: #fff; padding: 5px 5px; border-radius: 4px; font-weight: 600; font-size: 14px;">Buat Pesanan</button>
										</td>
									</tr>
								<?php } ?>
							<?php } ?>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<?php include __DIR__ . "/../modal/tambah/tambah-pesanan.php" ?>
		</div>
	</div>
</div>
<script>
	lightbox.option({
		'resizeDuration': 100,
		'wrapAround': false
	})
</script>