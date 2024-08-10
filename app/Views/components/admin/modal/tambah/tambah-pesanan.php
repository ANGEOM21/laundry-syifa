<!-- Modal -->
<div class="modal fade" id="tambah-pesanan" tabindex="-1" aria-labelledby=tambah-pesananLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id=tambah-pesananLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-admin" method="post" action="">
				<input type="hidden" name="id" id="id">
				<div class="modal-body">
					<div class="form-row">
						<div class="col mb-3">
							<label for="kategori">Kategori</label>
							<select class="custom-select" id="kategori" name="kategori" aria-describedby="kategoriFeedback">
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
					<button type="reset" class="btn-admin-1">Batal</button>
					<button type="submit" class="btn-admin" name="tambah" id="modal-admin-submit">
						<img src='/img/admin/icons/plus.svg' width='20px' alt='plus img' style="filter: invert(60%) hue-rotate(180deg) contrast(400%);"> Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>