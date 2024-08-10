<!-- Modal -->
<div class="modal fade" id="edit-pesanan" data-keyboard="false" tabindex="-1" aria-labelledby="edit_aktifLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="edit_aktifLabel"><img class="mx-1" src="<?= BASEURL ?>/img/admin/icons/edit.svg" alt="edit" style="width: 27px; filter: invert(40%) hue-rotate(180deg) contrast(400%); margin-bottom: 5px">Edit Pesanan Customer</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="post" id="form-edit-pesanan">
				<input type="hidden" name="id" id="id">
				<div class="modal-body">
					<div class="form-row">
						<div class="col mb-3">
							<label for="kategori-pesanan">Kategori</label>
							<select class="custom-select" id="kategori-pesanan" name="kategori-pesanan" aria-describedby="kategoriFeedback">
								<option selected value="">--Pilih Kategori--</option>
								<option value="kiloan">Kiloan</option>
								<option value="satuan">Satuan</option>
								<option value="express">Express</option>
							</select>
							<small id="passwordHelpBlock" class="form-text text-muted d-flex">
								<p class="text-danger mr-1">* </p> Pilih Kategori
							</small>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn-admin-1" data-dismiss="modal">Close</button>
					<button type="submit" class="btn p-2" name="submit-modal-edit" id="submit-modal-edit" style="border: 2px solid rgba(45, 0, 0, 0.30);">
						<img src='/img/admin/icons/edit.svg' width='20px' alt='edit img' style="filter: invert(40%) hue-rotate(180deg) contrast(400%);"> Edit</button>
				</div>
			</form>
		</div>
	</div>
</div>