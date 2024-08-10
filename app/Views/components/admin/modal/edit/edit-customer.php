<div class="modal fade" id="edit-customer-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title d-flex align-items-center">
					<img class="mx-1" src="<?= BASEURL ?>/img/admin/icons/edit.svg" alt="edit" style="width: 27px; filter: invert(40%) hue-rotate(180deg) contrast(400%); margin-bottom: 5px">
					Edit Customer
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="edit-customer-form" action="<?= BASEURL ?>/coba/edit" method="post">
				<input type="hidden" name="id" id="id">
				<div class="modal-body">
					<div class="form-row">
						<div class="col px-4 mb-3">
							<label for="nama">Nama</label>
							<input type="text" class="form-control" id="nama" name="nama" required>
							<div class="invalid-feedback">
								nama harus berupa huruf dan jangan kurang dari 3 huruf
							</div>
							<small id="passwordHelpBlock" class="form-text text-muted d-flex">
								<p class="text-danger mr-1">* </p> Nama Wajib di isi minimal 3 karakter
							</small>
						</div>
					</div>
					<div class="form-row" id="form-row-2">
						<div class="col px-4 mb-3">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" name="email">
							<div class="invalid-feedback">
								email harus berupa format email @
							</div>
							<small id="passwordHelpBlock" class="form-text text-muted d-flex">
								<p class="text-primary mr-1">- </p> Email tidak wajib di isi
							</small>
						</div>
					</div>
					<div class="form-row" id="form-row-2">
						<div class="col justify-content-center px-4 mb-3">
							<label for="no_hp">Nomor Hp</label>
							<input type="text" class="form-control" id="no_hp" aria-describedby="no_hpFeedback" name="no_hp" required>
							<div class="invalid-feedback">
								nomor hp harus berupa angka dan panjang minimal 11
							</div>
							<small id="passwordHelpBlock" class="form-text text-muted d-flex">
								<p class="text-danger mr-1">* </p> Nomor Hp Wajib di isi
							</small>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn-admin-1" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn p-2" name="submit-modal-edit" id="submit-modal-edit" style="border: 2px solid rgba(45, 0, 0, 0.30);">
						<img src='/img/admin/icons/edit.svg' width='20px' alt='edit img' style="filter: invert(40%) hue-rotate(180deg) contrast(400%);"> Edit</button>
				</div>
			</form>
		</div>
	</div>
</div>