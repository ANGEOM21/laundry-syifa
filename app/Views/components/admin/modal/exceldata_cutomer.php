<!-- Modal -->
<div class="modal fade" id="exceldata_cutomer" tabindex="-1" aria-labelledby="pdfdata_cutomerLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Daftar Data Customer Xslsx</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<h3 class="text-center">Data Customer Xslsx <img src="<?= BASEURL; ?>/img/icon/excel.png" alt="" width="35"></h3>
					<div class="container">
						<table class="table table-bordered table-striped" id="TableData_ctm">
							<thead>
								<tr>
									<th scope="col">No</th>
									<th scope="col">Nama</th>
									<th scope="col">No. Hp</th>
									<th scope="col">Email</th>
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
													<?= $no++ ?>
												</th>
												<td><?= $row['name'] ?></td>
												<td><?= $row['no_hp'] ?></td>
												<?php if ($row['email'] == '') { ?>
													<td>-</td>
												<?php } else { ?>
													<td><?= $row['email'] ?></td>
												<?php } ?>
											</tr>
										<?php } ?>
									<?php } ?>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- <div id="spreadsheet">
						<p></p>
				</div> -->
				<!-- <button id="download-xlsx" class="btn-primary">Download</button> -->
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