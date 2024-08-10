<!-- Modal -->
<div class="modal fade" id="edit-prosess" data-keyboard="false" tabindex="-1" aria-labelledby="edit_aktifLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="edit_aktifLabel"><img class="mx-1" src="<?= BASEURL ?>/img/admin/icons/edit.svg" alt="edit" style="width: 27px; filter: invert(40%) hue-rotate(180deg) contrast(400%); margin-bottom: 5px">Edit Prosess Pesanan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="post" id="form-edit-prosess">
				<input type="hidden" name="id" id="id">
				<div class="modal-body">
					<div class="form-group">
						<label for="disabledTextInput">Tipe Pesanan</label>
						<input type="text" id="pesanan" name="pesanan" class="form-control" disabled>
						<input type="hidden" id="pesanan" name="pesanan" class="form-control">
					</div>
					<div class="form-group">
						<label for="prosess">Status</label>
						<select name="prosess" id="prosess" class="form-control" required>
							<option selected disabled value="">--Pilih Status--</option>
							<option value="di prosess">Di Prosess</option>
							<option value="di cuci">Di Cuci</option>
							<option value="di jemur">Di Jemur</option>
							<option value="di setrika">Di Setrika</option>
							<option value="di kemas">Di Kemas</option>
							<option value="selesai">Selesai</option>
						</select>
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