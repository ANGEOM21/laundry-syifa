<!-- Modal -->
<div class="modal fade" id="exceldata_cutomer" tabindex="-1" aria-labelledby="exceldata_cutomerLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Data Customer Xslsx belum bayar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h3 class="text-center">Data Customer Xslsx Belum Bayar<img src="<?= BASEURL; ?>/img/icon/excel.png" alt="" width="35"></h3>
				<table class="table table-bordered table-striped" id="TableData_ctm">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Nama</th>
							<th scope="col">No. Hp</th>
							<th scope="col">Kategori</th>
							<th scope="col">Status Bayar</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						$total_bayar = 0;
						foreach ($data['pesanan'] as $row) {
							if ($row['status_deleted_tmuld'] == 0) {
								if ($row['status_deactive_pld'] == 1) {
									if ($row['status_bayar_pld'] == 0) {
										$total_bayar += $row['bayar'];
						?>
										<tr>
											<th class="col-1 text-center" scope="row"><?= $no++ ?></th>
											<td class="col-3"><?= $row['name'] ?></td>
											<td class="col-2"><?= $row['no_hp'] ?></td>
											<td class="col-2"><?= $row['name_kld'] ?></td>
											<td class="col-2 text-center">
												<div class="no-pesan">Rp. <?= number_format($row['bayar'], 0, ',', '.') ?></div>
											</td>
											<td class="d-none"><?= $row['bayar'] ?></td>
										</tr>
									<?php } ?>
								<?php } ?>
							<?php } ?>
						<?php } ?>
						<tr class="text-center" style="background-color: var(--success2);">
							<th colspan="5"> Total Bayar <?= number_format($total_bayar, 0, ',', '.') ?></th>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="py-1 px-2 rounded rounded-lg btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" id="export-file" class="py-1 px-2 rounded rounded-lg btn-success">Export <img src="<?= BASEURL; ?>/img/icon/excel.png" alt="" width="20"></button>
			</div>
		</div>
	</div>
</div>
<style>
	.modal-body iframe {
		overflow: auto;
	}
</style>